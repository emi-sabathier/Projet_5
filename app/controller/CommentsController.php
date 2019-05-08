<?php

namespace app\controller;
use app\model\CommentsManager;
use app\model\RecipesManager;

class CommentsController extends AppController
{
    public function postComment($recipeId)
    {
        if(isset($recipeId) && $recipeId > 0) {
            $errors = [];
            if($_SESSION['id'] && !empty($_POST['comment']) && strlen(trim($_POST['comment'])) > 0) {
                $recipesManager = new RecipesManager();
                $recipe = $recipesManager->getRecipe($recipeId);

                if($recipe == true) {
                    $commentsManager = new CommentsManager();
                    $commentsManager->addComment($recipeId, $_SESSION['id'], $_POST['comment']);
                    header('Location:' . BASEURL . '/recipes/id/' . $recipeId);
                    exit;
                } else {
                    $errors['no_recipe'] = true;
                }
            } else {
                $errors['invalid_comment'] = true;
            }
            if(!empty($errors)) {
                $this->recipe(compact('errors'));
            }
        } else {

        }
    }
}