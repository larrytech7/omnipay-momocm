<?php
namespace Omnipay\Momoc\Message;


use Omnipay\Common\Message\AbstractResponse;

class RedirectPurchaseResponse extends AbstractResponse
{
    private $endPointTest = 'https://developer.mtn.cm/OnlineMomoWeb/faces/transaction/transactionRequest.xhtml?';
    private $endPointProduction = 'https://developer.mtn.cm/OnlineMomoWeb/faces/transaction/transactionRequest.xhtml?';

    public function isSuccessful()
    {
        return false;//$this->isSuccessful(); //default was false
    }

    public function isRedirect()
    {
        return true;//$this->isRedirect(); //DEFAULT was : true
    }

    public function getTransactionId()
    {
        $transaction_response = json_decode($this->getMessage());
        return $transaction_response['TransactionID']; //$this->getData()['order_id'];
    }

    public function getRedirectUrl()
    {
        return $this->getRedirectUrl();
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