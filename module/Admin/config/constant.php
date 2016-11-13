<?php
$GLOBALS['SITE_ADMIN_URL'] = 'http://' .$_SERVER['HTTP_HOST'].'/hireapplicants/admin/';
$GLOBALS['PAGE_BEFORE_LOGIN'] = array('Admin\Controller\Index\login','Admin\Controller\Index\index');
define('NODE_API', 'http://localhost:3000/');