<?php

namespace app\controller;

use app\model\CommentsManager;
use app\model\RecipesManager;

class CommentsController extends AppController {
	public function postComment() {
		if (isset($_POST['recipeId'], $_SESSION['user']) && $_POST['recipeId'] > 0) {

			if ($_SESSION['user']->getId() && !empty($_POST['comment']) && strlen(trim($_POST['comment'])) > 0) {
				$recipeId = (int) $_POST['recipeId'];
				$recipesManager = new RecipesManager();
				$recipe = $recipesManager->getRecipe($recipeId);

				if ($recipe == true) {
					$commentsManager = new CommentsManager();
					$commentId = $commentsManager->addComment($recipeId, $_SESSION['user']->getId(), $_POST['comment']);
					$comment = $commentsManager->getComment($commentId);

					echo json_encode([
						'status' => 'success',
						'comment' => $comment,
					]);

				} else {
					header('Location: ' . BASEURL);
					exit;
				}
			} else {
				echo json_encode('invalidComment');
			}
		} else {
			// vue par défaut
			echo $this->twig->render('recipe.twig');
		}
	}
	public function listComments($recipeId) {
		if (isset($recipeId) && $recipeId > 0) {
			$commentsManager = new CommentsManager();
			$listComments = $commentsManager->getComments($recipeId);

			echo $this->twig->render('adminListComments.twig', [
				'listComments' => $listComments,
			]);
		} else {
			header('Location: ' . BASEURL . '/admin');
			exit;
		}
	}
	public function reportComment() {
		if (isset($_POST['commentId'])) {
			// si (int) : transforme en nombre entier peu importe ce que contient la var
			// si string, transforme en 0
			$commentId = (int) $_POST['commentId'];
			if ($commentId != 0) {
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

	public function deleteComment() {
		if (isset($_POST['commentId'])) {
			$commentId = (int) $_POST['commentId'];
			if ($commentId != 0) {
				$commentsManager = new CommentsManager();
				$commentsManager->deleteComment($commentId);
				echo json_encode('success');
			} else {
				echo json_encode('error');
			}
		} else {
			echo json_encode('error');
		}
	}

	public function resetReportedComment() {
		if (isset($_POST['commentId'])) {
			$commentId = (int) $_POST['commentId'];
			if ($commentId != 0) {
				$commentsManager = new CommentsManager();
				$commentsManager->resetReportedComment($commentId);
				echo json_encode('success');
			} else {
				echo json_encode('error');
			}
		} else {
			echo json_encode('error');
		}
	}
}