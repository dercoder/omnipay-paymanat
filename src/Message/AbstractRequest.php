<?php

namespace Omnipay\Paymanat\Message;

/**
 * Class AbstractRequest
 *
 * @package Omnipay\Paymanat\Message
 */
abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    /**
     * @var string
     */
    protected $endpoint = 'https://paymanat.az/api';

    /**
     * Get Paymanat Partner ID.
     *
     * @return int
     */
    public function getPartnerId()
    {
        return $this->getParameter('partnerId');
    }

    /**
     * Set Paymanat Partner ID.
     *
     * @param int $value
     *
     * @return $this
     */
    public function setPartnerId($value)
    {
        return $this->setParameter('partnerId', $value);
    }

    /**
     * @param string $path
     *
     * @return string
     */
    protected function createUri($path)
    {
        return sprintf('%s/%s', $this->getEndpoint(), $path);
    }

    /**
     * @return string
     */
    protected function getEndpoint()
    {
        return $this->endpoint;
    }
}
