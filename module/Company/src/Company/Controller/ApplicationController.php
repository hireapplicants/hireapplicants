<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Company\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;

class ApplicationController extends AbstractActionController {
    public $adapter;
    
    public function __construct() {
        $this->adapter = $this->getServiceLocator()->get('AdminDbAdapter');
    }
    
}
