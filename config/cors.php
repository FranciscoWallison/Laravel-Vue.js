<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Laravel CORS
    |--------------------------------------------------------------------------
    |
    | allowedOrigins, allowedHeaders and allowedMethods can be set to array('*')
    | to accept any value.
    |
    */
   
    'supportsCredentials' => false,
    'allowedOrigins' => ['http://192.168.5.121:3000','http://192.168.1.9:3000', 'chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop'],//endereçoes permitidos
    'allowedHeaders' => ['*'],//
    'allowedMethods' => ['*'],
    'exposedHeaders' => [],
    'maxAge' => 0,

];
