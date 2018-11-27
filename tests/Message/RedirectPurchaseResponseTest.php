<?php
namespace Omnipay\Momoc\Message;


use Omnipay\Tests\TestCase;

class RedirectPurchaseResponseTest extends TestCase
{
    public function testConstruct_ok()
    {
        $data = [
            'version' => '6.9',
            'merchant_id' => '874764000000130',
            'payment_description' => 'Marina Run 2015',
            'order_id' => 123,
            'invoice_no' => '',
            'amount' => '',
            'hash_value' => '',
            'customer_email'=>'xuding@spacebib.com'
        ];

        $request = $this->getMockRequest();
        $response = new RedirectPurchaseResponse($request, $data);

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertFalse($response->isCancelled());
        $this->assertNotNull($response->getMessage());
        $this->assertNull($response->getTransactionReference());
        $this->assertSame(123, $response->getTransactionId());
        $this->assertSame('', $response->getRedirectUrl());
        $this->assertSame('GET', $response->getRedirectMethod());
        $this->assertEquals($data, $response->getRedirectData());
    }
}
