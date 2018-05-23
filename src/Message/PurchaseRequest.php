<?php

namespace Omnipay\Paymanat\Message;

use Omnipay\Common\Exception\InvalidRequestException;

/**
 * Class PurchaseRequest
 *
 * @package Omnipay\Paymanat\Message
 */
class PurchaseRequest extends AbstractRequest
{
    /**
     * @return string
     */
    public function getVoucherCode()
    {
        return $this->getParameter('voucherCode');
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function setVoucherCode($value)
    {
        return $this->setParameter('voucherCode', $value);
    }

    /**
     * @return array
     * @throws InvalidRequestException
     */
    public function getData()
    {
        $this->validate(
            'partnerId',
            'voucherCode',
            'description',
            'currency'
        );

        if ($this->getCurrency() !== 'AZN') {
            throw new InvalidRequestException('Invalid currency. Only AZN is allowed!');
        }

        return [
            'pid'  => $this->getPartnerId(),
            'code' => $this->getVoucherCode(),
            'info' => $this->getDescription(),
        ];
    }

    /**
     * @param array $data
     *
     * @return PurchaseResponse
     */
    public function sendData($data)
    {
        $uri = $this->createUri('code/pay_to_balance');
        $response = $this->httpClient->post($uri, [], $data)->send();
        $data = unserialize($response->getBody(true));

        return new PurchaseResponse($this, $data);
    }
}
