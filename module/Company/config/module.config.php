<?php
 return array(
     'controllers' => array(
         'invokables' => array(
             //'Admin\Controller\Index' => 'Admin\Controller\IndexController',
             'Company\Controller\Dashboard' => 'Company\Controller\DashboardController',
         ),
     ),
 'router' => array(
        'routes' => array(
            'admin' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/company',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Company\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),                        
         ),
     
     ),
	 
     'view_manager' => array(
         'template_path_stack' => array(
             __DIR__ . '/../../../public/view',
         ),
        'template_map' => array(
            'layout/Dashboard'           => __DIR__ . '/../../../public/view/layout/admin.phtml',
        ),         
     ),
 );