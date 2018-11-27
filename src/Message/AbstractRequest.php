<?php
/**
 * Created by Akah
 * Date: 22/9/2018
 * Time: 2:16 PM
 */

namespace Omnipay\Momoc\Message;


abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    const VERSION = '6.9';

    public function getEmail(){
        return $this->getParameter('_email');
    }

    public function setEmail($email){
        return $this->setParameter('_email', $email);
    }

    public function getIdbouton()
    {
        return $this->getParameter('idbouton');
    }

    public function setIdbouton($btnID)
    {
        return $this->setParameter('idbouton', $btnID);
    }

    public function getTypebouton(){
        return $this->getParameter('typebouton');
    }

    public function setTypebouton($type){
        return $this->setParameter('typebouton', $type);
    }

    public function getCIP(){
        return $this->getParameter('_cIP');
    }

    public function getTel(){
        return $this->getParameter('_tel');
    }

    public function setTel($tel){
        return $this->setParameter('_tel', $tel);
    }

    public function setcIP($cip){
        return $this->setParameter('_cIP', $cip);
    }

    public function getAmount(){
        return $this->getParameter('_amount');
    }

    public function setAmount($amt){
        return $this->setParameter('_amount', $amt);
    }

    public function setX($x){
        return $this->setParameter('submit.x', $x);
    }

    public function getX(){
        return $this->getParameter('submit.x');
    }

    public function setY($y){
        return $this->setParameter('submit.y', $y);
    }

    public function getY(){
        return $this->getParameter('submit.y');
    }

    public function getData()
    {
        $this->validate(
            'idbouton',
            'typebouton',
            '_cIP',
            '_tel',
            '_amount',
            '_email',
            'submit.x',
            'submit.y',
            'returnUrl',
            'notifyUrl'
        );
    }

    protected function emptyIfNotFound($haystack, $needle)
    {
        if (!isset($haystack[$needle])) {
            return '';
        }
        return $haystack[$needle];
    }
}