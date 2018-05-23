<?php

namespace Omnipay\Paymanat;

use Omnipay\Common\AbstractGateway;
use Omnipay\Common\Message\AbstractRequest;
use Omnipay\Paymanat\Message\PurchaseRequest;

/**
 * Class Gateway
 *
 * @package Omnipay\Paymanat
 */
class Gateway extends AbstractGateway
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'Paymanat';
    }

    /**
     * @return array
     */
    public function getDefaultParameters()
    {
        return [
            'partnerId' => '',
            'testMode'  => false,
        ];
    }

    /**
     * Get Paymanat Partner ID.
     *
     * @return string token
     */
    public function getPartnerId()
    {
        return $this->getParameter('partnerId');
    }

    /**
     * Set Paymanat Partner ID.
     *
     * @param string $value token
     *
     * @return $this
     */
    public function setPartnerId($value)
    {
        return $this->setParameter('partnerId', $value);
    }

    /**
     * @param array $parameters
     *
     * @return AbstractRequest|PurchaseRequest
     */
    public function purchase(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\Paymanat\Message\PurchaseRequest', $parameters);
    }
}
