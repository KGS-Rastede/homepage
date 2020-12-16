<?php
return function($kirby, $pages, $page) {

    $alert = null;

    if($kirby->request()->is('POST') && get('submit')) {

        // check the honeypot
        if(empty(get('website')) === false) {
            go($page->url());
            exit;
        }

        $data = [
            'name'  => get('name'),
            'email' => get('email'),
            'klasse' => get('klasse'),
            'benutzername'  => get('benutzername')
        ];

        $rules = [
            'name'  => ['required', 'minLength' => 3, 'maxLength' => 40],
            'benutzername'  => ['required', 'minLength' => 3, 'maxLength' => 40],
            'email' => ['required', 'email'],
            'klasse'  => ['required', 'minLength' => 2, 'maxLength' => 4],
        ];

        $messages = [
            'name'  => 'Bitte einen gültigen Vor- und Nachnamen eingeben',
            'benutzername'  => 'Bitte einen gültigen Benutzernamen eingeben',
            'email' => 'Bitte eine gültige EMail-Adresse eingeben',
            'klasse'  => 'Bitte eine gültige Klasse eingeben'
        ];

        // some of the data is invalid
        if($invalid = invalid($data, $rules, $messages)) {
            $alert = $invalid;

            // the data is fine, let's send the email
        } else {
            try {
                $kirby->email([
                    'template' => 'iserv',
                    'from'     => esc($data['email']),
                    'replyTo'  => $data['email'],
                    'to'       => 'netzwerk@kgs-rastede.eu',
                    'subject'  => esc($data['name']) . ' fordert ein neues Passwort an',
                    'data'     => [
                        'text'   => "Name: <em>" . esc($data['name']) .
                        "</em><br>E-Mail: <em>" . esc($data['email']) .
                        "</em><br>Klasse: <em>" . esc($data['klasse']) .
                        "</em><br><br>IServ-Benutzername: <strong>" . esc($data['benutzername']) . "</strong>",
                        'sender' => esc($data['name'])
                    ]
                ]);

            } catch (Exception $error) {
                if(option('debug')):
                    $alert['error'] = 'Die Anfrage konnte nicht gesendet werden: <strong>' . $error->getMessage() . '</strong>';
                else:
                    $alert['error'] = 'Die Anfrage konnte <strong>nicht</strong> gesendet werden! Bitte schreiben Sie eine E-Mail an: netzwerk@kgs-rastede.eu um ihr Passwort zurück zu setzen.';
                endif;
            }

            // no exception occurred, let's send a success message
            if (empty($alert) === true) {
                $success = 'Die Anfrage zum Zurücksetzen vom Passwort wurde gesendet.';
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