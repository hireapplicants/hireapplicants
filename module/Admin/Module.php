<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Admin;

use Zend\Session\Container;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\Authentication\AuthenticationService;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module implements AutoloaderProviderInterface, ConfigProviderInterface {

    public function onBootstrap(MvcEvent $e) {
        $eventManager = $e->getApplication()->getEventManager();
        $eventManager->attach(MvcEvent::EVENT_DISPATCH, array(
            $this,
            'boforeDispatch'
                ), 100);
    }

    function boforeDispatch(MvcEvent $event) {
        include 'config/constant.php';
        $response = $event->getResponse();
        $controller = $event->getRouteMatch()->getParam('controller');
        $module_array = explode("\\", $controller);
        if ($module_array[0] == 'Admin') {
            $action = $event->getRouteMatch()->getParam('action');
            $requestedResourse = $controller . "\\" . $action;
            $session = new Container('User');
            if ($session->offsetExists('user')) {
                if (in_array($requestedResourse, $GLOBALS['PAGE_BEFORE_LOGIN'])) {
                    $url = $GLOBALS['SITE_ADMIN_URL'] . 'dashboard';
                    $response->setHeaders($response->getHeaders()->addHeaderLine('Location', $url));
                    $response->setStatusCode(302);
                }
            } else {
                if ($requestedResourse != 'Admin\Controller\Index\index' && !in_array($requestedResourse, $GLOBALS['PAGE_BEFORE_LOGIN'])) {
                    $url = $GLOBALS['SITE_ADMIN_URL'] . 'index/login';
                    $response->setHeaders($response->getHeaders()->addHeaderLine('Location', $url));
                    $response->setStatusCode(302);
                }
                $response->sendHeaders();
            }
        }
    }

    public function getAutoloaderConfig() {
        //echo __DIR__ . '/autoload_classmap.php';die;
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }
    
    public function getServiceConfig() {
        return array(
            /*'factories' => array(
                'User\Model\UserTable' => function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $table = new \User\Model\UserTable($dbAdapter);
                    return $table;
                },
            ),*/
            'invokables' => array(
                'test_helper' => '\Admin\Helper\testHelper',
            ),                        
        );

    }
    public function getControllerConfig(){
        return array(
          'factories' =>array(
            'Admin\Controller\Index'=> function($sm){
                $table = new \Admin\Model\User();
                $indexObj = new \Admin\Controller\IndexController($table);
                return $indexObj;
            }
          ),       
        );
    }


    public function getViewHelperConfig() {
        return array(
            'invokables' => array(
                'test_helper' => new \Admin\Helper\testHelper,
            ),
        );

    }	
}
