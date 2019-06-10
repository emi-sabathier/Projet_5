<?php

namespace app\controller;

use app\model\CommentsManager;
use app\model\RecipesManager;
use Exception;

class RecipesController extends AppController
{
    /**
     * Display last 6 recipes for the homepage
     * json_encode : success + $listRecipes object
     */
    public function getLastRecipesHome()
    {
        $recipesManager = new RecipesManager();
        $listRecipes = $recipesManager->getLastRecipes();

        echo json_encode([
            'status' => 'success',
            'recipes' => $listRecipes,
        ]);
    }

    /**
     * Display last 6 recipes for the admin panel
     * json_encode : success + $listRecipes object
     */
    public function getLastRecipesAdmin()
    {
        $recipesManager = new RecipesManager();
        $listRecipes = $recipesManager->getLastRecipes();

        echo json_encode([
            'status' => 'success',
            'recipes' => $listRecipes,
        ]);
    }

    /**
     * Display recipes of a page (home pagination)
     *
     * Set to 6 recipes by page
     * Verifications on : $_POST['pageNumber']
     * json_encode : success + $listRecipes object
     * @return object $pagesInfos;
     */
    public function getRecipesByPage()
    {

        $recipesManager = new RecipesManager();
        $nbRecipes = $recipesManager->countRecipes();
        $nbRecipesByPage = 6;
        $nbPages = ceil($nbRecipes / $nbRecipesByPage);

        if (isset($_POST['pageNumber']) && $_POST['pageNumber'] > 0 && !empty($_POST['pageNumber']) && $_POST['pageNumber'] <= $nbPages) {
            $currentPage = $_POST['pageNumber'];
            $offset = ($currentPage - 1) * $nbRecipesByPage;
            $listRecipes = $recipesManager->getRecipesByPage($nbRecipesByPage, $offset);
            echo json_encode([
                'status' => 'success',
                'recipes' => $listRecipes
            ]);
        } else {
            $currentPage = 1;
            $offset = ($currentPage - 1) * $nbRecipesByPage;
            $recipesManager->getRecipesByPage($nbRecipesByPage, $offset);
        }
        $pagesInfos = [
            'nbPages' => $nbPages,
            'currentPage' => $currentPage
        ];
        return $pagesInfos;
    }

    /**
     * Display a recipe
     *
     * Verifications on : recipeId
     * Display recipe view + recipe object + comment object
     * @param [int] $recipeId
     * @param [string] $compactVars
     */
    public function recipe($recipeId, $compactVars = null)
    {
        if ($compactVars == null) {
            if (isset($recipeId) && $recipeId > 0) {
                $recipesManager = new RecipesManager();
                $recipe = $recipesManager->getRecipe($recipeId);

                if ($recipe == false) {
                    header('Location: ' . BASEURL);
                    exit;
                } else {
                    $commentsManager = new CommentsManager();
                    $comment = $commentsManager->getComments($recipeId);
                    echo $this->twig->render('recipe.twig', [
                        'recipe' => $recipe,
                        'comments' => $comment,
                    ]);
                }
            } else {
                throw new Exception('Les paramètres doivent être des nombres');
            }
        } else {
            echo $this->twig->render('recipe.twig', $compactVars);
        }
    }

    /**
     * Display the list of recipes by category (admin)
     *
     * Verifications on $_SESSION|['user']
     * Display adminCategories view + $listRecipesByCat object
     * @param [int] $catId
     */
    public function listRecipesByCat($catId)
    {
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user']->getRole() == 1) {
                $recipesManager = new RecipesManager();
                $listRecipesByCat = $recipesManager->getRecipesByCat($catId);
                echo $this->twig->render('adminCategories.twig', [
                    'listRecipesByCat' => $listRecipesByCat,
                ]);
            } else {
                header('Location: ' . BASEURL);
                exit;
            }
        } else {
            header('Location: ' . BASEURL);
            exit;
        }
    }

    /**
     * Delete a recipe (admin) and its comments
     *
     * json_encode : success + error + nosession
     */
    public function deleteRecipe()
    {
        if (isset($_POST['recipeId'], $_SESSION['user'])) {
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
            echo json_encode('nosession');
        }
    }

    /**
     * Display the form to create a recipe (admin)
     *
     * Verifications on : $_SESSION['user']
     * Display adminCreateRecipe view
     * @param [string] $compactVars -> errors array from createRecipe()
     */
    public function createRecipeForm($compactVars = null)
    {
        if ($compactVars == null) {
            if (isset($_SESSION['user'])) {
                if ($_SESSION['user']->getRole() == 1) {
                    echo $this->twig->render('adminCreateRecipe.twig');
                } else {
                    header('Location:' . BASEURL);
                    exit;
                }
            } else {
                header('Location:' . BASEURL);
                exit;
            }
        } else {
            echo $this->twig->render('adminCreateRecipe.twig', $compactVars);
        }
    }

    /**
     * Create a recipe (admin)
     *
     * Verifications on $_SESSION['user'], $_POST['category-id'], $_POST['content'],  $_POST['cooking-time'],
     * $_POST['persons'],  $_POST['difficulty-id'], $_FILES
     * Display $errors in createRecipeForm() with compact('errors') - compactVars
     */
    public function createRecipe()
    {
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user']->getRole() == 1) {

                if (isset($_POST['title'], $_POST['category-id'], $_POST['content'], $_POST['cooking-time'], $_FILES['image'], $_POST['persons'], $_POST['difficulty-id'])) {

                    $fileName = $_FILES['image']['name'];
                    $fileTmp = $_FILES['image']['tmp_name'];
                    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                    $extensions = ['jpeg', 'jpg'];


                    if (in_array($fileExt, $extensions) === false) {
                        $errors['wrongType'] = true;
                    }

                    if ($_FILES['image']['error'] == UPLOAD_ERR_INI_SIZE) {
                        $errors['fileSize'] = true;
                    }
                    if ($_FILES)
                        if (!empty($errors)) {
                            $this->createRecipeForm(compact('errors'));
                        } else {
                            $folder = $_SERVER['DOCUMENT_ROOT'] . '/app/public/images/';
                            move_uploaded_file($fileTmp, $folder . 'original/' . $fileName);
                            $imgSource = $folder . 'original/' . $fileName;
                            $imgResized = $folder . 'resized/' . $fileName;

                            $this->resizeImage($imgSource, $imgResized, '640', '480', 75);

                            $recipesManager = new RecipesManager();
                            $recipesManager->createRecipe($_POST['title'], $_POST['category-id'], $_POST['content'], $_POST['cooking-time'], $fileName, $_POST['persons'], $_POST['difficulty-id']);

                            header('Location: ' . BASEURL . '/admin/recipeform');
                            exit;
                        }
                } else {
                    header('Location: ' . BASEURL . '/admin');
                    exit;
                }
            } else {
                header('Location:' . BASEURL);
                exit;
            }
        } else {
            header('Location:' . BASEURL);
            exit;
        }
    }

    /**
     * Update a recipe (admin)
     *
     * Verifications on $_SESSION['user'], $_POST['category-id'], $_POST['content'],  $_POST['cooking-time'],
     * $_POST['persons'],  $_POST['difficulty-id'], $_FILES
     * Return $errors with compact('errors') - compactVars
     */
    public function updateRecipe($recipeId, $compactVars = null)
    {

        if ($compactVars == null) {

            if (isset($_SESSION['user'])) {
                if ($_SESSION['user']->getRole() == 1) {
                    $recipesManager = new RecipesManager();
                    $recipe = $recipesManager->getRecipe($recipeId);

                    if (isset($_POST['title'], $_POST['category-id'], $_POST['content'], $_POST['cooking-time'], $_FILES['image'], $_POST['persons'], $_POST['difficulty-id'])) {
                        $fileName = $_FILES['image']['name'];
                        $fileTmp = $_FILES['image']['tmp_name'];
                        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                        $extensions = ['jpeg', 'jpg'];

                        if (in_array($fileExt, $extensions) === false) {
                            $errors['wrongType'] = true;
                        }

                        if ($_FILES['image']['error'] == UPLOAD_ERR_INI_SIZE) {
                            $errors['fileSize'] = true;
                        }
                        if ($_FILES['image']['error'] == UPLOAD_ERR_INI_SIZE) {
                            $errors['fileSize'] = true;
                        }

                        if (!empty($errors)) {
                            $this->updateRecipe($recipeId, compact('errors', 'recipe'));
                        } else {
                            $folder = $_SERVER['DOCUMENT_ROOT'] . '/app/public/images/';
                            move_uploaded_file($fileTmp, $folder . 'original/' . $fileName);
                            $imgSource = $folder . 'original/' . $fileName;
                            $imgResized = $folder . 'resized/' . $fileName;

                            $this->resizeImage($imgSource, $imgResized, '640', '480', 71);

                            $recipesManager = new RecipesManager();
                            $recipesManager->updateRecipe($_POST['title'], $_POST['category-id'], $_POST['content'], $_POST['cooking-time'], $fileName, $_POST['persons'], $_POST['difficulty-id'], $recipeId);
                            header('Location: ' . BASEURL . '/admin/updateform/' . $recipeId);
                            exit;
                        }
                    } else {
                        echo $this->twig->render('adminUpdateRecipe.twig', ['recipe' => $recipe]);
                    }
                } else {
                    header('Location:' . BASEURL);
                    exit;
                }
            } else {
                header('Location:' . BASEURL);
                exit;
            }
        } else {
            $recipesManager = new RecipesManager();
            $recipesManager->getRecipe($recipeId);
            echo $this->twig->render('adminUpdateRecipe.twig', $compactVars);
        }
    }

    /**
     * Resize uploaded recipe image into 640x480
     *
     * @param [string] $source
     * @param [string] $dst
     * @param [int] $width
     * @param [int] $height
     * @param [int] $quality
     */
    public function resizeImage($source, $dst, $width, $height, $quality)
    {
        $imageSize = getimagesize($source);
        $imageRessource = imagecreatefromjpeg($source);
        $imageFinal = imagecreatetruecolor($width, $height);
        $final = imagecopyresampled($imageFinal, $imageRessource, 0, 0, 0, 0, $width, $height, $imageSize[0], $imageSize[1]);
        imagejpeg($imageFinal, $dst, $quality);
    }

    /**
     * Search recipes by title or category
     *
     * Verifications on : $_POST['keyword']
     * json_encode : empty, success, $recipes object
     */
    public function searchRecipes()
    {
        if (isset($_POST['keyword'])) {
            $keyword = $_POST['keyword'];
            $recipesManager = new RecipesManager();
            $recipes = $recipesManager->getRecipesByTitleOrCategory($keyword);
            if (empty($recipes)) {
                echo json_encode([
                    'status' => 'empty',
                    'recipes' => $recipes,
                ]);
            } else {
                echo json_encode([
                    'status' => 'success',
                    'recipes' => $recipes,
                ]);
            }
        } else {
            echo json_encode('Une erreur est survenue');
        }
    }
}