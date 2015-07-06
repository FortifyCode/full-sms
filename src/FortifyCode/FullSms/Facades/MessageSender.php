<?php
/**
 * Author: Nestor Mata Cuthbert <nestor@profesional.co.cr>
 * Date: 7/6/15 4:38 PM
 */

namespace FortifyCode\FortifyCode\FullSms\Facades;


use Illuminate\Support\Facades\Facade;

class MessageSender extends Facade {

    protected static function getFacadeAccessor()
    {
        return 'messagesender';
    }
}