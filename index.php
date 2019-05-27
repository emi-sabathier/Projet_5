<?php
require 'vendor/autoload.php';

use app\controller\HomeController;
use app\controller\RecipesController;
use app\controller\UsersController;
use app\controller\CommentsController;
use app\controller\CategoriesController;

$router = new \Bramus\Router\Router();
define('BASEURL', 'http://localhost:8080/Projets/Projet_5');
session_start();


$router->get('/', function () {
    $homeController = new HomeController();
    $homeController->displayHome();
    $homeController->homePagination();
});
$router->get('/displayRecipes', function () {
    $recipesController = new RecipesController();
    $recipesController->getRecipes();
});
$router->post('/search', function () {
    $recipesController = new RecipesController();
    $recipesController->searchRecipes();
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

    $router->post('/postcomment', function () {
        $commentsController = new CommentsController();
        $commentsController->postComment();
    });
});

$router->mount('/category', function () use ($router) {
    $router->get('/', function () {
        $categoriesController = new CategoriesController();
        $categoriesController->listCategories();
    });

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
    $router->get('/category/(\d+)', function ($catId) {
        $recipesController = new RecipesController();
        $recipesController->listRecipesByCat($catId);
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
$router->run();