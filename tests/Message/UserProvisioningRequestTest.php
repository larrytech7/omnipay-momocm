<?php
/**
 * Created by Akah
 * Date: 22/9/16
 * Time: 10:09 AM
 */

namespace Omnipay\Momoc\Message;

use Omnipay\Tests\TestCase;

class UserProvisioningRequestTest extends TestCase{

    /**
     * @var UserProvisioningRequest
     */
    private $request;

    private $options;

    public function setUp(){
        $this->request = new UserProvisioningRequest($this->getHttpClient(), $this->getHttpRequest());

        $this->options = [
            'providerCallbackHost' => 'http://localhost/ominipay-momo',
            'amount' => 100.00
        ];
       
        $this->request->initialize($this->options);
        $this->request->setTestMode(true);
        $this->request->setHeaders([
            'Ocp-Apim-Subscription-Key' => '8cca8a88bf5f40f7bd848b26344e879c',
            'Content-Type' => 'application/json'
        ]);
    }

    public function testGetData(){

        $result = $this->request->getData();

        $strToHash = '100' . 'http://localhost/ominipay-momo';

        $hash = strtoupper(hash_hmac('sha256', $strToHash, 'http://localhost/ominipay-momo', false));
        $expected = [
            'providerCallbackHost' => 'http://localhost/ominipay-momo',
            'amount' => 100.0,
            'hash_value' => $hash
        ];

        $this->assertEquals($expected, $result);
    }

    public function testSendData(){
        $this->testGetData();
        $this->assertInstanceOf(
            UserProvisioningResponse::class,
            $this->request->sendData($this->request->getData())
        );
    }

    public function testGetEndpoint(){
        $this->assertEquals('https://sandbox.momodeveloper.mtn.com/v1_0/apiuser', $this->request->getEndpoint());

        $this->request->setTestMode(false);
        $this->assertEquals('v1_0/apiuser', $this->request->getEndpoint());
    }
}
