<?php
/**
 * Author: Nestor Mata Cuthbert <nestor@profesional.co.cr>
 * Date: 7/6/15 4:15 PM
 */

namespace FortifyCode\FullSms\Providers;


use Exception;
use FortifyCode\FullSms\Exceptions\RequestFailed;
use FortifyCode\FullSms\Models\PhoneNumber;
use Illuminate\Support\Facades\Config;
use Services_Twilio;

class TwilioSmsProvider extends SmsProvider
{
    /** @var Services_Twilio */
    private $client;
    private $default_from_number;

    function __construct($config = [])
    {
        $sid = isset($config['sid']) ? $config['sid'] : Config::get('full-sms.twilio.sid');
        $token = isset($config['token']) ? $config['token'] : Config::get('full-sms.twilio.token');
        $this->client = new Services_Twilio($sid, $token);
        $this->default_from_number = isset($config['default_number']) ? $config['default_number'] : null;
    }

    public function sendSMS($to, $message, $from = null)
    {
        if (!$from) {
            $from = $this->default_from_number;
        }
        try {
            $message = $this->client->account->messages->sendMessage(
                $from, // From a valid Twilio number
                $to, // Text this number
                $message
            );
            if ($message) {
                return $message->sid;
            }
        } catch(Exception $e) {
            throw new RequestFailed('twilio', 'Could not send number', 500, $e);
        }
        return false;
    }


    public function numbersAvailable($countryCode = "US", $areaCode = "", $regionCode = "")
    {
        $filterParams = array('SmsEnabled' => true);
        if (!empty($areaCode)) {
            $filterParams["AreaCode"] = $areaCode;
        }
        if (!empty($regionCode)) {
            $filterParams["InRegion"] = $regionCode;
        }

        try {
            $availableNumbers = $this->client->account->available_phone_numbers->getList($countryCode, 'Local', $filterParams);
        } catch (Exception $e) {
            throw new RequestFailed('twilio', 'Could not retrieve search of numbers', 501, $e);
        }

        $numbers = [];
        if (count($availableNumbers->available_phone_numbers) > 0) {
            foreach ($availableNumbers->available_phone_numbers as $number) {
                $numbers[] = $number->phone_number;
                $numbers[] = new PhoneNumber($number->phone_number, $number->iso_country, 'twilio');
            }
        }

        return $numbers;

    }

    public function buyNumber($phoneNumber, $country)
    {

        $result = null;
        try {
            if (!empty($phoneNumber)) {
                $this->client->account->incoming_phone_numbers->create(array(
                    'PhoneNumber' => $phoneNumber
                ));
            }
            $result = true;
        } catch (Exception $e) {
            throw new RequestFailed('twilio', 'Could not buy the number', 502, $e);
        }

        return $result;

    }


}