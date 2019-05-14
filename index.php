<?php
require 'vendor/autoload.php';

use app\controller\RecipesController;
use app\controller\UsersController;
use app\controller\CommentsController;

$router = new \Bramus\Router\Router();
define('BASEURL', 'http://localhost:8080/Projets/Projet_5');
session_start();


$router->get('/', function () {
    $recipesController = new RecipesController();
    $recipesController->listRecipes();
});
$router->mount('/recipes', function () use ($router) {
    $router->get('/', function () {
        $recipesController = new RecipesController();
        $recipesController->listRecipes();
    });

    $router->get('/id/(\d+)', function ($recipeId) {
        $recipesController = new RecipesController();
        $recipesController->recipe($recipeId);
    });

    $router->post('/id/(\d+)/postcomment', function ($recipeId) {
        $commentsController = new CommentsController();
        $commentsController->postComment($recipeId);
    });
});
$router->post('/reportcomment', function () {
    $commentsController = new CommentsController();
    $commentsController->reportComment();
});
$router->get('/authpage', function () {
    $usersController = new UsersController();
    $usersController->loginPage();
});
$router->get('/register', function () {
    $usersController = new UsersController();
    $usersController->registerPage();
});
$router->post('/newuser', function () {
    $usersController = new UsersController();
    $usersController->newUser();
});
$router->post('/login', function () {
    $usersController = new UsersController();
    $usersController->login();
});
$router->get('/disconnect', function () {
    $usersController = new UsersController();
    $usersController->disconnect();
});
// ADMIN
$router->mount('/admin', function () use ($router) {
    $router->get('/', function () {
        $usersController = new UsersController();
        $usersController->adminPanel();
    });
    $router->get('/category/(\d+)', function ($catId) {
        $recipesController = new RecipesController();
        $recipesController->listRecipesByCat($catId);
    });
    $router->post('/deleterecipe/', function () {
        $recipesController = new RecipesController();
        $recipesController->deleteRecipe();
    });
});
$router->run();
