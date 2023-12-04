<?php

return function($kirby, $_pages, $page) {
    if ($kirby->request->is('POST')) {
        $data = [
            'firstName' => get('firstName'),
            'lastName' => get('lastName'),
            'postalCode' => get('postalCode'),
            'city' => get('city'),
            'street' => get('street'),
            'email' => get('email'),
            'accountOwner' => get('accountOwner'),
            'iban' => get('iban'),
            'bic' => get('bic'),
            'bank' => get('bank'),
            'fee' => get('fee')
        ];

        return [ 'submitted' => true, 'data' => $data ];
    } else {
        return [ 'submitted' => false ];
    }
};

?>