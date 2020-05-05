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

    //used to create a new API user
    protected $apiUserCreateEndpoint = [
        'test' => 'https://sandbox.momodeveloper.mtn.com/v1_0/apiuser',
        'live' => ''
    ];
    //endpoint can be used to get api user info and to create api key
    protected $apiUserGetEndpoint = [
        'test' => 'https://sandbox.momodeveloper.mtn.com/v1_0/apiuser/',
        'live' => ''
    ];

    //configurable headers
    protected $headers = [
        'X-Reference-Id' => '',
        'Ocp-Apim-Subscription-Key' => '',
        'Content-Type' => 'application/json',
        'verify' => false
    ];

    abstract protected function getEndpoint();

    public function generateUuidV4(){
        // TODO : Implement v4 generate uuid
    }

    public function getHeaders(){
        return $this->headers;
    }

    public function setHeaders($headers){
        $this->headers = $headers;
    }

    public function getProviderCallbackHost(){
        return $this->getParameter('providerCallbackHost');
    }

    public function setProviderCallbackHost($callback){
        $this->setParameter('providerCallbackHost', $callback);
    }

    public function getCallback(){
        return $this->getParameter('providerCallbackHost');
    }

    public function setCallback($callback){
        $this->setParameter('providerCallbackHost', $callback);
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
        $this->httpClient = new Client([
            'base_uri' => $url,
            'headers' => $this->getHeaders()
        ]);
        $response = $this->httpClient->request('POST',$url,
            ['verify' => false,
                'timeout' => 130], json_encode($data));
        return $this->createResponse($response->getBody());
    }

    protected function createResponse($data){
        return $this->response = new UserProvisioningResponse($this, $data);
    }

    protected function emptyIfNotFound($haystack, $needle){
        return array_key_exists($needle, $haystack) ? $haystack[$needle] : '';
    }
}