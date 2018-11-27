<?php
/**
 * Created by PhpStorm.
 * User: Vanessa
 * Date: 11/27/2018
 * Time: 10:31 AM
 */
namespace Omnipay\Momoc;

use Omnipay\Omnipay;

$gateway = Omnipay::create('MomoMakePaymentRequestGateway');

var_dump($gateway->getDefaultParameters());