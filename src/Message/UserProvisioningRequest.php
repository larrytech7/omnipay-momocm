<?php
namespace Omnipay\Momoc\Message;


class UserProvisioningRequest extends AbstractRequest{

    public function sendData($data){
        if(array_key_exists('amount', $data)){
            unset($data['amount']);
        }
        if(array_key_exists('hash_value', $data)){
            unset($data['hash_value']);
        }
        $endpointUrl = $this->getEndpoint();
        $body = json_encode($data);
        $response = $this->httpClient->request('POST',$endpointUrl,$this->getHeaders(), $body);
        return $this->response = new UserProvisioningResponse($this, $response->getBody()->getContents(),$this->getHeaders());
    }

    public function getData(){
        $data = [
            'providerCallbackHost' => $this->getProviderCallbackHost(),
            'amount' => $this->getAmount()
        ];

        $data['hash_value'] = $this->hashValue($data);

        return $data;
    }

    private function hashValue($data){
        $strToHash =
            $this->emptyIfNotFound($data, 'amount') .
            $this->emptyIfNotFound($data, 'providerCallbackHost');

        return strtoupper(hash_hmac('sha256', $strToHash, $this->getProviderCallbackHost(), false));
    }

    public function getEndpoint(){
        return ($this->getTestMode() ? $this->baseEndpoint['test'] :
            $this->baseEndpoint['live']). 'v1_0/apiuser';
    }
}