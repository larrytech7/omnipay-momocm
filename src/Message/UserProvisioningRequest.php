<?php
namespace Omnipay\Momoc\Message;


use GuzzleHttp\Client;

class UserProvisioningRequest extends AbstractRequest{

    public function sendData($data){
        $endpointUrl = $this->getEndpoint();
        $this->httpClient = new Client([
            'base_uri' => $endpointUrl,
            'headers' => [
                'verify' => false
            ]
        ]);
        $response = $this->httpClient->request('POST',$endpointUrl,
            ['verify' => false,
                'timeout' => 130]);
        return $this->response = new UserProvisioningResponse($this, $response->getBody());
    }

    public function getData(){
        $data = [
            'providerCallbackHost' => $this->getCallback(),
            'amount' => $this->getAmount()
        ];

        $data['hash_value'] = $this->hashValue($data);

        return $data;
    }

    private function hashValue($data){
        $strToHash =
            $this->emptyIfNotFound($data, 'amount') .
            $this->emptyIfNotFound($data, 'providerCallbackHost');

        return strtoupper(hash_hmac('sha256', $strToHash, $this->getCallback(), false));
    }

    protected function getEndpoint(){
        return $this->getTestMode() ? $this->apiUserCreateEndpoint['test'] :
            $this->apiUserCreateEndpoint['live'];

    }
}