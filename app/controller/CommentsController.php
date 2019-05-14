<?php

namespace app\controller;
use app\model\CommentsManager;
use app\model\RecipesManager;
use app\model\UsersManager;

class CommentsController extends AppController
{
    public function postComment($recipeId)
    {
        if(isset($recipeId, $_SESSION['user']) && $recipeId > 0) {
            $errors = [];
            if($_SESSION['user']->getId() && !empty($_POST['comment']) && strlen(trim($_POST['comment'])) > 0) {
                $recipesManager = new RecipesManager();
                $recipe = $recipesManager->getRecipe($recipeId);

                if($recipe == true) {
                    $commentsManager = new CommentsManager();
                    $commentsManager->addComment($recipeId, $_SESSION['user']->getId(), $_POST['comment']);
                    header('Location:' . BASEURL . '/recipes/id/' . $recipeId);
                    exit;
                } else {
                    $errors['noRecipe'] = true;
                }
            } else {
                $errors['invalidComment'] = true;
            }
            if(!empty($errors)) {
                $this->recipe(compact('errors'));
            }
        } else {
            echo $this->twig->render('recipe.twig');
        }
    }
    public function reportComment(){
        if(isset($_POST['commentId'])) {
            // si int : transforme en nombre entier peu importe ce que contient la var
            // si string, transforme en 0
            $commentId = (int) $_POST['commentId'];
            if($commentId != 0) {
                $commentsManager = new CommentsManager();
                $commentsManager->reportComment($commentId);
                echo json_encode('success');
            } else {
                echo json_encode('error');
            }
        } else {
            echo json_encode('error');
        }
    }
    public function deleteComment(){
        if(isset($_POST['commentId'])) {
            // si int : transforme en nombre entier peu importe ce que contient la var
            // si string, transforme en 0
            $commentId = (int) $_POST['commentId'];
            if($commentId != 0) {
                $commentsManager = new CommentsManager();
                $commentsManager->reportComment($commentId);
                echo json_encode('success');
            } else {
                echo json_encode('error');
            }
        } else {
            echo json_encode('error');
        }
    }
}