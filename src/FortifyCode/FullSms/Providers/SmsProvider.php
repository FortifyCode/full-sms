<?php
/**
 * Author: Nestor Mata Cuthbert <nestor@profesional.co.cr>
 * Date: 7/6/15 4:13 PM
 */

namespace FortifyCode\FullSms\Providers;


abstract class SmsProvider {

    abstract public function sendSMS($to, $message, $from = null);
}