<?php
namespace Omnipay\Momoc;

use Omnipay\Common\AbstractGateway;

/**
 * MTN Cameroon Mobile Money Gateway Driver for Omnipay
 *
 * This driver is based on the official MTNC momo payment Documentation
 * @link https://momodeveloper.mtn.com/
 */
class Gateway extends AbstractGateway{

    public function getName(){
        return 'MtnMomo';
    }

    public function getProviderCallbackHost(){
        return $this->getParameter('providerCallbackHost');
    }

    public function setProviderCallbackHost($callback){
        return $this->setParameter('providerCallbackHost', $callback);
    }

    /**
     * Set some gateway default data values
     * @return array
     */
    public function getDefaultParameters(){
        return [
            'providerCallbackHost' => 'http://localhost/ominipay-momo',
            'testMode' => true
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

    
}