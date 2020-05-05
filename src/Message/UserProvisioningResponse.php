<?php
namespace Omnipay\Momoc\Message;

class UserProvisioningResponse extends AbstractResponse{

    public function getComment(){
        return $this->data['OpComment'];
    }

    public function getStatusDesc(){
        return $this->data['StatusDesc'];
    }

    /**
     * returns the data response from the request
     * @return mixed
     */
    public function getMessage(){
        return $this->getData();
    }

}