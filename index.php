<?php
require 'vendor/autoload.php';
use app\controller\RecipesController;
use app\controller\CommentsController;
use app\controller\UsersController;
$router = new \Bramus\Router\Router();

// Home
$router->get('/', function () {
    $recipesController = new RecipesController();
    $recipesController->listRecipes();
});
// Recipes list + recipe id
$router->mount('/recipes', function () use ($router) {
    $router->get('/', function () {
        $recipesController = new RecipesController();
        $recipesController->listRecipes();
    });
    $router->get('/id/(\d+)', function () {
        $recipesController = new RecipesController();
        $commentsController = new CommentsController();
        $recipesController->recipe();
        $commentsController->postComment();
    });
});
// Login/register pages
$router->mount('/authpage', function () use ($router){
    $router->get('/', function(){
        $usersController = new UsersController();
        $usersController->loginPage();
    });
    $router->get('/register', function () {
        $usersController = new UsersController();
        $usersController->registerPage();
    });
});
$router->run();

