<?php
namespace app\controller;
use app\model\CategoriesManager;
use app\model\RecipesManager;

class CategoriesController extends AppController
{
    /**
     * List recipes of a category
     * Display in category view
     * Render $listRecipesByCat Object
     * @param [int] $categoryId
     */
    public function listRecipesByCat($categoryId){
        $recipesManager = new RecipesManager();
        $listRecipesByCat = $recipesManager->getRecipesByCat($categoryId);
        echo $this->twig->render('category.twig', [
            'listRecipesByCat' => $listRecipesByCat
        ]);
    }
}