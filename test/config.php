<?php

return [

    // string which would be encrypted can has a pre
    'pre' => '',

    // string contrain a timestamp which can check the signature out of date of not
    'alive' => 60,

    'sign' => 'spider',

    // .ssh pub key file path
    'pubKeyFilePath' => '',

    // .ssh pri key file path
    'priKeyFilePath' => '',

    // generate key config
    'generate_key_config' => [
        'private_key_bits' => 1024
    ],
];
