<?php
return [
    /*
      |--------------------------------------------------------------------------
      | oAuth Config
      |--------------------------------------------------------------------------
     */

    /**
     * Storage
     */
    'storage' => '\\OAuth\\Common\\Storage\\Session',
    /**
     * Consumers
     */
    'consumers' => [
        'Facebook' => [
            'client_id' => '',
            'client_secret' => '',
            'scope' => [],
        ],
        'Google' => [
            'client_id' => '426586124483-l4gnl9dmatfr8p88nikj6rv0p2l7ku4v.apps.googleusercontent.com',
            'client_secret' => '2dxQ-fyO4xGVNdxHnvpYDTRZ',
            'scope' => ['userinfo_email', 'userinfo_profile'],
        ],
    ]
];
