<?php
namespace Omnipay\Momoc;

use Omnipay\Common\AbstractGateway;

/**
 * MTN Cameroon Mobile Money Gateway Driver for Omnipay
 *
 * This driver is based on the official MTNC momo payment Documentation
 * @link https://momodeveloper.mtn.com/
 * @method \Omnipay\Common\Message\RequestInterface completeAuthorize(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface capture(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface refund(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface void(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface createCard(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface updateCard(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface deleteCard(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface completePurchase(array $options = array())
 * @method \Omnipay\Common\Message\NotificationInterface acceptNotification(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface fetchTransaction(array $options = [])
 */
class Gateway extends AbstractGateway{

    public function getName(){
        return 'MtnMomo';
    }

    public function getProviderCallbackHost(){
        return $this->getParameter('providerCallbackHost');
    }

    public function setProviderCallbackHost($callback){
        $this->setParameter('providerCallbackHost', $callback);
    }

    /**
     * Set some gateway default data values
     * @return array
     */
    public function getDefaultParameters(){
        return [
            'providerCallbackHost' => 'http://localhost/ominipay-momo'
        ];
    }

    /**
     * Initiate an authorized payment with MTN Momo
     * @param array $params ata to initiate authorization
     */
    public function authorize(array $params = array()){
        //initiate request to get api user, api key and token
        return $this->createRequest('\Omnipay\Momoc\Message\UserProvisioningRequest', $params);
    }

    public function purchase(array $parameters = array()){
        return $this->createRequest('\Omnipay\Momoc\Message\RedirectPurchaseRequest', $parameters);
    }

    function __call($name, $arguments)
    {
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface completeAuthorize(array $options = array())
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface capture(array $options = array())
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface refund(array $options = array())
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface void(array $options = array())
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface createCard(array $options = array())
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface updateCard(array $options = array())
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface deleteCard(array $options = array())
    }
}