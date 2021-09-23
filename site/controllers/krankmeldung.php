<?php
return function($kirby, $pages, $page) {

    $alert = null;

    if($kirby->request()->is('POST') && get('submit')) {
        $emailEndung = "@kgs-rastede.eu";
        $email;

        // check the honeypot
        if(empty(get('website')) === false) {
            go($page->url());
            exit;
        }

        $data = [
            'name'  => get('name'),
            'email' => get('email'),
            'klasse' => get('klasse'),
            'klassenlehrer'  => get('klassenlehrer'),
            'tel' => get('tel'),
            'nachricht' => get('nachricht')
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

        if(substr($data['klasse'], 0, 2) === "05" || substr($data['klasse'], 0, 2) === "06") { // für füfnte und sechste Klassen an die Feldbreite
            $email = "feldbreite" . $emailEndung;
        }
        else { // alles andere an die Wilhelmstrasse
            $email = "wilhelmstrasse" . $emailEndung;
        }

        // some of the data is invalid
        if($invalid = invalid($data, $rules, $messages)) {
            $alert = $invalid;

            // the data is fine, let's send the email
        } else {
            try {
                $kirby->email([
                    'template' => 'krankmeldung',
                    'from'     => esc($data['email']),
                    'replyTo'  => $data['email'],
                    'to'       => $email,
                    'cc'       => $data['klassenlehrer'] . $emailEndung,
                    'subject'  => 'Krankmeldung für: ' . esc($data['name']) . ' (' . esc($data['klasse']) . ')',
                    'data'     => [
                        'text'   => "Name: <em>" . esc($data['name']) .
                                "</em><br>E-Mail: <em>" . esc($data['email']) .
                                "</em><br>Telefonnummer: <em>" . esc($data['tel']) .
                                "</em><br>Klasse: <em>" . esc($data['klasse']) .
                                "</em><br>Klassenlehrer: <em>" . esc($data['klassenlehrer']) .
                                "</em><br><br>Nachricht:<br>" . esc($data['nachricht']) .
                                "<br><br>",
                        'sender' => esc($data['name'])
                    ]
                ]);

            } catch (Exception $error) {
                if(option('debug')):
                    $alert['error'] = 'Die Krankmeldung konnte nicht gesendet werden: <strong>' . $error->getMessage() . '</strong>';
                else:
                    $alert['error'] = 'Die Krankmeldung konnte <strong>nicht</strong> gesendet werden! Bitte versuchen Sie uns auf einem anderen Weg zu erreichen.';
                endif;
            }

            // no exception occurred, let's send a success message
            if (empty($alert) === true) {
                $success = 'Die Krankmeldung wurde gesendet';
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