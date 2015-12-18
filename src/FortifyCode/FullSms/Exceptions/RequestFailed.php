<?php
/**
 * District Software S.A.
 * Created by: nestor
 * At: 12/17/15 6:44 PM
 */

namespace FortifyCode\FortifyCode\FullSms\Exceptions;


use Exception;

class RequestFailed extends FullSmsException
{

    /**
     * @param string $provider
     * @param string $message
     * @param int $code
     * @param Exception|null $previous
     */
    public function __construct($provider = "", $message = "", $code = 0, Exception $previous = null)
    {
        parent::__construct($provider, $message, $code, $previous);
    }
}