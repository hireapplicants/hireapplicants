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

class CommonController extends AbstractActionController {
    protected $authservice;
    public $session;
    public function __construct() {
        $this->view =  new ViewModel();
        $this->session = new Container('User');
        $this->commonObj = new common();     
    }
    
    public function userlistAction() {
        
        $request = $this->getRequest()->getQuery();
        $view = new ViewModel(); 
        if(isset($request["company_id"]) || isset($request["user_id"])){
            if(isset($request["company_id"])){
               $params['company_id'] = $request["company_id"];  
            }
            if(isset($request["user_id"])){
                $params['id'] = $request["user_id"]; 
            }
           
        }else{
            $errorArr = array();
            $errorArr['status'] = false;
            $errorArr['message'] = 'Please provide user id or company id';
            $response = json_decode($errorArr);
            print_r($response);die;
        }
        
        $method = 'getUserDetails';
        $response = $this->commonObj->curlhit($params,$method,'usercontroller');
        print_r($response);die;
    }
    
    public function deleteuserAction() {
        
        $request = $this->getRequest()->getQuery();
        $view = new ViewModel(); 
        $params['id'] = $request["user_id"];
        $method = 'deleteUser';
        $response = $this->commonObj->curlhit($params,$method,'usercontroller');
        print_r($response);die;
    }
     
    
}
