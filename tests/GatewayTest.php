<?php
namespace Omnipay\Momoc;

use Omnipay\Tests\GatewayTestCase;

final class GatewayTest extends GatewayTestCase
{
    /** @var Gateway */
    protected $gateway;

    /** @var array */
    private $options;

    public function setUp(){
        parent::setUp();

        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());
        $this->gateway->setTestMode(true);

        $this->options = [
            'providerCallbackHost' =>'http://localhost/ominipay-momo',
            'amount' => 100.00
        ];

        $this->assertTrue($this->gateway->getTestMode());
        $this->assertSame('http://localhost/ominipay-momo', $this->gateway->getDefaultParameters()['providerCallbackHost']);
        $this->assertInstanceOf(Gateway::class, $this->gateway);
    }

    public function testPurchase(){
        //$response = $this->gateway->purchase($this->options)->send();
        //$this->assertFalse($response->isSuccessful());
    }

    public function testAuthorize(){
        $response = $this->gateway->authorize($this->options)->send();
        $this->assertFalse($response->isSuccessful());
    }
}
