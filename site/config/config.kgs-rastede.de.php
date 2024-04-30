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
  ],

  'studyGroups' => [
    'url' => 'https://ag-wahl.kgsraste.de/api/v1/study_groups',
    'apiKey' => 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJBUElVU0VSIiwiaWF0IjoxNTE2MjM5MDIyfQ.CYrLWRa3dIURYyXjAW0FBfyiQK2C5mYoVeMY2clN_hY'
  ],

  'weather' => [
    'city' => 'Rastede',
    'apiKey' => '1c458b177407d2fb76d7d58720766dfe',
    'cacheFile' => 'assets/weather_cache.json'
  ]

];
