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
);