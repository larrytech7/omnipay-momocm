<?php
namespace Omnipay\CreditCardPaymentProcessor;

use Omnipay\Common\AbstractGateway;

/**
 * MTN Cameroon Mobile Money Gateway Driver for Omnipay
 *
 * This driver is based on the official MTNC momo payment Documentation
 * @link https://developer.mtncameroon.net/OnlineMomoWeb/console/download/ITG_MTN_PR160104_USER_GUIDE_MERCHANT_v1.7.pdf
 * @method \Omnipay\Common\Message\RequestInterface authorize(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface completeAuthorize(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface capture(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface refund(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface void(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface createCard(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface updateCard(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface deleteCard(array $options = array())
 */
class MomoMakePaymentRequestGateway extends AbstractGateway
{

    public function getName()
    {
        return 'MomoRequestPayment Redirect';
    }

    public function getDefaultParameters()
    {
        return [
            'idbouton' => 2, //
            'typebouton' => 'PAIE', //
        ];
    }

    public function getMerchantEmail(){
        return $this->getParameter('_email');
    }

    public function setMerchantEmail($email){
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

    public function setcIP($cip){
        return $this->setParameter('_cIP', $cip);
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

    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\CreditCardPaymentProcessor\Message\RedirectPurchaseRequest', $parameters);
    }

    public function completePurchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\CreditCardPaymentProcessor\Message\RedirectCompletePurchaseRequest', $parameters);
    }

    function __call($name, $arguments)
    {
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface authorize(array $options = array())
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface completeAuthorize(array $options = array())
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface capture(array $options = array())
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface refund(array $options = array())
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface void(array $options = array())
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface createCard(array $options = array())
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface updateCard(array $options = array())
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface deleteCard(array $options = array())
    }
}