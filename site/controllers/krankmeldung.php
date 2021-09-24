<?php
return function($kirby, $pages, $page) {

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
            'klasse' => esc(get('klasse')), // es wird as Kürzel übertragen
            'klassenlehrer'  => esc(get('klassenlehrer')),
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

        // für füfnte und sechste Klassen an die Feldbreite
        if(substr($data['klasse'], 0, 2) === "05" || substr($data['klasse'], 0, 2) === "06") { 
            $sekiEmail = "feldbreite" . $emailEndung;
        } else { // alles andere an die Wilhelmstrasse
            $sekiEmail = "wilhelmstrasse" . $emailEndung;
        }

        // Meldung falls keine Nachricht eingegeben wurde anstatt leeres Feld
        if(empty($data['nachricht'])) {
            $data['nachricht'] = "Es wurde keine Nachricht eingegeben.";
        } else { // "Nachricht:" davor schreiben
            $data['nachricht'] = "Nachricht: <br>" . $data['nachricht'];
        }

        // Lehrer namen aus dem Kürzel bestimmen
        $lehrerName;
        // throw new ErrorException($kirby->site()->find('lehrer')->children()->first()->kuerzel());
        foreach($kirby->site()->find('lehrer')->children() as $csvLehrer) { // für alle Objekte der Lehrer csv
            if($csvLehrer->kuerzel() == $data['klassenlehrer']) // wenn das Lehrerkürzel aus der CSV mit dem eingegebenem übereinstimmt 
                $lehrerName = $csvLehrer->name(); // den Namen der Lehrkraft speichern
        }
        // Fallbakc Falls die Lehrkraft nicht gefunden werden konnte
        if(!isset($lehrerName)) 
            $lehrerName = $data['klassenlehrer'];

        // some of the data is invalid
        if($invalid = invalid($data, $rules, $messages)) {
            $alert = $invalid ;

        // the data is fine, let's send the email
        } else {
            try {
                $kirby->email([
                    'template' => 'krankmeldung',
                    'from'     => $data['email'],
                    'replyTo'  => $data['email'],
                    'to'       => $sekiEmail,
                    'cc'       => $data['klassenlehrer'] . $emailEndung,
                    'subject'  => 'Krankmeldung für: ' . $data['name'] . ' (' . $data['klasse'] . ')',
                    'data'     => [
                        'text'   => "Name: <em>" . $data['name'] .
                                "</em><br>E-Mail: <em>" . $data['email'] .
                                "</em><br>Telefonnummer: <em>" . $data['tel'] .
                                "</em><br>Klasse: <em>" . $data['klasse'] .
                                "</em><br>Klassenlehrer: <em>" . $lehrerName .
                                "</em><br><br>" . $data['nachricht'] .
                                "<br><br>"
                    ]
                ]);

            } catch (Exception $error) {
                if(option('debug')) {
                    $alert['error'] = 'Die Krankmeldung konnte nicht gesendet werden: <strong>' . $error->getMessage() . '</strong>';
                } else {
                    $alert['error'] = 'Die Krankmeldung konnte <strong>nicht</strong> gesendet werden! Bitte senden Sie eine Mail an das Sekreteriat um Ihr Kind krank zu melden: 
                        <br>' . $sekiEmail;
                }

            }

            if (empty($alert) === true) { // falls die E-Mail an das Sekreteriat und die Lehrkraft erfolgreich war
                try { // versuche an die Eltern eine Mail Bestätigungsmail zu schicken
                    $kirby->email([
                        'template'  => 'bestaetigung',
                        'from'      => $sekiEmail,
                        'to'        => $data['email'],
                        'subject'   => 'Eingangsbestätigung Krankmeldung für ' . $data['name'],
                        'data'      => [
                            'text'      => "vielen Dank für das Ausfüllen des Krankmeldungsformulars auf der Homepage der KGS Rastede. Hiermit bestätigen wir Ihnen den systemtechnischen Eingang der Krankmeldung für " . $data['name'] .
                                    " aus der " . $data['klasse'] . ". Entsprechend wurde eine E-Mail an das Sekreteriat und an " . str_replace("Herr", "Herrn", $lehrerName) ." geschickt." .

                                    "<br><br>Falls diese Angaben nicht korrekt sind wenden Sie sich bitte an das Sekreteriat: <em>" . $sekiEmail . "</em>. Sie brauchen sonst nichts weiter zu tun.",
                        ] 
                        ]);
                } catch (Exception $error) {
                    if(option('debug')) {
                        $alert['error'] = $alert['error'] . 'Die Bestätigungsmail an Sie konnte nicht gesendet werden: <strong>' . $error->getMessage() . '</strong>';
                    } else { // es muss nicht überprüft werden, ob die Krankmeldung erfolgreich gesendet wurde, da dies bereits weiter oben im 'if' geschehen ist
                        $alert['error'] = 'Die Bestätigungsmail an Sie konnte <strong>nicht</strong> gesendet werden! Die Krankmeldung wurde trotztdem erfolgreich gesendet. Sie können diese Fenster nun schließen.';
                    }
                }

            }

            // no exception occurred, let's send a success message
            if (empty($alert) === true) {
                $success = 'Die Krankmeldung wurde erfolgreich gesendet! Sie können dieses Fenster nun schließen.';
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