<?php

return [
    'domain' => 'https://api.broadmail.de/http/',
    'mailing-list' => [
        'MAILING-LIST-NAME' => [
            'en' => [
                'id' => 'YOUR-MAILING-LIST-ID-IN-ENGLISH',
            ],
            'lang-code' => [
                'id' => 'YOUR-MAILING-LIST-ID-IN-ANY-LANGUAGE',
            ],
            'recipient-list' => [
                'id' => 'YOUR-RECIPIENT-LIST',
                'name' => 'YOUR-MAILING-LIST-NAME',
                'authorisation-code' => 'AUTHORIZE-CODE-BASED-ON-RECIPIENT-LIST',
            ],
            'required-params' => [
                'firstname',
                'lastname',
                'age',
                'message',
            ],
        ],
];
