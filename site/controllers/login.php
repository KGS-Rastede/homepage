<?php

return function ($kirby) {
    // don't show the login screen to already logged in users
    if ($kirby->user()) {
        go('/');
    }

    $error = false;

    // handle the form submission
    if ($kirby->request()->is('POST') && get('login')) {
        // try to log the user in with the provided credentials
        try {
            $status = $kirby->auth()->authenticate('password', get('email'), get('password'));

            // Das Panel führt eine gegebenenfalls nötige zweite Anmeldung durch.
            if ($status instanceof \Kirby\Auth\Status && $status->is(\Kirby\Auth\State::Pending)) {
                go($kirby->url('panel'));
            }

            // redirect to the homepage if the login was successful
            go('/');
        } catch (Exception $e) {
            $error = true;
        }
    }

    return [
        'error' => $error,
    ];
};
