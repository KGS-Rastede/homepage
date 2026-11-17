<?php

namespace Kgs\Kalender;

use DateInterval;
use DateTimeImmutable;
use DateTimeZone;
use Exception;

/**
 * Liest die Termine (VEVENT) aus einer ICS-Datei.
 *
 * Bewusst einfach gehalten, weil der IServ-Kalender keine Terminserien
 * enthält: Hat ein Termin doch eine RRULE, wird nur der erste Termin der
 * Serie übernommen. Abgesagte Termine (STATUS:CANCELLED) werden ausgelassen.
 */
class IcsParser
{
    /**
     * @return array<int, array{titel: string, start: DateTimeImmutable, ende: DateTimeImmutable, ganztaegig: bool, ort: string}>
     */
    public static function termine(string $ics, DateTimeZone $zone): array
    {
        // Umgebrochene Zeilen (Fortsetzung beginnt mit Leerzeichen/Tab) zusammenfügen
        $ics    = preg_replace("/\r?\n[ \t]/", '', $ics);
        $termin = null;
        $liste  = [];

        foreach (preg_split("/\r?\n/", $ics) as $zeile) {
            if ($zeile === 'BEGIN:VEVENT') {
                $termin = [];
                continue;
            }

            if ($zeile === 'END:VEVENT') {
                if ($eintrag = static::eintrag($termin ?? [], $zone)) {
                    $liste[] = $eintrag;
                }
                $termin = null;
                continue;
            }

            if ($termin === null) {
                continue;
            }

            if ($eigenschaft = static::eigenschaft($zeile)) {
                // Bei doppelten Eigenschaften zählt die erste
                $termin[$eigenschaft['name']] ??= $eigenschaft;
            }
        }

        usort($liste, fn ($a, $b) => $a['start'] <=> $b['start']);

        return $liste;
    }

    /**
     * Zerlegt eine Zeile wie `DTSTART;TZID=Europe/Berlin:20261117T080000`.
     *
     * @return array{name: string, parameter: array<string, string>, wert: string}|null
     */
    protected static function eigenschaft(string $zeile): array|null
    {
        if (!preg_match('/^([A-Za-z0-9-]+)((?:;[^:;=]+=(?:"[^"]*"|[^:;]*))*):(.*)$/', $zeile, $teile)) {
            return null;
        }

        $parameter = [];
        preg_match_all('/;([^:;=]+)=("[^"]*"|[^:;]*)/', $teile[2], $treffer, PREG_SET_ORDER);
        foreach ($treffer as [, $name, $wert]) {
            $parameter[strtoupper($name)] = trim($wert, '"');
        }

        return ['name' => strtoupper($teile[1]), 'parameter' => $parameter, 'wert' => $teile[3]];
    }

    protected static function eintrag(array $termin, DateTimeZone $zone): array|null
    {
        if (!isset($termin['DTSTART'])) {
            return null;
        }

        if (strtoupper($termin['STATUS']['wert'] ?? '') === 'CANCELLED') {
            return null;
        }

        try {
            [$start, $ganztaegig] = static::zeitpunkt($termin['DTSTART'], $zone);

            if (isset($termin['DTEND'])) {
                [$ende] = static::zeitpunkt($termin['DTEND'], $zone);
            } elseif (isset($termin['DURATION'])) {
                $ende = $start->add(new DateInterval(ltrim($termin['DURATION']['wert'], '+')));
            } else {
                // Ohne Ende: ganztägig = ein Tag, sonst ein Zeitpunkt
                $ende = $ganztaegig ? $start->modify('+1 day') : $start;
            }
        } catch (Exception) {
            return null;
        }

        return [
            'titel'      => static::text($termin['SUMMARY']['wert'] ?? ''),
            'start'      => $start,
            'ende'       => max($ende, $start),
            'ganztaegig' => $ganztaegig,
            'ort'        => static::text($termin['LOCATION']['wert'] ?? ''),
        ];
    }

    /**
     * @return array{0: DateTimeImmutable, 1: bool} Zeitpunkt in $zone und ob es ein reines Datum ist
     */
    protected static function zeitpunkt(array $eigenschaft, DateTimeZone $zone): array
    {
        $wert = $eigenschaft['wert'];

        // Reines Datum (ganztägig): 20261117
        if (($eigenschaft['parameter']['VALUE'] ?? '') === 'DATE' || preg_match('/^\d{8}$/', $wert)) {
            return [new DateTimeImmutable(substr($wert, 0, 8) . 'T000000', $zone), true];
        }

        // UTC: 20261117T070000Z
        if (str_ends_with($wert, 'Z')) {
            $utc = new DateTimeImmutable(rtrim($wert, 'Z'), new DateTimeZone('UTC'));
            return [$utc->setTimezone($zone), false];
        }

        // Mit Zeitzone oder ohne (dann Zeit in $zone)
        $tz = $zone;
        if (isset($eigenschaft['parameter']['TZID'])) {
            try {
                $tz = new DateTimeZone($eigenschaft['parameter']['TZID']);
            } catch (Exception) {
                $tz = $zone;
            }
        }

        return [(new DateTimeImmutable($wert, $tz))->setTimezone($zone), false];
    }

    /** Hebt die ICS-Maskierung auf (\n, \, \; \\). */
    protected static function text(string $wert): string
    {
        return trim(strtr($wert, ['\\n' => "\n", '\\N' => "\n", '\\,' => ',', '\\;' => ';', '\\\\' => '\\']));
    }
}
