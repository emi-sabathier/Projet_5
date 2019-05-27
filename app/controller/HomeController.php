<?php

namespace app\controller;

use app\model\CategoriesManager;
use app\model\RecipesManager;

class HomeController extends AppController
{
    public function displayHome() {
        $categoriesManager = new CategoriesManager();
        $listCategories = $categoriesManager->getCategories();

        echo $this->twig->render('home.twig', [
            'listCategories' => $listCategories
        ]);
    }
    public function homePagination(){
        $recipesManager = new RecipesManager();
        $nbRecipes = $recipesManager->countRecipes(); // 7
        $nbPages = ceil($nbRecipes / 4); // arrondi à 2 pages (contrairement à floor qui arrondi à 1 page)
        $page;
        for($i = 0; $i < $nbPages; $i++){

            echo 'Page ' . $i . ' ';
        }
    }
}