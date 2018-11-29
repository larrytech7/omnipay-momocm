<?php
namespace Omnipay\Momoc;

use Omnipay\Tests\GatewayTestCase;

final class GatewayTest extends GatewayTestCase
{
    /** @var Gateway */
    protected $gateway;

    /** @var array */
    private $options;

    public function setUp()
    {
        parent::setUp();

        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());

        $this->options = [
            'idbouton' =>4,
            'typebouton' =>'PAIE',
            '_amount' => 100.00,
            '_email' => 'larryakah@gmail.com',
            '_tel' => '675187568',
            '_cIP' => '',
            'submit.x' => 104,
            'submit.y' => 70,
            'currency' => 'XAF',
            'description' => 'Marina Run 2016',
        ];
        $this->assertSame('larryakah@gmail.com', $this->gateway->getDefaultParameters()['_email']);
        $this->assertSame(2, $this->gateway->getDefaultParameters()['idbouton']);
        $this->assertSame('PAIE', $this->gateway->getDefaultParameters()['typebouton']);
        $this->assertInstanceOf(Gateway::class, $this->gateway);
    }

    public function testPurchase()
    {
        $response = $this->gateway->purchase($this->options)->send();
        $this->assertFalse($response->isSuccessful());
    }
}
