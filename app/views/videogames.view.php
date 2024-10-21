<?php

class videogamesView {

    public $user = null;

    public function __construct($user) {
        $this->user = $user;
    }

    public function showHome() {
        require_once 'templates/home.phtml';
    }

    public function showAllVideogames($videogamesWithPlatforms) {
        require_once 'templates/list_of_videogames.phtml';
    }

    public function showDetailVideogame($videogame) {
        require_once 'templates/view_detail_game.phtml';
    }

    public function showPageManageVideogames($videogamesWithPlatforms, $platforms) {
        require_once 'templates/manage_videogames.phtml';
    }

    public function showPageEditVideogame ($videogame, $platforms) {
        require_once 'templates/edit_videogame.phtml';
    }

    public function showError($error) {
        require_once 'templates/error.phtml';
    }
}