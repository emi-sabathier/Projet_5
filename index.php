<?php
require 'vendor/autoload.php';
use app\controller\RecipesController;
use app\controller\UsersController;
$router = new \Bramus\Router\Router();
define('BASEURL', 'http://localhost:8080/Projets/Projet_5');

//Home
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
	$router->get('/id/(\d+)', function ($id) {
		$recipesController = new RecipesController();
		$recipesController->recipe($id);
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

$router->run();
