<?php

return [
  // Damit bei Fehlern der Debugger angeht
  // https://getkirby.com/docs/cookbook/setup/debugging-basics

  // Auf dem echten Server muss der Debug-Modus aber aus sein! Das ist 
  // eine potentielle Sicherheitslücke:
  // https://getkirby.com/docs/guide/configuration#multi-enviroment-setup
  'debug'  => false,

  // 2fa aktivieren. Zuerst Passwort und dann den Code eingeben
  'auth' => [
    'methods' => [
      'password' => [
        '2fa' => true
      ],
      'code'
    ]
  ],


  'panel' => [
    'slug' => 'intern'
  ]
];
