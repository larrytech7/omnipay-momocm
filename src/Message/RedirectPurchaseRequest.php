<?php
namespace Omnipay\CreditCardPaymentProcessor\Message;


class RedirectPurchaseRequest extends AbstractRequest
{

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
            '_email' => $this->getMerchantEmail(),
            'submit.x' => $this->getX(),
            'submit.y' => $this->getY(),
            'result_url_1' => $this->getReturnUrl(),
            'result_url_2' => $this->getNotifyUrl(),
            //'customer_email' => $this->getCard()->getEmail()
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
            $this->emptyIfNotFound($data, 'currency') .
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
        //return $this->getA
    }

    public function sendData($data)
    {
        return $this->response = new RedirectPurchaseResponse($this, $data);
    }

}