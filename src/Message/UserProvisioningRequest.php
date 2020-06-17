<?php
namespace Omnipay\Momoc\Message;


class UserProvisioningRequest extends AbstractRequest{

    public function sendData($data){
        $this->setHeaders([
            'Authorization' => 'Basic ' . base64_encode($data['api_user'] . ':' . $data['api_key']),
            'Ocp-Apim-Subscription-Key' => $data['subscription_key'],
            'Content-Type' => 'application/json'
        ]);
        $this->removeFromArray('amount', $data);
        $this->removeFromArray('hash_value', $data);
        $this->removeFromArray('subscription_key', $data);
        $this->removeFromArray('api_user', $data);
        $this->removeFromArray('api_key', $data);
        $endpointUrl = $this->getEndpoint();
        $body = json_encode($data);

        $response = $this->httpClient->request('POST',$endpointUrl,$this->getHeaders(), $body);
        return $this->response = new UserProvisioningResponse($this, $response->getBody()->getContents(),$this->getHeaders());
    }

    public function getData(){
        $data = [
            'providerCallbackHost' => $this->getProviderCallbackHost(),
            'amount' => $this->getAmount(),
            'api_user' => '',
            'api_key' => '',
            'subscription_key' => '',
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

    /**
     * Removes an index from an array if exists
     *
     * @param mixed $needle the index to remove
     * @param array $haystack the array to remove from
     * @return void
     */
    private function removeFromArray($needle, &$haystack){
        if(array_key_exists($needle, $haystack)){
            unset($haystack[$needle]);
        }
    }
}