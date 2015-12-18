<?php
/**
 * FortifyCode
 * Created by: nestor
 * At: 12/17/15 6:40 PM
 */

namespace FortifyCode\FullSms\Exceptions;


use Exception;

class FullSmsException extends Exception
{
    protected $provider;

    /**
     * FullSmsException constructor.
     * @param string $provider
     * @param string $message
     * @param int $code
     * @param Exception $previous
     */
    public function __construct($provider = "", $message = "", $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->provider = $provider;
    }
}