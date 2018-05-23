<?php

namespace Omnipay\Paymanat\Message;

use Omnipay\Tests\TestCase;

class PurchaseRequestTest extends TestCase
{
    /**
     * @var PurchaseRequest
     */
    private $request;

    public function setUp()
    {
        parent::setUp();
        $this->request = new PurchaseRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->initialize([
            'partnerId'   => '12345',
            'currency'    => 'AZN',
            'voucherCode' => 1479473562,
            'description' => 'Test Transaction',
        ]);
    }

    public function testGetData()
    {
        $data = $this->request->getData();
        $this->assertSame(1479473562, $data['code']);
        $this->assertSame('12345', $data['pid']);
        $this->assertSame('Test Transaction', $data['info']);

        $this->request->setCurrency('EUR');
        $this->setExpectedException('Omnipay\Common\Exception\InvalidRequestException');
        $this->request->getData();
    }

    public function testSendDataSuccess()
    {
        $this->setMockHttpResponse('PurchaseSuccess.txt');
        $data = $this->request->getData();
        $response = $this->request->sendData($data);
        $this->assertInstanceOf('Omnipay\Paymanat\Message\PurchaseResponse', $response);
    }

    public function testSendDataFailure()
    {
        $this->setMockHttpResponse('PurchaseFailure.txt');
        $data = $this->request->getData();
        $response = $this->request->sendData($data);
        $this->assertInstanceOf('Omnipay\Paymanat\Message\PurchaseResponse', $response);
    }
}
