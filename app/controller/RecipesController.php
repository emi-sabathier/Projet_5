<?php

namespace app\controller;

use app\model\RecipesManager;
use app\model\CommentsManager;
use app\model\CategoriesManager;
use Exception;

class RecipesController extends AppController
{
    /**
     * Call getRecipes() from RecipesManager, + display the view
     */
    public function listRecipes()
    {
        $recipesManager = new RecipesManager();
        $categoriesManager = new CategoriesManager();
        $listRecipes = $recipesManager->getRecipes();
        $listCategories = $categoriesManager->getCategories();

        echo $this->twig->render('home.twig', [
            'listRecipes' => $listRecipes,
            'listCategories' => $listCategories
        ]);
    }

    public function recipe($recipeId, $compactVars = null)
    {
        if($compactVars == null) {
            if (isset($recipeId) && $recipeId > 0) {
                $recipesManager = new RecipesManager();
                $recipe = $recipesManager->getRecipe($recipeId);

                if ($recipe == false) {
                    echo 'L\'identifiant de recette n\'existe pas.';
                } else {
                    $commentsManager = new CommentsManager();
                    $comment = $commentsManager->getComments($recipeId);
                    echo $this->twig->render('recipe.twig', [
                        'recipe' => $recipe,
                        'comments' => $comment
                    ]);
                }
            } else {
                throw new Exception('Les paramètres doivent être des nombres');
            }
        } else {
            echo $this->twig->render('recipe.twig', $compactVars);
        }
    }
    public function listRecipesByCat($catId){
        $recipesManager = new RecipesManager();
        $recipesByCat = $recipesManager->getRecipesByCat($catId);
        echo $this->twig->render('adminCategories.twig', [
            'recipesByCat' => $recipesByCat
        ]);
    }

    public function deleteRecipe(){
//        echo json_encode([
//            'jambon' => '2',
//            'coppa' => '9'
////        ]);
//        var_dump($_POST);
        if(isset($_POST['recipeId'])) {
            $recipeId = (int) $_POST['recipeId'];
            if($recipeId != 0) {
                $recipesManager = new RecipesManager();
                $commentsManager = new CommentsManager();
                $recipesManager->deleteRecipe($recipeId);
                $commentsManager->deleteComments($recipeId);
                echo json_encode('success');
            } else {
                echo json_encode('error');
            }
        } else {
            echo json_encode('error');
        }
    }
}