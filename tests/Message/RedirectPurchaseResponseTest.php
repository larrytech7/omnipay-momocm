<?php
namespace Omnipay\Momoc\Message;


use Omnipay\Tests\TestCase;

class RedirectPurchaseResponseTest extends TestCase
{
    public function testConstruct_ok()
    {
        $data = [
            'idbouton' =>4 ,
            'typebouton' =>'PAIE' ,
            '_amount' => 100.00,
            '_tel' => '678656032',
            'description' => 'Marina Run 2016',
            'currency' => 'XAF',
        ];

        $request = $this->getMockRequest();
        $response = new RedirectPurchaseResponse($request, $data);

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNotNull($response->getMessage());
        $this->assertNull($response->getTransactionReference());
        $this->assertSame('', $response->getRedirectUrl());
        $this->assertSame('GET', $response->getRedirectMethod());
        $this->assertEquals($data, $response->getRedirectData());
    }
}
