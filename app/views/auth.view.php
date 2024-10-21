<?php

class authView {
    private $user = null;

    public function showLogin($error = '') {
        require_once 'templates/form_login.phtml';
    }

}