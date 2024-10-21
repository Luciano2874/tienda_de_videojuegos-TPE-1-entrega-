<?php

class PlatformsView{

    public $user = null;

    public function __construct($user) {
        $this->user = $user;
    }

    function ShowPlatforms($platforms){
        require_once 'templates/list_of_platforms.phtml';
            
    }

    public function showPageManagePlatforms($platforms) {
        require_once 'templates/manage_platforms.phtml';
    }

    public function showPageEditPlatform($platform) {
        require_once 'templates/edit_platform.phtml';
    }

    function showIdPlatforms($platforms){
        require_once 'templates/view_detail_plats.phtml';
    }


}