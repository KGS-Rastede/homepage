<?php

namespace Kgs\Kalender;

use DateTimeImmutable;
use DateTimeInterface;
use DateTimeZone;
use Kirby\Cms\App;
use Kirby\Http\Remote;
use Throwable;

/**
 * Schulkalender aus IServ.
 *
 * Die ICS-Datei wird im Kirby-Cache gehalten und höchstens alle
 * `kgs.kalender.maxAlter` Sekunden neu geholt. Ist IServ nicht erreichbar,
 * bleibt der letzte gute Stand gültig, und ein neuer Versuch folgt erst nach
 * `kgs.kalender.wiederholenNach` Sekunden. So wartet nicht jeder
 * Seitenaufruf auf IServ.
 *
 * Die Adresse (mit Schlüssel) steht in secrets.php unter `kgs.kalender.url`.
 */
class Kalender
{
    public const ZEITZONE = 'Europe/Berlin';

    /**
     * Termine, die den Zeitraum [$von, $bis) berühren, nach Beginn sortiert.
     * Ohne Grenzen alle Termine. null, wenn es keinen Kalender gibt.
     */
    public static function termine(DateTimeInterface|null $von = null, DateTimeInterface|null $bis = null): array|null
    {
        $ics = static::ics();

        if ($ics === null) {
            return null;
        }

        $termine = IcsParser::termine($ics, static::zone());

        return array_values(array_filter($termine, function (array $t) use ($von, $bis) {
            // Ende ist exklusiv; Termine ohne Dauer zählen an ihrem Beginn
            $ende = $t['ende'] > $t['start'] ? $t['ende'] : $t['start']->modify('+1 second');

            return ($von === null || $ende > $von) && ($bis === null || $t['start'] < $bis);
        }));
    }

    /**
     * Termine im Format, das FullCalendar als JSON-Quelle erwartet.
     */
    public static function fuerFullCalendar(array $termine): array
    {
        return array_map(fn (array $t) => [
            'title'  => $t['titel'],
            'start'  => $t['ganztaegig'] ? $t['start']->format('Y-m-d') : $t['start']->format(DATE_ATOM),
            'end'    => $t['ganztaegig'] ? $t['ende']->format('Y-m-d') : $t['ende']->format(DATE_ATOM),
            'allDay' => $t['ganztaegig'],
        ], $termine);
    }

    /**
     * Ordnet Termine Werktagen zu (für Listen wie auf der Startseite).
     * Jeder Termin erscheint einmal, am ersten Werktag im Zeitraum, an dem
     * er stattfindet. Wochenenden werden ausgelassen.
     *
     * @return array<string, array> Datum (Y-m-d) => Termine dieses Tages
     */
    public static function nachWerktagen(array $termine, DateTimeImmutable $von, DateTimeImmutable $bis): array
    {
        $tage = [];

        foreach ($termine as $termin) {
            $tag  = max($termin['start'], $von)->setTime(0, 0);
            $ende = $termin['ende'] > $termin['start'] ? $termin['ende'] : $termin['start']->modify('+1 second');

            while ($tag < $bis && $tag < $ende) {
                if ($tag->format('N') <= 5) {
                    $tage[$tag->format('Y-m-d')][] = $termin;
                    break;
                }
                $tag = $tag->modify('+1 day');
            }
        }

        ksort($tage);

        return $tage;
    }

    public static function zone(): DateTimeZone
    {
        return new DateTimeZone(static::ZEITZONE);
    }

    /**
     * Inhalt der ICS-Datei, bei Bedarf frisch von IServ geholt.
     */
    public static function ics(): string|null
    {
        $kirby  = App::instance();
        $cache  = $kirby->cache('kgs.kalender');
        $stand  = $cache->get('ics');
        $jetzt  = time();
        $alter  = $stand ? $jetzt - $stand['geholt'] : PHP_INT_MAX;
        $pause  = $jetzt - ($cache->get('versuch') ?? 0);

        if ($alter < $kirby->option('kgs.kalender.maxAlter', 3600)) {
            return $stand['inhalt'];
        }

        // Nach einem Fehlschlag nicht bei jedem Aufruf erneut versuchen
        if ($stand !== null && $pause < $kirby->option('kgs.kalender.wiederholenNach', 600)) {
            return $stand['inhalt'];
        }

        $cache->set('versuch', $jetzt);
        $neu = static::abrufen();

        if ($neu !== null) {
            $cache->set('ics', ['inhalt' => $neu, 'geholt' => $jetzt]);
            return $neu;
        }

        return $stand['inhalt'] ?? null;
    }

    protected static function abrufen(): string|null
    {
        $kirby = App::instance();
        $url   = $kirby->option('kgs.kalender.url');

        if (empty($url)) {
            return null;
        }

        try {
            $antwort = Remote::get($url, ['timeout' => $kirby->option('kgs.kalender.timeout', 5)]);
        } catch (Throwable) {
            return null;
        }

        $inhalt = $antwort->content();

        if ($antwort->code() !== 200 || !is_string($inhalt) || !str_contains($inhalt, 'BEGIN:VCALENDAR')) {
            return null;
        }

        return $inhalt;
    }

    /** Liest einen Zeitpunkt aus einem Query-Parameter (z. B. von FullCalendar). */
    public static function datumAus(string|null $wert): DateTimeImmutable|null
    {
        if ($wert === null || $wert === '') {
            return null;
        }

        try {
            return new DateTimeImmutable($wert, static::zone());
        } catch (Throwable) {
            return null;
        }
    }
}
