<?php
namespace Admin\Model;

class manageAdmin{
    public function __construct() {
        $this->cObj = new curl();
    }    
    public function saveAdminDataApi($data) {
        $action = isset($data['action'])?$data['action']:'';
        $queryStr = http_build_query($data);
        $url = ADMIN_API.$action.'?'.$queryStr;die;
        return $this->cObj->callCurl($url);
    }  
}
