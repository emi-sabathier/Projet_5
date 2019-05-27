<?php
namespace app\controller;
use app\model\CategoriesManager;
use app\model\RecipesManager;

class CategoriesController extends AppController
{
    public function listCategories(){
        $categoriesManager = new CategoriesManager();
        $listCategories = $categoriesManager->getCategories();
        echo $this->twig->render('home.twig', [
            'listCategories' => $listCategories
        ]);
    }
    public function listRecipesByCat($categoryId){
        $recipesManager = new RecipesManager();
        $listRecipesByCat = $recipesManager->getRecipesByCat($categoryId);
        echo $this->twig->render('category.twig', [
            'listRecipesByCat' => $listRecipesByCat
        ]);
    }
}