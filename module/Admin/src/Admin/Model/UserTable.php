<?php

namespace Admin\Model;

class UserTable {
    public function __construct() {
        $this->cObj = new curl();
    }
    
    public function userAuthenticate($data, $controller='user') {
        $action = isset($data['action'])?$data['action']:'';
        $queryStr = http_build_query($data);
        echo $url = NODE_API.$controller.'/'.$action.'?'.$queryStr;die;
        return $this->cObj->callCurl($url);
    }
}
