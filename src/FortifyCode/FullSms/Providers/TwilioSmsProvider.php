<?php
/**
 * Author: Nestor Mata Cuthbert <nestor@profesional.co.cr>
 * Date: 7/6/15 4:15 PM
 */

namespace FortifyCode\FullSms\Providers;


use Illuminate\Support\Facades\Config;
use Services_Twilio;

class TwilioSmsProvider extends SmsProvider {
    private $client;
    private $default_from_number;

    function __construct() {
        $sid = Config::get('full-sms.twilio.sid');
        $token = Config::get('full-sms.twilio.token');
        $this->client = new Services_Twilio($sid, $token);
        $this->default_from_number = Config::get('full-sms.twilio.default_number');
    }

    public function sendSMS($to, $message, $from = null) {
        if (!$from) {
            $from = $this->default_from_number;
        }
        $message = $this->client->account->messages->sendMessage(
            $from, // From a valid Twilio number
            $to, // Text this number
            $message
        );
        if ($message) {
            return $message->sid;
        }
        return false;
    }


}