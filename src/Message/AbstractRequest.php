<?php
/**
 * Created by Akah
 * Date: 22/9/2018
 * Time: 2:16 PM
 */

namespace Omnipay\Momoc\Message;

use Omnipay\Common\Http\Client;
use \Omnipay\Common\Message\AbstractRequest as BaseAbstractRequest;

abstract class AbstractRequest extends BaseAbstractRequest{

    const VERSION = '1.1';

    protected $baseEndpoint = [
        'test' => 'https://sandbox.momodeveloper.mtn.com/',
        'live' => ''
    ];

    //configurable headers
    protected $headers = [
        'Ocp-Apim-Subscription-Key' => '8cca8a88bf5f40f7bd848b26344e879c',
        'Content-Type' => 'application/json',
        'verify' => false
    ];

    abstract protected function getEndpoint();

    public function generateUuidV4(){
        // v4 generate uuid
        if (function_exists('com_create_guid') === true)
			return trim(com_create_guid(), '{}');
	
			$data = openssl_random_pseudo_bytes(16);
			$data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
			$data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10
			return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }

    public function getHeaders(){
        return $this->headers;
    }

    public function setHeaders($headers){
        $this->headers = $headers;
        $this->headers['X-Reference-Id'] = $this->generateUuidV4();
    }

    public function getProviderCallbackHost(){
        return $this->getParameter('providerCallbackHost');
    }

    public function setProviderCallbackHost($callback){
        $this->setParameter('providerCallbackHost', $callback);
    }

    public function setTestMode($value){
        $this->setParameter('testMode', $value);
    }

    public function getTestMode(){
        return $this->getParameter('testMode');
    }

    public function getTel(){
        return $this->getParameter('_tel');
    }

    public function setTel($tel){
        return $this->setParameter('_tel', $tel);
    }

    public function getAmount(){
        return $this->getParameter('amount');
    }

    public function setAmount($amt){
        return $this->setParameter('amount', $amt);
    }

    public function sendData($data){
        $url = $this->getEndpoint();
        $response = $this->httpClient->request('POST',$url,$this->getHeaders(), json_encode($data));
        return $this->createResponse($response->getBody());
    }

    protected function createResponse($data){
        return $this->response = new UserProvisioningResponse($this, $data);
    }

    protected function emptyIfNotFound($haystack, $needle){
        return array_key_exists($needle, $haystack) ? $haystack[$needle] : '';
    }
}