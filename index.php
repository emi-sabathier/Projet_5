<?php
require 'vendor/autoload.php';

use app\controller\AppController;
use app\controller\CategoriesController;
use app\controller\CommentsController;
use app\controller\HomeController;
use app\controller\RecipesController;
use app\controller\UsersController;

$router = new \Bramus\Router\Router();
define('BASEURL', 'http://localhost:8080/Projets/Projet_5');
session_start();

$router->get('/', function () {
	$homeController = new HomeController();
	$homeController->displayHome(); // view home twig
});
$router->post('/page', function () {
	$recipesController = new RecipesController();
    $recipesController->getRecipesByPage();
});
$router->post('/search', function () {
    $recipesController = new RecipesController();
	$recipesController->searchRecipes();
});
$router->get('/displayLastRecipes', function () {
	$recipesController = new RecipesController();
	$recipesController->getLastRecipesHome();
});
$router->get('/id/(\d+)', function ($recipeId) {
	$recipesController = new RecipesController();
	$recipesController->recipe($recipeId);
});
$router->post('/postcomment', function () {
	$commentsController = new CommentsController();
	$commentsController->postComment();
});
$router->mount('/category', function () use ($router) {
	$router->get('/id/(\d+)', function ($categoryId) {
		$categoriesController = new CategoriesController();
		$categoriesController->listRecipesByCat($categoryId);
	});
});
$router->post('/reportcomment', function () {
	$commentsController = new CommentsController();
	$commentsController->reportComment();
});
$router->get('/authform', function () {
	$usersController = new UsersController();
	$usersController->loginForm();
});
$router->get('/register', function () {
	$usersController = new UsersController();
	$usersController->registerForm();
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
    $router->post('/page', function () {
        $usersController = new UsersController();
        $usersController->getRecipesByPageAdmin();
    });
	$router->get('/displayLastRecipesAdmin', function () {
		$recipesController = new RecipesController();
        $recipesController->getLastRecipesAdmin();
	});
	$router->get('/category/(\d+)', function ($catId) {
		$recipesController = new RecipesController();
		$recipesController->listRecipesByCat($catId);
	});
	$router->get('/listcomments/(\d+)', function ($recipeId) {
		$commentsController = new CommentsController();
		$commentsController->listComments($recipeId);
	});
	$router->get('/recipeform', function () {
		$recipesController = new RecipesController();
		$recipesController->createRecipeForm();
	});
	$router->post('/createrecipe', function () {
		$recipesController = new RecipesController();
		$recipesController->createRecipe();
	});
	$router->all('/updateform/(\d+)', function ($recipeId) {
		$recipesController = new RecipesController();
		$recipesController->updateRecipe($recipeId);
	});
	$router->post('/deleterecipe', function () {
		$recipesController = new RecipesController();
		$recipesController->deleteRecipe();
	});
	$router->post('/deletecomment', function () {
		$commentsController = new CommentsController();
		$commentsController->deleteComment();
	});
	$router->post('/resetreport', function () {
		$commentsController = new CommentsController();
		$commentsController->resetReportedComment();
	});
});
$router->set404(function () {
	header('HTTP/1.1 404 Not Found');
	$appController = new AppController();
	$appController->errorPage();
});
$router->run();