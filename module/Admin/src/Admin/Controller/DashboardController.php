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
use Admin\Model\manageAdmin;

class DashboardController extends AbstractActionController {
    public function __construct() {
        $this->view =  new ViewModel();
        $this->session = new Container('User');
        $this->maObj = new manageAdmin();
    }
    
    public function addAction() {
        return $this->view;
    } 
    
    public function indexAction() {
        return $this->view;
    }
    
    public function saveSchoolAction() {
        $param = $this->getRequest()->getPost();
        $param['action'] = 'saveSchool';
        $response = json_decode($this->maObj->saveAdminDataApi($param));
        print_r($response);
        die;
        return $this->view;
    }    
}
