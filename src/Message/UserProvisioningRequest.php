<?php
namespace Omnipay\Momoc\Message;


class UserProvisioningRequest extends AbstractRequest{

    public function sendData($data){
        $endpointUrl = $this->getEndpoint();
        $response = $this->httpClient->request('POST',$endpointUrl,$this->getHeaders(), '');
        return $this->response = new UserProvisioningResponse($this, $response->getBody());
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

    protected function getEndpoint(){
        return ($this->getTestMode() ? $this->baseEndpoint['test'] :
            $this->baseEndpoint['live']). 'v1_0/apiuser';
    }
}