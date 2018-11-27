<?php
namespace Omnipay\Momoc;

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
 * @method \Omnipay\Common\Message\RequestInterface completePurchase(array $options = array())
 */
class MomoMakePaymentRequestGateway extends AbstractGateway
{

    public function getName()
    {
        return 'MtnMomo';
    }

    public function getDefaultParameters()
    {
        return [
            'idbouton' => 2, //request config parameter
            'typebouton' => 'PAIE', // request config parameter
            '_email' => 'larryakah@gmail.com', //merchant email
        ];
    }

    public function getIdbouton(){
        return $this->getParameter('idbouton');
    }

    public function setIdbouton($id){
        return $this->setParameter('idbouton', $id);
    }

    public function getTypebouton(){
        return $this->getParameter('typebouton');
    }

    public function setTypebouton($type){
        return $this->setParameter('typebouton', $type);
    }

    public function getEmail(){
        return $this->getParameter('_email');
    }

    public function setEmail($email){
        return $this->setParameter('_email', $email);
    }

    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Momoc\Message\RedirectPurchaseRequest', $parameters);
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