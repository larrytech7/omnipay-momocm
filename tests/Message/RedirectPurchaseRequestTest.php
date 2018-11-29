<?php
/**
 * Created by Akah
 * Date: 22/9/16
 * Time: 10:09 AM
 */

namespace Omnipay\Momoc\Message;

use Omnipay\Tests\TestCase;

class RedirectPurchaseRequestTest extends TestCase
{
    /**
     * @var RedirectPurchaseRequest
     */
    private $request;

    private $options;

    public function setUp()
    {
        $this->request = new RedirectPurchaseRequest($this->getHttpClient(), $this->getHttpRequest());

        $this->options = [
            'idbouton' =>4 ,
            'typebouton' =>'PAIE' ,
            '_amount' => 100.00,
            '_tel' => '675187568',
            'description' => 'Marina Run 2016',
            'currency' => 'XAF',
        ];
    }

    public function testGetData()
    {
        $this->request->initialize($this->options);

        $result = $this->request->getData();

        $expected = [
            'idbouton' => 4,
            'typebouton' => 'PAIE',
            '_amount' => 100.0,
            '_email' => 'larryakah@gmail.com',
            '_tel' => '675187568',
            'description' => 'Marina Run 2016',
            '_cIP' => '',
            'submit.x' => 104,
            'submit.y' => 70,
            'currency' => 'XAF',
        ];

        $this->assertEquals($expected, $result);
    }

    public function testSendData()
    {
        $this->request->initialize($this->options);

        $this->assertInstanceOf(
            RedirectPurchaseResponse::class,
            $this->request->sendData($this->request->getData())
        );
    }
}
