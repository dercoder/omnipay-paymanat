<?php

namespace Omnipay\Paymanat\Message;

use Omnipay\Tests\TestCase;

class PurchaseResponseTest extends TestCase
{
    /**
     * @var PurchaseRequest
     */
    protected $request;

    public function setUp()
    {
        parent::setUp();
        $this->request = new PurchaseRequest($this->getHttpClient(), $this->getHttpRequest());
    }

    public function testSuccess()
    {
        $httpResponse = $this->getMockHttpResponse('PurchaseSuccess.txt');
        $data = unserialize($httpResponse->getBody(true));
        $response = new PurchaseResponse($this->request, $data);

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isCancelled());
        $this->assertFalse($response->isPending());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getCode());
        $this->assertNull($response->getMessage());
        $this->assertSame('Test Transaction', $response->getDescription());
        $this->assertNull($response->getTransactionId());
        $this->assertSame('90000003', $response->getTransactionReference());
        $this->assertSame('90000003', $response->getSerialNumber());
        $this->assertSame('1479473562', $response->getVoucherCode());
        $this->assertSame(5.00, $response->getAmount());
    }

    public function testFailure()
    {
        $httpResponse = $this->getMockHttpResponse('PurchaseFailure.txt');
        $data = unserialize($httpResponse->getBody(true));
        $response = new PurchaseResponse($this->request, $data);

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isCancelled());
        $this->assertFalse($response->isPending());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('1', $response->getCode());
        $this->assertSame('Code is incorrect', $response->getMessage());
        $this->assertNull($response->getTransactionId());
        $this->assertNull($response->getTransactionReference());
        $this->assertNull($response->getAmount());
    }
}
