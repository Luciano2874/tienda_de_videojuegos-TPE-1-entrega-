<?php

require_once 'app/models/platforms.model.php';
require_once 'app/views/platforms.view.php';


class PlataformaController{
    private $Plataforma_model;
    private $Plataforma_view;


    public function __construct($res) {
        $this->Plataforma_model = new platformsModel();
        $this->Plataforma_view = new PlatformsView($res->user);
    
    }
    
    public function showAllPlatforms(){
        $platforms = $this->Plataforma_model->getPlatforms();
        $this->Plataforma_view->ShowPlatforms($platforms);
    }

    public function showPageManagePlatforms() {
        $platforms = $this->Plataforma_model->getPlatforms();

        return $this->Plataforma_view->showPageManagePlatforms($platforms);
    }

    public function showPageEditPlatform($id) {
        $platform = $this->Plataforma_model->getPlatformById($id);
        return $this->Plataforma_view->showPageEditPlatform($platform);
    }


    public function showIdPlatforms($id){
        $platform = $this->Plataforma_model->getPlatformById($id);
        $this->Plataforma_view->showIdPlatforms($platform);
    }
    public function addPlatform()
{ 
    print_r($_POST);
    if (!empty($_POST['plataforma'])) {
        $plataformas = $_POST ['plataforma'];
        $fabricante = $_POST ['fabricante'];
        $tipo = $_POST ['tipo'];
    } else {
        echo 'error';
        die();
    }
    $this->Plataforma_model->addPlatform($plataformas, $fabricante, $tipo);
    header('Location: ' . BASE_URL . "manage_platforms");
}

    public function removePlataform($id) {
    $this->Plataforma_model->deletePlataform($id);

    header("Location: " . BASE_URL . "manage_platforms");
    }

    public function editPlatform($id) {
        if(isset($_POST['plataforma']) && !empty($_POST['plataforma']) && isset($_POST['fabricante']) && !empty($_POST['fabricante'])&& isset($_POST['tipo']) && !empty($_POST['tipo'])) {
            $plataforma = $_POST['plataforma'];
            $fabricante = $_POST['fabricante'];
            $tipo = $_POST['tipo'];

            $this->Plataforma_model->updatePlatform($plataforma, $fabricante, $tipo, $id);

            header("Location: " . BASE_URL . "manage_platforms");
        } else {
            return $this->view->showError('Error!');
        }   
    }

}

