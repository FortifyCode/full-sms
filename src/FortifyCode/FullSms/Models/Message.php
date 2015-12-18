<?php
/**
 * District Software S.A.
 * Created by: nestor
 * At: 12/17/15 6:59 PM
 */

namespace FortifyCode\FortifyCode\FullSms\Models;


class Message
{
    const TYPE_SMS = 1;
    const TYPE_MMS = 2;

    const STATUS_DRAFT = 1;
    const STATUS_SENT = 2;
    const STATUS_RECEIVED = 3;
    const STATUS_DELETED = 4;


    protected $body;
    protected $type;
    protected $from;
    protected $to;
    protected $status;
    protected $information;

    /**
     * Creates a new message entity.
     *
     * @param string $body Body of the message
     * @param int $type Either SMS or MMS
     * @param PhoneNumber $from Sender number
     * @param PhoneNumber $to Receiving number
     * @param int $status Status of the message [draft|sent|received|deleted]
     * @param array $information Additional information, timestamps, etc
     */
    public function __construct($body = '', $type = self::TYPE_SMS, $from = null, $to = null, $status = self::STATUS_DRAFT, $information = [])
    {
        $this->body = $body;
        $this->type = $type;
        $this->from = $from;
        $this->to = $to;
        $this->status = $status;
        $this->information = $information;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param string $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param int $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return PhoneNumber|null
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @param PhoneNumber|null $from
     */
    public function setFrom($from)
    {
        $this->from = $from;
    }

    /**
     * @return PhoneNumber|null
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @param PhoneNumber|null $to
     */
    public function setTo($to)
    {
        $this->to = $to;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return array
     */
    public function getInformation()
    {
        return $this->information;
    }

    /**
     * @param array $information
     */
    public function setInformation($information)
    {
        $this->information = $information;
    }

}