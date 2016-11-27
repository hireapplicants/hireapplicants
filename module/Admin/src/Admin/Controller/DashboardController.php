<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;
use Admin\Model\common;

class DashboardController extends AbstractActionController {
    public function __construct() {
        $this->view =  new ViewModel();
        $this->session = new Container('User');
        $this->commonObj = new common();
    }
    
    public function countrylistAction() {
        $countryListResponse = $this->commonObj->curlhit('', 'getcountrylist');
        $countryList = json_decode($countryListResponse, true);
        if($countryList['status']){
            $this->view->countryList = $countryList['data'];
        }
        return $this->view;
    } 

    public function statelistAction() {
        $stateListResponse = $this->commonObj->curlhit('', 'getstatelist');
        $stateList = json_decode($stateListResponse, true);
        if($stateList['status']){
            $this->view->stateList = $stateList['data'];
        }
        return $this->view;
    }
    
    public function indexAction() {
        return $this->view;
    }    
        
    public function priceAction() {
        return $this->view;
    } 
        
    public function pricesaveAction() 
            {
    $request = $this->getRequest()->getPost();
    $params = array();
$params["monthly_service"] = $request["monthly_service"];
$params["phone_number"] = $request["phone_number"]; 
$params["sms_pack_price"] =$request["sms_pack_price"];
$params["nbr_of_sms_in_pack"] = $request["nbr_of_sms_in_pack"]; 
$params["free_sms"] = $request["free_sms"]; 
$SavePrice = $this->commonObj->curlhit($params, 'pricesave');


$priceListResponse = $this->commonObj->curlhit('', 'getpricelist');
        $priceList = json_decode($priceListResponse, true);
        if($priceList['status']){
            $this->view->priceList = $priceList['data'];
        }
   print_r($SavePrice);
  return $this->view;
      
    } 

}
