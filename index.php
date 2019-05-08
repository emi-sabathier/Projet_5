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
$router->run();
