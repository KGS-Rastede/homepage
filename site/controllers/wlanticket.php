<?php
return function ($kirby, $pages, $page) {

    $alert = null;

    if ($kirby->request()->is('POST') && get('submit')) {
        if ($page->tickets()->isEmpty()) { //Sind überhaupt Tickets vorhanden?
            go($page->url());
            exit;
        }

        if (empty(get('website')) === false) { // check the honeypot
            go($page->url());
            exit;
        }
        $minimum_tickets = 10;
        $admin_email = 'netzwerk@kgs-rastede.de';

        $data = [
            'mail'  => get('emailadresse'),
        ];

        $rules = [
            'mail' => ['required', 'email'],

        ];

        $messages = [
            'mail'  => 'Die Mailadresse ist nicht gültig',
        ];

        // some of the data is invalid
        if ($invalid = invalid($data, $rules, $messages)) {
            $alert = $invalid;

            // Daten sind korrekt -> Ticket bestimmen und E-Mail senden
        } else {

            $arr_tickets = $page->tickets()->nl2br()->split('<br>'); //Alle Tickets im Array speichern
            $data['ticket'] = $arr_tickets[0]; //Erstes Ticket speichern für E-Mail
            unset($arr_tickets[0]); //Erstes Ticket aus dem Array löschen
            $ubrige_tickets = implode("\n", $arr_tickets); //Das Array zu einem String umformen

            $kirby = kirby();

            //Übrige Tickets wieder speichern
            $kirby->impersonate('kirby', function () use($ubrige_tickets) {
                page('formulare/wlanticket')->update([
                    'tickets' => $ubrige_tickets
                ]);

                return 'Tickets wurden gespeichert';
            });

            $anzahl_ubrige_tickets = count($arr_tickets); //Anzahl der übrigen Tickets bestimmen


            try {
                $kirby->email([
                    'template' => 'wlanticket',
                    'from'     => esc($data['mail']),
                    'replyTo'  => esc($data['mail']),
                    'to'       => esc($data['mail']),
                    'subject'  => 'Anfrage eines Tickets für das WLAN der KGS Rastede',
                    'data'     => [
                        'ticket'   => esc($data['ticket']),
                        'sender' => esc($data['mail'])
                    ]
                ]);
            } catch (Exception $error) {
                if (option('debug')) :
                    $alert['error'] = 'Das WLAN Ticket konnte nicht verschickt werden: <strong>' . $error->getMessage() . '</strong>';
                else :
                    $alert['error'] = 'Das WLAN Ticket konnte nicht verschickt werden. Bitte informieren Sie die Admins ( ' . $admin_email . ' ) falls dieser Fehler öfter auftritt.';
                endif;
            }

            // no exception occurred, let's send a success message
            if (empty($alert) === true) {
                $success = 'Das WLAN-Ticket wurde an \'' . esc($data['mail']) . '\' geschickt.';
                $data = [];
            }

            if ($anzahl_ubrige_tickets <= $minimum_tickets && $anzahl_ubrige_tickets % $minimum_tickets == 0) { //Benachrichtigung, falls es zu wenig Tickets gibt
                if ($anzahl_ubrige_tickets == 0) $subject = 'WLAN Super-GAU | Es gibt keine Tickets mehr'; //Betreff bei keinen Tickets
                else $subject = 'Die Anzahl der WLAN Tickets beträgt weniger als ' . $minimum_tickets; //Betreff bei wenig Tickets

                try {
                    $kirby->email([
                        'template' => 'wlanticket_alert',
                        'from'     => $admin_email,
                        'replyTo'  => $admin_email,
                        'to'       => $admin_email,
                        'subject'  => $subject,
                        'data'     => [
                            'text'   => '[Dies ist eine automatsiche E-Mail der Homepage] <br><br>
                                Die Anzahl der WLAN-Tickets beträgt nur noch: <strong>' . $anzahl_ubrige_tickets . '</strong><br>Bitte neue Tickets für das WLAN erzeugen und im Panel einfügen.',
                        ]
                    ]);
                } catch (Exception $error) {
                    if (option('debug')) :
                        $alert['error'] = $alert['error'] . 'Die Admins konnten nicht benachrichtigt werden: <strong>' . $error->getMessage() . '</strong>';
                    else :
                        $alert['error'] = $alert['error'] . 'Die Anzahl der verfügbaren WLAN-Tickets beträgt weniger als ' . $minimum_tickets .
                            '. Es konnte jedoch keine automatische E-Mail an die Admins geschickt werden. Bitte informieren Sie die Admins über: ' . $admin_email .
                            ', damit neue Tickets angelegt werden können';
                    endif;
                }
            }
        }
    }

    return [
        'alert'   => $alert,
        'data'    => $data ?? false,
        'success' => $success ?? false
    ];
};
