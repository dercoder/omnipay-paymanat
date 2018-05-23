<?php

namespace Omnipay\Paymanat;

use Omnipay\Tests\GatewayTestCase;

class GatewayTest extends GatewayTestCase
{
    /**
     * @var Gateway
     */
    public $gateway;

    public function setUp()
    {
        parent::setUp();
        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());
        $this->gateway->setPartnerId('12345');
    }

    public function testPurchase()
    {
        $request = $this->gateway->purchase([
            'currency'    => 'AZN',
            'voucherCode' => 1388185689033560,
        ]);

        $this->assertInstanceOf('\Omnipay\Paymanat\Message\PurchaseRequest', $request);
        $this->assertSame('12345', $request->getPartnerId());
        $this->assertSame(1388185689033560, $request->getVoucherCode());
    }
}
