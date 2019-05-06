<?php
namespace app\controller;
use app\model\RecipesManager;
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
    public function recipe($id)
    {
        try {
            if (isset($id) && $id > 0) {
                $recipesManager = new RecipesManager();

                $recipe = $recipesManager->getRecipe($id);
                if (is_null($recipe->getRecipeId())) {
                    throw new Exception('L\'identifiant de recette n\'existe pas.');
                } else {
                    echo $this->twig->render('recipe.twig', [
                        'recipe' => $recipe
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