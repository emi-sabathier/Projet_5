<?php
namespace app\controller;
use app\model\CategoriesManager;

class CategoriesController extends AppController
{
    public function listCategories(){
        $categoriesManager = new CategoriesManager();
        $categoriesManager->getCategories();
        echo $this->twig->render('home.twig', [
            'listRecipes' => $listRecipes,
            'listReportedComments' => $listReportedComments
        ]);
    }
}