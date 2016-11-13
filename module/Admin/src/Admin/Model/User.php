<?php

namespace Admin\Model;

class User {
    public function __construct() {
        $this->cObj = new curl();
    }
    
    public function userAuthenticate($data, $method, $controller='usercontroller') {
        $action = isset($data['action'])?$data['action']:'';
        $queryStr = http_build_query($data);
        $url = NODE_API.$controller.'/'.$method.'?'.$queryStr;
        return $this->cObj->callCurl($url);
    }
    
}
