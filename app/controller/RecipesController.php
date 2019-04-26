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
     * Call getRecipe() from RecipesManager if the verifications OK
     */
    public function recipe()
    {
        try {
            if (isset($this->id) && $this->id > 0) {
                $recipesManager = new RecipesManager();
                $commentsManager = new CommentsManager();

                $recipe = $recipesManager->getRecipe($this->id);
                $listComments = $commentsManager->getComments($this->id);
                if (is_null($recipe->getRecipeId())) {
                    throw new Exception('L\'identifiant de recette n\'existe pas.');
                } else {
                    echo $this->twig->render('recipe.twig', [
                        'recipe' => $recipe,
                        'listComments' => $listComments
                    ]);
                }
            } else {
                throw new Exception('Les paramètres doivent être des nombres');
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}