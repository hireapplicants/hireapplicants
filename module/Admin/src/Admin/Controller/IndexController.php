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

class IndexController extends AbstractActionController {
    protected $authservice;
    public function __construct($user) {
        $this->session = new Container('User');
        $this->userObj = $user;
    }
    
    public function indexAction() {
        
        $request = $this->getRequest();
        $view = new ViewModel();        
        if ($request->isPost()) {
            $params = array();
            $data = $request->getPost();
            $params['password'] = md5($data['password']);
            $params['username'] = $data['username'];
            $method = 'loginuser';
            $response = json_decode($this->userObj->userAuthenticate($params, $method));
            if ($response->status == 'success') {
                $this->session->offsetSet('user', $response);
                return $this->redirect()->toUrl($GLOBALS['SITE_ADMIN_URL'].'dashboard');
            } else {
                $this->flashMessenger()->addMessage(array('error' => 'invalid credentials.'));
            }              
        }
        return $this->redirect()->toUrl($GLOBALS['SITE_ADMIN_URL'].'index/login');
    }
    public function loginAction() {
        $viewModel = new ViewModel();
        return $viewModel;
    }
    public function logoutAction()
    {
        $this->session->offsetUnset('user');
        $this->redirect()->toUrl($GLOBALS['SITE_ADMIN_URL'].'index/login');
    }
}
