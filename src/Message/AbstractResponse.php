<?php
/**
 * Created by Akah
 * Date: 22/9/2018
 * Updated : 04/05/2020
 * Time: 2:16 PM
 */

namespace Omnipay\Momoc\Message;

use \Omnipay\Common\Message\AbstractResponse as BaseAbstractResponse;
use Omnipay\Common\Message\RequestInterface;

abstract class AbstractResponse extends BaseAbstractResponse{


    protected $headers = [];

    public function __construct(RequestInterface $req, $data, $headers){
        parent::__construct($req, $data);
        $this->request = $req;
        $this->data = json_decode($this->getData(), true);
        $this->headers = $headers;
    }

    /**
     * Is the response successful?
     *
     * @return boolean
     */
    public function isSuccessful(){
        //get request code
        $code = intval($this->getCode());
        return $code == 201;
    }

    /**
     * get the message part of the request result data
     * @return string
     */
    public function getMessage() {
        $data = $this->data;
        if(is_array($data)){
            return array_key_exists('message', $data) ? $data['message'] : 'No data';
        }
        return '';
    }

    /**
     * Get the request status description as an array of code and description
     * @return array|mixed
     */
    public function getRequestStatusDescription(){
        $code = intval($this->getCode());
        if($code == 400){
            return [
                'code' => $code,
                'message' => 'Bad request. Invalid data was sent'
            ];
        }else if($code == 409){
            return [
                'code' => $code,
                'message' => array_key_exists('message', $this->data) ? $this->data['message'] : 'Error in request. Result not processed properly.'
            ];
        }else if($code == 500){
            return [
                'code' => $code,
                'message' => 'Internal server Error in request. Result not processed properly.'
            ];
        }else{
            return $this->data;
        }
    }

}