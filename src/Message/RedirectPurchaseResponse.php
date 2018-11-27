<?php
namespace Omnipay\Momoc\Message;


use Omnipay\Common\Message\AbstractResponse;

class RedirectPurchaseResponse extends AbstractResponse
{
    public function isSuccessful()
    {
        return json_decode($this->getMessage())['StatusCode'] == '01'; //default was false
    }

    public function isRedirect()
    {
        return false;//$this->isRedirect(); //DEFAULT was : true
    }

    public function getTransactionId()
    {
        $transaction_response = json_decode($this->getMessage());
        return $transaction_response['TransactionID']; //$this->getData()['order_id'];
    }

    public function getRedirectUrl()
    {
        return '';
    }

    public function getRedirectMethod()
    {
        return 'GET';
    }

    public function getRedirectData()
    {
        return $this->getData();
    }

}