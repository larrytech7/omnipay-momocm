<?php
namespace Omnipay\Momoc\Message;

use Omnipay\Common\Message\RequestInterface;

class RedirectPurchaseResponse extends AbstractResponse{

    protected $headers = [];

    public function __construct(RequestInterface $req, $data, $headers = [] ){
        parent::__construct($req, $data);
        $this->request = $req;
        $this->data = json_decode($data, true);
        $this->headers = $headers;
    }

    public function isSuccessful()
    {
        return $this->data['StatusCode'] == '01'; //default was false
    }

    public function getTransactionId()
    {
        return $this->data['TransactionID'];
    }

    public function getReceiverNumber(){
        return $this->data['ReceiverNumber'];
    }

    public function getStatusCode(){
        return $this->data['StatusCode'];
    }

    public function getProcessingNumber(){
        return $this->data['ProcessingNumber'];
    }

    public function getComment()
    {
        return $this->data['OpComment'];
    }

    public function getStatusDesc()
    {
        return $this->data['StatusDesc'];
    }

    public function getOperationType()
    {
        return $this->data['OperationType'];
    }

    /**
     * returns the data response from the request
     * @return mixed
     */
    public function getMessage(){
        return $this->getData();
    }

    /**
     * @return mixed
     */
    public function getRedirectData()
    {
        return json_decode($this->getData(), true);
    }

}