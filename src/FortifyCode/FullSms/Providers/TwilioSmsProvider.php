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


    public function numbersAvailable($countryCode = "US", $areaCode = "", $regionCode = ""){

        $filterParams = array();
        if(!empty($areaCode)){
            $filterParams["AreaCode"] = $areaCode;
        }
        if(!empty($regionCode)){
            $filterParams["InRegion"] = $regionCode;
        }

        $avilableNumbers = $this->client->account->available_phone_numbers->getList($countryCode, 'Local', $filterParams);

        $numbers = [];
        if(count($avilableNumbers->available_phone_numbers) > 0){
            foreach($avilableNumbers->available_phone_numbers as $number){

                $numbers[] = $number->phone_number;

            }
        }

        return $numbers;

    }

    public function buyNumber($phoneNumber, $country = ""){

        $result = "";
        try {
            if(!empty($phoneNumber)) {
                $number = $this->client->account->incoming_phone_numbers->create(array(
                    'PhoneNumber' => $phoneNumber
                ));
            }
            $result = true;
        } catch (Exception $e) {
            $result = "Error: " . $e->getMessage();
        }

        return $result;

    }


}