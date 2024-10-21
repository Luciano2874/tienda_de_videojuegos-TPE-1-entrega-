<?php 

require_once 'libs/response.php';
require_once 'app/middlewares/session.auth.middleware.php';
require_once 'app/middlewares/verify.auth.middleware.php';
require_once 'app/controllers/videogames.controller.php';
require_once 'app/controllers/platform.controller.php';
require_once 'app/controllers/auth.controller.php';
require_once 'config/config.php';

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$action = 'home';
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

$res = new Response();

$params = explode('/', $action);

switch ($params[0]) {
    case 'home':
        sessionAuthMiddleware($res);
        $controller = new videogamesController($res);
        $controller->showHome();
        break;
    case 'list_of_videogames':
        sessionAuthMiddleware($res);
        $controller = new videogamesController($res);
        $controller->showAllVideogames();
        break;
    case 'view_detail_game':
        sessionAuthMiddleware($res);
        $controller = new videogamesController($res);
        $id = $params[1];
        $controller->showDetailVideogame($id);
        break;
    case 'manage_videogames':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new videogamesController($res);
        if (!isset($params[1])) {
            $controller->showPageManageVideogames();
        } else if(isset($params[2])) {
            $id = $params[2];
            $controller->showPageEditVideogame($id);
        }
        break;
    case 'add_videogames':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new videogamesController($res);
        $controller->addVideogames();
        break;
    case 'delete_videogame':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new videogamesController($res);
        $id = $params[1];
        $controller->removeVideogame($id);
        break;
    case 'edit_videogame':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new videogamesController($res);
        $id = $params[1];
        $controller->editVideogame($id);
        break;
    case 'list_of_platforms':
        sessionAuthMiddleware($res);
        $controller = new PlataformaController($res);
        if (!isset($params[1])) {
            $controller->showAllPlatforms();
        } else {
            $controller->showVideogamesByPlatform($params[1]);
        }
        break;
    case 'view_games_by_platform':
        sessionAuthMiddleware($res);
        $controller = new PlataformaController($res);
        $controller->showIdPlatforms($params[1]);
        break;
    case 'manage_platforms':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new PlataformaController($res);
        if (!isset($params[1])) {
            $controller->showPageManagePlatforms();
        } else if(isset($params[2])) {
            $id = $params[2];
            $controller->showPageEditPlatform($id);
        }
        break;
    case 'add_platform':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new PlataformaController($res);
        $controller->addPlatform();
        break;
    case 'delete_platform':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new PlataformaController($res);
        $id = $params[1];
        $controller->removePlataform($id);
        break;
    case 'edit_platform':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new PlataformaController($res);
        $id = $params[1];
        $controller->editPlatform($id);
        break;
    case 'showLogin':
        $controller = new authController();
        $controller->showLogin();
        break;
    case 'login':
        $controller = new authController();
        $controller->login();
        break;
    case 'logout':
        $controller = new authController();
        $controller->logout();
        break;
    default:
        header("HTTP/1.1 404 Not Found");
        break;
}