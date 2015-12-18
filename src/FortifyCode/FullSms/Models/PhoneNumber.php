<?php
/**
 * District Software S.A.
 * Created by: nestor
 * At: 12/17/15 6:58 PM
 */

namespace FortifyCode\FortifyCode\FullSms\Models;


class PhoneNumber
{
    protected $number;
    protected $country;
    protected $provider;

    /**
     * Creates a new phone number.
     *
     * @param string $number The phone number.
     * @param string $country The ISO 3166-1 alpha-2 country code of the phone number.
     * @param string $provider The provider of the number if known.
     */
    public function __construct($number, $country = null, $provider = null)
    {
        $this->number = $number;
        $this->country = $country;
        $this->provider = $provider;
    }

    /**
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param string $number
     */
    public function setNumber($number)
    {
        $this->number = $number;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * @return string
     */
    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * @param string $provider
     */
    public function setProvider($provider)
    {
        $this->provider = $provider;
    }


}