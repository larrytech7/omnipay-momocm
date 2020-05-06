<?php
namespace Omnipay\Momoc\Message;

use GuzzleHttp\Client;

class RedirectPurchaseRequest extends \Omnipay\Common\Message\AbstractRequest{

    protected $requestEndpoint = 'https://developer.mtn.cm/OnlineMomoWeb/faces/transaction/transactionRequest.xhtml?';

    public function getData(){
        $data = [
            'payment_description' => $this->getDescription(),
            'result_url_1' => $this->getReturnUrl(),
            'result_url_2' => $this->getNotifyUrl()
        ];

        $data['hash_value'] = $this->hashValue($data);

        return $data;
    }

    private function hashValue($data)
    {
        $strToHash =
            $this->emptyIfNotFound($data, 'version') .
            $this->emptyIfNotFound($data, 'idbouton') .
            $this->emptyIfNotFound($data, 'payment_description') .
            $this->emptyIfNotFound($data, 'typebouton') .
            $this->emptyIfNotFound($data, '_cIP') .
            $this->emptyIfNotFound($data, '_amount') .
            $this->emptyIfNotFound($data, '_email') .
            $this->emptyIfNotFound($data, 'submit.x') .
            $this->emptyIfNotFound($data, 'submit.y') .
            $this->emptyIfNotFound($data, 'result_url_1') .
            $this->emptyIfNotFound($data, 'default_lang');

        return strtoupper(hash_hmac('sha1', $strToHash, $this->getCIP(), false));
    }

    private function amount()
    {
        return str_pad($this->getAmount(), 12, '0', STR_PAD_LEFT);
    }

    public function sendData($data){
        $this->httpClient = new Client([
            'base_uri' => $this->requestEndpoint,
            'headers' => [
                'verify' => false
            ]
        ]);
        $response = $this->httpClient->request('GET',$this->requestEndpoint.http_build_query($data),
            ['verify' => false,
                'timeout' => 130]);
        return $this->response = new RedirectPurchaseResponse($this, $response->getBody());
    }

}