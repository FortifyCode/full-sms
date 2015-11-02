<?php
/**
 * Configuration parameters for SMS
 */
return array(
    'default_provider' => 'twilio',
    'provider_aliases' => [
        'twilio' => 'FortifyCode\FullSms\Providers\TwilioSmsProvider',
        'nexmo' => 'FortifyCode\FullSms\Providers\NexmoSmsProvider',
    ],
    'twilio' => [
        'sid' => 'AC61326f96689a7ad5e61edd04ca2eb670',
        'token' => 'c202221268d1efbd47c8580e3881ec57',
        'default_number' => '+17656130961',
    ],
    'nexmo' => [
        'api_key' => 'eef2d0b3',
        'api_secret' => '6e6b7ae5',
        'default_number' => '+50672004393',
    ],
);