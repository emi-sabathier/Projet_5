<?php

namespace app\controller;

use app\model\CategoriesManager;

class HomeController extends AppController
{
    /**
     * Show recipes + categories infos on the homepage
     * Display home view + $listCategories object + pagesInfos object
     */
    public function displayHome()
    {
        $categoriesManager = new CategoriesManager();
        $recipesController = new RecipesController();

        $listCategories = $categoriesManager->getCategories();
        $pagesInfos = $recipesController->getRecipesByPage();

        echo $this->twig->render('home.twig', [
            'listCategories' => $listCategories,
            'pagesInfos' => $pagesInfos
        ]);
    }
}