<?php

namespace Omnipay\Paymanat\Message;

use Omnipay\Common\Message\AbstractResponse;

/**
 * Class PurchaseResponse
 *
 * @package Omnipay\Paymanat\Message
 */
class PurchaseResponse extends AbstractResponse
{
    /**
     * @return bool
     */
    public function isSuccessful()
    {
        return $this->getCode() === '1';
    }

    /**
     * @return null|string
     */
    public function getCode()
    {
        return isset($this->data['success']) ? (string)$this->data['success'] : null;
    }

    /**
     * @return null|string
     */
    public function getMessage()
    {
        return isset($this->data['errors']) ? (string)$this->data['errors'] : null;
    }

    /**
     * @return null|string
     */
    public function getTransactionReference()
    {
        return $this->getSerialNumber();
    }

    /**
     * @return null|string
     */
    public function getDescription()
    {
        return isset($this->data['info']) ? (string)$this->data['info'] : null;
    }

    /**
     * @return null|string
     */
    public function getVoucherCode()
    {
        return isset($this->data['code']) ? (string)$this->data['code'] : null;
    }

    /**
     * @return null|string
     */
    public function getSerialNumber()
    {
        return isset($this->data['series']) ? (string)$this->data['series'] : null;
    }

    /**
     * @return null|float
     */
    public function getAmount()
    {
        return isset($this->data['amount']) ? (float)$this->data['amount'] : null;
    }
}
