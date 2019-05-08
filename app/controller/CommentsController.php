<?php

namespace app\controller;
use app\model\CommentsManager;

class CommentsController extends AppController
{
    public function postComment($recipeId)
    {
        $commentsManager = new CommentsManager();
        $commentsManager->addComment($recipeId, $_SESSION['id'], $_POST['comment']);
    }
}