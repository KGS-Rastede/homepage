<?php
return function($kirby, $pages, $page) {
    // Es folgt eine Funktion die später im Code verwendet wird:

    /** Ersetzt Platzhalter vom input panelText und gibt einen String zurück, bei dem die Platzhalter durch die Werte ersetzt wurden.
     * Es wäre theoretisch möglich eine praktische PHP Methode anstatt zu verwenden.
     *   Siehe hierzu: https://www.php.net/manual/en/function.sprintf.php
     *
     * Bei dieser Methode wäre jedoch eine deutlich kompliziertere Formatierung notwendig und dies wäre im Panel nicht Sinnvoll. Deshalb wird im Panel eine einfachere Formatierung genutzt und diese wird hier wieder manuell umgeschrieben.
     * @param string $panelText - Der Input Text
     * @param array $pData - Ein Array welches bestimmte Infos enthalt um die Platzhalter zu ersetzen
     * @param string $pLehrerName - Der ausgeschriebene Name der Lehrkraft
     * @param string $pSekiEmail - Die Mail Adresse des Skretariats
     * @param string $pFormatierteNachricht - Den Nachrichtentext angepasst
     * @return string - Output Text bei dem die Platzhalter ersetzt wurden 

    */
    function parseMailText($panelText, $pData, $pLehrerName, $pSekiEmail, $pFormatierteNachricht) {
        $mailText = $panelText; // sicherheitshalber den Text in einer neuen Variable speichern

        // nach diesen Strings wird gesucht
        $searchArr = array("%name%", "%mail%", "%tel%", "%klassenlehrer%", "%klassenlehrer-herrn%", "%klasse%", "%original-nachricht", "%nachricht%", "%sekiMail%");
        // und die Strings ^^ werden durch die folgenden Strings in gleicher Reihenfolger ersetzt
        $replaceArr = array($pData['name'], $pData['email'], $pData['tel'], $pLehrerName, str_replace("Herr", "Herrn", $pLehrerName), $pData['klasse'], $pData['nachricht'], $pFormatierteNachricht, $pSekiEmail);

        for($i = 0; $i < count($searchArr); $i++) { // für alle Elemente des arrays, bzw. für alle Strings die ersetzt werden sollen
            // ersetze den jeweiligen Platzhalter mit dem jeweiligen Wert und speichere den Text in der Variable
            // ireplace bedeuted Groß-/kleinschreibung wird ignoriert 
            $mailText = str_ireplace($searchArr[$i], $replaceArr[$i], $mailText); 
        }
        return $mailText;
    }

    $alert = null;

    if($kirby->request()->is('POST') && get('submit')) {
        $emailEndung = "@kgs-rastede.eu";
        $sekiEmail;

        // check the honeypot
        if(empty(get('website')) === false) {
            go($page->url());
            exit;
        }

        // !!!!! Die esc() Methode ist SEHR wichtig, da sonst eine XSS (Cross-Site-Scripting) vulnerability / Sicherheitslücke vorliegt.
        $data = [
            'name'  => esc(get('name')),
            'email' => esc(get('email')),
            'klasse' => esc(get('klasse')),
            'klassenlehrer'  => esc(get('klassenlehrer')), // dieser wird as Kürzel übertragen
            'tel' => esc(get('tel')),
            'nachricht' => esc(get('nachricht'))
        ];

        $rules = [
            'name'  => ['required', 'minLength' => 3],
            'email' => ['required', 'email'],
            'klassenlehrer'  => ['required', 'minLength' => 2],
            'klasse'  => ['required', 'minLength' => 4, 'maxLength' => 4],
            'tel' => ['required'],
            'nachricht' => ['maxLength' => 200]
        ];

        $messages = [
            'name'  => 'Bitte einen gültigen Vor- und Nachnamen eingeben',
            'email' => 'Bitte eine gültige EMail-Adresse eingeben',
            'klassenlehrer'  => 'Bitte einen gültigen Namen oder Kürzel eingeben',
            'klasse'  => 'Bitte eine gültige Klasse eingeben',
            'tel' => 'Bitte eine Telefonnummer eingeben',
            'nachricht' => 'Bitte fassen Sie sich kürzer'
        ];

        // für fünfte und sechste Klassen E-Mail an die Feldbreite
        if(substr($data['klasse'], 0, 2) === "05" || substr($data['klasse'], 0, 2) === "06") { 
            $sekiEmail = "feldbreite" . $emailEndung;
        } 
        else { // alles andere an die Wilhelmstrasse
            $sekiEmail = "wilhelmstrasse" . $emailEndung;
        }

        // Meldung falls keine Nachricht eingegeben wurde anstatt leeres Feld
        $formatierteNachricht;
        if(empty($data['nachricht'])) {
            $formatierteNachricht = $page->noMsgText()->kt();
        } 
        else { // Einfach die Nachricht verwenden, wenn es eine Nachricht gibt
            $formatierteNachricht = $data['nachricht'];
        }

        // Lehrer namen aus dem Kürzel bestimmen
        $lehrerName;

        // für alle Objekte der Lehrer csv
        foreach($kirby->site()->find('lehrer')->children() as $csvLehrer) {
            if($csvLehrer->kuerzel() == $data['klassenlehrer']) // wenn das Lehrerkürzel aus der CSV mit dem eingegebenem übereinstimmt 
                $lehrerName = $csvLehrer->name(); // den Namen der Lehrkraft speichern
        }
        // Fallback falls die Lehrkraft nicht gefunden werden konnte
        if(!isset($lehrerName)) 
            $lehrerName = $data['klassenlehrer'];

        // die eingegbenen Daten im Form sind teilweise falsch
        if($invalid = invalid($data, $rules, $messages)) {
            $alert = $invalid ;
        // die eingegebenen Daten sind in Ordnung, versuche eine E-Mail zu schicken
        } else {
            try {
                $kirby->email([
                    'template' => 'krankmeldung',
                    'from'     => $data['email'],
                    'replyTo'  => $data['email'],
                    'to'       => $sekiEmail,
                    'cc'       => $data['klassenlehrer'] . $emailEndung,
                    'subject'  => parseMailText($page->sekiBetreff(), $data, $lehrerName, $sekiEmail, $formatierteNachricht),
                    'data'     => [
                        'text'   => parseMailText($page->sekiText()->kt(), $data, $lehrerName, $sekiEmail, $formatierteNachricht),
                    ]
                ]);

            // falls es beim senden der Mail zu einem Fehler kommt
            } catch (Exception $error) {
                if(option('debug')) { // auf lokalen Test-Systemen
                    $alert['error'] = 'Die Krankmeldung konnte nicht gesendet werden: <strong>' . $error->getMessage() . '</strong>';
                } else { // auf dem echten Server
                    $alert['error'] = parseMailText($page->failKrankmeldung()->kt(), $data, $lehrerName, $sekiEmail, $formatierteNachricht);
                }

            }

            // falls die E-Mail an das Sekreteriat und die Lehrkraft erfolgreich war
            if (empty($alert) === true) { 
                try { // versuche an die Eltern eine Bestätigungsmail zu schicken
                    $kirby->email([
                        'template'  => 'bestaetigung',
                        'from'      => $sekiEmail,
                        'to'        => $data['email'],
                        'subject'   => parseMailText($page->confirmationBetreff(), $data, $lehrerName, $sekiEmail, $formatierteNachricht),
                        'data'      => [
                            'text'      =>  parseMailText($page->confirmationText()->kt(), $data, $lehrerName, $sekiEmail, $formatierteNachricht),
                        ] 
                        ]);
                } catch (Exception $error) {
                    if(option('debug')) {
                        if(!isset($alert['error'])) // falls es noch keinen Wert gibt
                            $alert['error'] = ""; // lege diesen als leeren String fest, um eine Fehlermeldung zu vermeiden

                        $alert['error'] = $alert['error'] . 'Die Bestätigungsmail an Sie konnte nicht gesendet werden: <strong>' . $error->getMessage() . '</strong>';
                    // es muss nicht überprüft werden, ob die Krankmeldung erfolgreich gesendet wurde, da dies bereits weiter oben im 'if' geschehen ist
                    // die Mail an das Sekreteriat wurde also erfolgreich gesendet
                    } else { 
                        $alert['error'] = parseMailText($page->failBestaetigung()->kt(), $data, $lehrerName, $sekiEmail, $formatierteNachricht);
                    }
                }

            }

            // keine Fehler sind aufgetreten, es keine eine Bestätigungsnachricht angezeigt werden
            if (empty($alert) === true) {
                $success = parseMailText($page->successText()->kt(), $data, $lehrerName, $sekiEmail, $formatierteNachricht);
                $data = [];
            }
        }
    }

    return [
        'alert'   => $alert,
        'data'    => $data ?? false,
        'success' => $success ?? false
    ];
};