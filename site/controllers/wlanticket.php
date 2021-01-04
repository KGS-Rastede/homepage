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

        $messages = [
            'mail'  => 'Die Mailadresse ist nicht gültig',
        ];

        $special = false; //wahr wenn die E-Mail im Panel festgelegt wurde
        $validate = false; //wahr wenn eine E-Mail gesendet werden soll
        $name = null; //Name der Lehrkraft

        /* --- E-Mail im Panel festgelegt? ---*/
        foreach (page('formulare/emailadressen')->emailadressen()->toStructure() as $lehrer) {
            if (V::in($data['mail'], $lehrer->emailadresse()->toArray()) ) {
            //Zuerst überprüfen, ob die Mailadresse eine special Mailadresse ist. Falls ja: senden. Falls nein: überprüfen ob sie eine lehrer kgs-email ist
                $special = true;        
            }
        }
        
        if (!$special) { //Es ist also eine Lehrkraft in der CSV

            /* --- Namen der Lehrkraft bestimmen + in der csv vorhanden? --- */
            $kuerzel = substr_replace($data['mail'], '', -15); // '@kgs-rastede.eu' ist 15 Zeichen lang, übrig bleibt also das Kürzel
            foreach (page('lehrer')->children() as $lehrer) {
                if ($kuerzel == $lehrer->kuerzel()) { //Gibt es ein E-Mail Kürzel was einem Lehrer-Kürzel entspricht?
                    $name = $lehrer->name();                    
                    $validate = true;
                }
            }
            if (!($validate === true && //Das Kürzel kommt in der csv vor
                V::email($data['mail']) && //Es ist allgemein eine gültige E-Mailadresse
                V::maxLength($data['mail'], 18) && //nicht länger als 18 Zeichen [ 'kgs-rastede.eu' = 15 + Kürzel = 3]
                V::minLength($data['mail'], 17) && //nicht kürzer als 17 Zeichen [ 'kgs-rastede.eu' = 15 + Kürzel = 2]
                V::endsWith($data['mail'], '@kgs-rastede.eu'))) //endet mit der KGS-Domain
                $validate = false;
            
        }

        if (empty($name)) //Falls die E-Mail eine extra E-Mail ist und nicht in der Lehrer csv steht
            $name = esc($data['mail']);   
            
        
        /* --- Daten sind korrekt -> Ticket bestimmen und E-Mail senden ---*/
        if ($validate || $special)  { 

            /* ---Ticket bestimmen --- */
            $arr_tickets = $page->tickets()->nl2br()->split('<br>'); //Alle Tickets im Array speichern
            $data['ticket'] = $arr_tickets[0]; //Erstes Ticket speichern für E-Mail
            unset($arr_tickets[0]); //Erstes Ticket aus dem Array löschen
            $ubrige_tickets = implode("\n", $arr_tickets); //Das Array zu einem String umformen            

            //Übrige Tickets wieder speichern
            $kirby = kirby();
            $kirby->impersonate('kirby', function () use($ubrige_tickets) {
                page('formulare/wlanticket')->update([
                    'tickets' => $ubrige_tickets
                ]);

                return 'Tickets wurden gespeichert';
            });

            $anzahl_ubrige_tickets = count($arr_tickets); //Anzahl der übrigen Tickets bestimmen

            /* --- E-Mail senden --- */
            try {
                $kirby->email([
                    'template' => 'wlanticket',
                    'from'     => esc($data['mail']),
                    'replyTo'  => esc($data['mail']),
                    'to'       => esc($data['mail']),
                    'subject'  => 'Anfrage eines Tickets für das WLAN der KGS Rastede',
                    'data'     => [
                        'ticket'   => esc($data['ticket']),
                        'sender' => $name
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

            /* --- Überprüfen, ob es zu wenig Tickets gibt und eine Mail geschickt werden muss --- */
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
        else { //Falls die E-Mail ungültig ist
            $alert['mail'] = $messages['mail'];
        }
    }

    return [
        'alert'   => $alert,
        'data'    => $data ?? false,
        'success' => $success ?? false
    ];
};
