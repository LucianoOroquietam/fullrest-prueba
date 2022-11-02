<?php
require_once './libs/Router.php';
require_once './app/controllers/task-apiController.php';

// crea el router
$router = new Router();

// defina la tabla de ruteo
$router->addRoute('tasks', 'GET', 'apiController', 'getTasks');
$router->addRoute('task/:ID', 'GET', 'apiController', 'getTask');
$router->addRoute('tasks/:ID', 'DELETE', 'apiController', 'deleteTask');
$router->addRoute('task', 'POST', 'apiController', 'insertTask');
$router->addRoute('task/:ID', 'PUT', 'apiController', 'updateTask');

// ejecuta la ruta (sea cual sea)
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);
