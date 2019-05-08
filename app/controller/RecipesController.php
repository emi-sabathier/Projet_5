<?php
namespace app\controller;
use app\model\RecipesManager;
use app\model\CommentsManager;
use Exception;

class RecipesController extends AppController
{
    /**
     * Call getRecipes() from RecipesManager, + display the view
     */
    public function listRecipes()
    {
        $recipesManager = new RecipesManager();
        $listRecipes = $recipesManager->getRecipes();
        echo $this->twig->render('home.twig', ['listRecipes' => $listRecipes]);
    }
    /**
     * Call getRecipe() and getComments() from RecipesManager + CommentsManager if the verifications OK
     */
    public function recipe($recipeId)
    {
        try {
            if (isset($recipeId) && $recipeId > 0) {
                $recipesManager = new RecipesManager();
                $commentsManager = new CommentsManager();
                $recipe = $recipesManager->getRecipe($recipeId);
                $comment = $commentsManager->getComments($recipeId);

                if (is_null($recipe->getRecipeId())) {
                     echo 'L\'identifiant de recette n\'existe pas.';
                } else {
                    echo $this->twig->render('recipe.twig', [
                        'recipe' => $recipe,
                        'comments' => $comment
                    ]);
                }
            } else {
                throw new Exception('Les paramètres doivent être des nombres');
            }
        } catch (Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}