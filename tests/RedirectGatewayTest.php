<?php
namespace Omnipay\Momoc;

use Omnipay\Tests\GatewayTestCase;

final class RedirectGatewayTest extends GatewayTestCase
{
    /** @var MomoMakePaymentRequestGateway */
    protected $gateway;

    /** @var array */
    private $options;

    public function setUp()
    {
        parent::setUp();

        $this->gateway = new MomoMakePaymentRequestGateway($this->getHttpClient(), $this->getHttpRequest());

        $this->options = [
            'idbouton' =>4,
            'typebouton' =>'PAIE',
            '_amount' => 2000.00,
            '_email' => 'larryakah@gmail.com',
            '_tel' => '678656032',
            '_cIP' => '',
            'submit.x' => 104,
            'submit.y' => 70,
            'currency' => 'XAF',
            'description' => 'Marina Run 2016',
            'transactionId' => 12,
            'returnUrl' => '',
            'notifyUrl' => ''
        ];
        $this->assertSame('larryakah@gmail.com', $this->gateway->getDefaultParameters()['_email']);
        $this->assertSame(2, $this->gateway->getDefaultParameters()['idbouton']);
        $this->assertSame('PAIE', $this->gateway->getDefaultParameters()['typebouton']);
        $this->assertInstanceOf(MomoMakePaymentRequestGateway::class, $this->gateway);
    }

    public function testPurchase()
    {
        $response = $this->gateway->purchase($this->options)->send();
        $this->assertFalse($response->isSuccessful());
        $this->assertTrue(!$response->isRedirect());
        //$this->assertEquals('https://developer.mtn.cm/OnlineMomoWeb/faces/transaction/transactionRequest.xhtml', $response->getRedirectUrl());

    }
}
