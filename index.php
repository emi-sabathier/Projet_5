<?php
require 'vendor/autoload.php';
use app\controller\RecipesController;
$router = new \Bramus\Router\Router();

// Home
$router->get('/', function () {
    $recipesController = new RecipesController();
    $recipesController->listRecipes();
});

$router->mount('/recipes', function () use ($router) {
    $router->get('/', function () {
        $recipesController = new RecipesController();
        $recipesController->listRecipes();
    });
    $router->get('/(\d+)', function ($id) {
        $recipesController = new RecipesController();
        $recipesController->recipe($id);
    });
});

$router->run();

