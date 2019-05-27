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
    public function getRecipes()
    {
        $recipesManager = new RecipesManager();
        $listRecipes = $recipesManager->getRecipes();

        echo json_encode([
            'status' => 'success',
            'recipes' => $listRecipes
        ]);
    }
    public function recipe($recipeId, $compactVars = null)
    {
        if ($compactVars == null) {
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

    public function listRecipesByCat($catId)
    {
        $recipesManager = new RecipesManager();
        $listRecipesByCat = $recipesManager->getRecipesByCat($catId);
        echo $this->twig->render('adminCategories.twig', [
            'listRecipesByCat' => $listRecipesByCat
        ]);
    }
    public function deleteRecipe()
    {
        if (isset($_POST['recipeId'])) {
            $recipeId = (int)$_POST['recipeId'];
            if ($recipeId != 0) {
                $recipesManager = new RecipesManager();
                $commentsManager = new CommentsManager();
                $recipesManager->deleteRecipe($recipeId);
                $commentsManager->deleteComments($recipeId);
                echo json_encode('success');
            } else {
                echo json_encode('error');
            }
        } else {
            echo json_encode('Une erreur est survenue');
        }
    }

    public function createRecipeForm($compactVars = null)
    {
        if ($compactVars == null) {
            if ($_SESSION['user']->getRole() == 1) {
                echo $this->twig->render('adminCreateRecipe.twig');
            } else {
                header('Location:' . BASEURL);
                exit;
            }
        } else {
            echo $this->twig->render('adminCreateRecipe.twig', $compactVars);
        }
    }

    public function createRecipe()
    {
        // tant qu'il y a des recettes dans le tableau ingredient[] éxécuter createRecipeIngredients

        if (isset($_POST['title'], $_POST['category-id'], $_POST['content'], $_POST['cooking-time'], $_FILES['image'], $_POST['persons'], $_POST['difficulty-id'])) {
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_tmp = $_FILES['image']['tmp_name'];
            $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            $extensions = ['jpeg', 'jpg', 'png', 'gif'];

            if (in_array($file_ext, $extensions) === false) {
                $errors['wrongType'] = true;
            }

            if ($_FILES['image']['error'] == UPLOAD_ERR_INI_SIZE) {
                $errors['fileSize'] = true;
            }

            if (!empty($errors)) {
                $this->createRecipeForm(compact('errors'));
            } else {
                $destination_folder = $_SERVER['DOCUMENT_ROOT'] . '/Projets/Projet_5/app/public/images/';
                move_uploaded_file($file_tmp, $destination_folder . $file_name);

                $recipesManager = new RecipesManager();
                $recipesManager->createRecipe($_POST['title'], $_POST['category-id'], $_POST['content'], $_POST['cooking-time'], $file_name, $_POST['persons'], $_POST['difficulty-id']);
                header('Location: ' . BASEURL . '/admin/recipeform');
                exit;
            }
        } else {
            header('Location: ' . BASEURL . '/admin');
            exit;
        }
    }

    public function updateRecipe($recipeId, $compactVars = null)
    {

        if ($compactVars == null) {

            $recipesManager = new RecipesManager();
            $recipe = $recipesManager->getRecipe($recipeId);

            if (isset($_POST['title'], $_POST['category-id'], $_POST['content'], $_POST['cooking-time'], $_FILES['image'], $_POST['persons'], $_POST['difficulty-id'])) {
                $file_name = $_FILES['image']['name'];
                $file_size = $_FILES['image']['size'];
                $file_tmp = $_FILES['image']['tmp_name'];
                $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

                $extensions = ['jpeg', 'jpg', 'png', 'gif'];

                if (in_array($file_ext, $extensions) === false) {
                    $errors['wrongType'] = true;
                }

                if ($_FILES['image']['error'] == UPLOAD_ERR_INI_SIZE) {
                    $errors['fileSize'] = true;
                }
                if ($_FILES['image']['error'] == UPLOAD_ERR_INI_SIZE) {
                    $errors['fileSize'] = true;
                }

                if (!empty($errors)) {
                    // $errors + $recipe (ttes les infos de la recette)
                    // Création de $compactVars
                    $this->updateRecipe($recipeId, compact('errors', 'recipe'));
                } else {
                    $destination_folder = $_SERVER['DOCUMENT_ROOT'] . '/Projets/Projet_5/app/public/images/';
                    move_uploaded_file($file_tmp, $destination_folder . $file_name);

                    $recipesManager = new RecipesManager();
                    $recipesManager->updateRecipe($_POST['title'], $_POST['category-id'], $_POST['content'], $_POST['cooking-time'], $file_name, $_POST['persons'], $_POST['difficulty-id'], $recipeId);
                    header('Location: ' . BASEURL . '/admin/updateform/' . $recipeId);
                    exit;
                }

            } else {
                echo $this->twig->render('adminUpdateRecipe.twig', ['recipe' => $recipe]);
            }

        } else {
            $recipesManager = new RecipesManager();
            $recipesManager->getRecipe($recipeId);
            echo $this->twig->render('adminUpdateRecipe.twig', $compactVars);
        }
    }

    public function searchRecipes()
    {
        if (isset($_POST['keyword'])) {
            $keyword = $_POST['keyword'];
            $recipesManager = new RecipesManager();
            $recipes = $recipesManager->getRecipesByTitleOrContent($keyword);
            if(empty($recipes)){
                echo json_encode([
                    'status' => 'empty',
                    'recipes' => $recipes
                ]);
            } else {
                echo json_encode([
                    'status' => 'success',
                    'recipes' => $recipes
                ]);
            }
        } else {
            echo json_encode('Une erreur est survenue');
        }
    }
}