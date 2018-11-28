<?php
namespace Omnipay\Momoc\Message;


class RedirectPurchaseRequest extends AbstractRequest
{

    protected $requestEndpoint = 'https://developer.mtn.cm/OnlineMomoWeb/faces/transaction/transactionRequest.xhtml?';

    public function getData()
    {
        $data = [
            'version' => self::VERSION,
            'idbouton' => $this->getIdbouton(),
            'typebouton' => $this->getTypebouton(),
            'payment_description' => $this->getDescription(),
            '_tel' => $this->getTel(),
            '_amount' => $this->amount(),
            '_cIP' => $this->getCIP(),
            '_email' => $this->getEmail(),
            'submit.x' => $this->getX(),
            'submit.y' => $this->getY(),
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

    public function sendData($data)
    {
        $response = $this->httpClient->request('GET',$this->requestEndpoint.http_build_query($data), null, http_build_query($data));
        return $this->response = new RedirectPurchaseResponse($this, $response->getBody());
    }

}