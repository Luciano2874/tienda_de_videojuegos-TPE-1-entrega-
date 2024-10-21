<?php

require_once 'app/models/videogames.model.php';
require_once 'app/views/videogames.view.php';
require_once 'app/models/platforms.model.php';

class videogamesController {

    private $videogames_model;
    private $videogames_view;

    public function __construct($res){
        $this->videogames_model = new videogamesModel();
        $this->videogames_view = new videogamesView($res->user);

        $this->Plataforma_model = new platformsModel();
    }

    public function showHome(){
        return $this->videogames_view->showHome();
    }

    public function showAllVideogames() {
        $videogamesWithPlatforms = $this->videogames_model->getAllVideogamesWithPlatforms();

        return $this->videogames_view->showAllVideogames($videogamesWithPlatforms);
    }

    public function showDetailVideogame($id) {
        $videogame = $this->videogames_model->getVideogameById($id);
        return $this->videogames_view->showDetailVideogame($videogame);
    }

    public function showPageManageVideogames() {
        $platforms = $this->Plataforma_model->getPlatforms();
        $videogamesWithPlatforms = $this->videogames_model->getAllVideogamesWithPlatforms();

        return $this->videogames_view->showPageManageVideogames($videogamesWithPlatforms, $platforms);
    }

    public function showPageEditVideogame($id) {
        $platforms = $this->Plataforma_model->getPlatforms();
        $videogame = $this->videogames_model->getVideogameById($id);

        return $this->videogames_view->showPageEditVideogame($videogame, $platforms);
    }

    public function addVideogames() {
        if(isset($_POST['nombre']) && !empty($_POST['nombre']) && isset($_POST['desarrollador']) && !empty($_POST['desarrollador'])&& isset($_POST['distribuidor']) && !empty($_POST['distribuidor'])&&isset($_POST['genero']) && !empty($_POST['genero']) && isset($_POST['id_plataforma']) && !empty($_POST['id_plataforma']) && isset($_POST['fecha_lanzamiento']) && !empty($_POST['fecha_lanzamiento']) && isset($_POST['modos_de_juego']) && !empty($_POST['modos_de_juego']) && isset($_POST['precio']) && !empty($_POST['precio'])) {
            $nombre = $_POST['nombre'];
            $desarrollador = $_POST['desarrollador'];
            $distribuidor = $_POST['distribuidor'];
            $genero = $_POST['genero'];
            $id_plataforma = $_POST['id_plataforma'];
            $fecha_lanzamiento = $_POST['fecha_lanzamiento'];
            $modos_de_juego = $_POST['modos_de_juego'];
            $precio = $_POST['precio'];
    
            $id = $this->videogames_model->insertVideogames($nombre, $desarrollador, $distribuidor, $genero, $fecha_lanzamiento, $id_plataforma, $modos_de_juego, $precio);

            if ($id != 0) {
                header("Location: " . BASE_URL . "manage_videogames");
            } else {
                return $this->videogames_view->showError('Faltan datos obligatorios para añadir un nuevo item!');
            }
        } else {
            $this->videogames_view->showError('Error!');
        }
       
    }

    public function removeVideogame($id) {
        $this->videogames_model->deleteVideogame($id);

        header("Location: " . BASE_URL . "manage_videogames");
    }



    public function editVideogame($id) {
        if(isset($_POST['nombre']) && !empty($_POST['nombre']) && isset($_POST['desarrollador']) && !empty($_POST['desarrollador'])&& isset($_POST['distribuidor']) && !empty($_POST['distribuidor'])&&isset($_POST['genero']) && !empty($_POST['genero']) && isset($_POST['id_plataforma']) && !empty($_POST['id_plataforma']) && isset($_POST['fecha_lanzamiento']) && !empty($_POST['fecha_lanzamiento']) && isset($_POST['modos_de_juego']) && !empty($_POST['modos_de_juego']) && isset($_POST['precio']) && !empty($_POST['precio'])) {
            $nombre = $_POST['nombre'];
            $desarrollador = $_POST['desarrollador'];
            $distribuidor = $_POST['distribuidor'];
            $genero = $_POST['genero'];
            $id_plataforma = $_POST['id_plataforma'];
            $fecha_lanzamiento = $_POST['fecha_lanzamiento'];
            $modos_de_juego = $_POST['modos_de_juego'];
            $precio = $_POST['precio'];

            print_r($_POST);

            $this->videogames_model->updateVideogame($nombre, $desarrollador, $distribuidor, $genero, $fecha_lanzamiento, $id_plataforma, $modos_de_juego, $precio, $id);

            header("Location: " . BASE_URL . "manage_videogames");
        } else {
            return $this->videogames_view->showError('Error!');
        }   
    }
   
}