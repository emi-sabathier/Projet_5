<?php

namespace app\controller;

use app\model\RecipesManager;
use app\model\UsersManager;
use app\model\CommentsManager;

class UsersController extends AppController
{
    /**
     * Admin panel
     *
     * Verifications on $_SESSION['user']
     * Display admin view + $listReportedComments object + pagesInfos object
     */
    public function adminPanel(){
        if(isset($_SESSION['user'])) {
            if($_SESSION['user']->getRole() == 1){
                $commentsManager = new CommentsManager();
                $usersManager = new UsersManager();
                $listReportedComments = $commentsManager->getReportedComments();
                $listUsers = $usersManager->getUsersList();
                $pagesInfos = $this->getRecipesByPageAdmin();

                echo $this->twig->render('admin.twig', [
                    'listReportedComments' => $listReportedComments,
                    'listUsers' => $listUsers,
                    'pagesInfos' => $pagesInfos
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
 * Display recipes of a page (admin pagination) 
 * 
 * Set to 6 recipes by page
 * Verifications on : $_POST['pageNumber']
 * json_encode : success + $listRecipes object
 * @return object $pagesInfos
 */
    public function getRecipesByPageAdmin()
    {
        $recipesManager = new RecipesManager();
        $nbRecipes = $recipesManager->countRecipes();
        $nbRecipesByPage = 4;
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
     * Display the login form
     *
     * @param [boolean] $compactVars : display errors in the login view
     */
    public function loginForm($compactVars = null)
    {
        if ($compactVars == null) {
            echo $this->twig->render('login.twig');
        } else {
            echo $this->twig->render('login.twig', $compactVars);
        }
    }
    /**
     * Display the register form
     *
     * @param [boolean] $compactVars : display errors in the register view
     */
    public function registerForm($compactVars = null)
    {
        if ($compactVars == null) {
            echo $this->twig->render('register.twig');
        } else {
            echo $this->twig->render('register.twig', $compactVars);
        }
    }

/**
 * Log the user
 * 
 * Verifications on : $_POST['signinEmail], $_POST['signinPwd']
 * Return $errors in loginForm() with compact('errors') - compactVars
 */
    public function login()
    {
        if (isset($_POST['signinEmail'], $_POST['signinPwd'])) {
            $errors = false;
            $usersManager = new UsersManager();
            $user = $usersManager->getUserByEmail($_POST['signinEmail']);

            if ($user == false) {
                $errors = true;
            } else {
                $pwdCheck = password_verify($_POST['signinPwd'], $user->getPassword());
                if ($pwdCheck == false) {
                    $errors = true;
                } else {
                    $_SESSION['user'] = $user;
                    if ($_SESSION['user']->getRole() == 1) {
                        header('Location:' . BASEURL . '/admin');
                        exit;
                    } elseif ($_SESSION['user']->getRole() == 0) {
                        header('Location:' . BASEURL);
                        exit;
                    }
                }
            }
            if (!empty($errors)) {
                $this->loginForm(compact('errors'));
            }
        } else {
            header('Location: ' . BASEURL . '/register');
        }
    }

    /**
     * Create a new user
     * 
     * Verifications on $_POST['registerEmail'], $_POST['registerNickname'], $_POST['registerPwd']
     * Return $errors in the registerForm view with compact('errors') - $compactVars
     */
    public function newUser()
    {
        
            if (isset($_POST['registerEmail'], $_POST['registerNickname'], $_POST['registerPwd'])) {
                $errors = [];
                $usersManager = new UsersManager();
                $emailExists = $usersManager->getUserByEmail($_POST['registerEmail']);
                $nicknameExists = $usersManager->getNickname($_POST['registerNickname']);

                if (empty($_POST['registerEmail']) || empty($_POST['registerNickname']) || empty($_POST['registerPwd'])) {
                    $errors['emptyField'] = true;
                }
                if ($emailExists == true) {
                    $errors['emailExists'] = true;
                }
                if (filter_var($_POST['registerEmail'], FILTER_VALIDATE_EMAIL) == false) {
                    $errors['wrongEmailFormat'] = true;
                }
                if ($nicknameExists == true) {
                    $errors['nicknameExists'] = true;
                }
                if (!preg_match('#^[a-zA-Z0-9]#', $_POST['registerNickname'])) {
                    $errors['regexNickname'] = true;
                }
                if (strlen($_POST['registerNickname']) < 3) {
                    $errors['shortNickname'] = true;
                }
                if (!preg_match('#^[a-zA-Z0-9]#', $_POST['registerPwd'])) {
                    $errors['regexPwd'] = true;
                }
                if (strlen($_POST['registerPwd']) < 8) {
                    $errors['shortPwd'] = true;
                }
                if (!empty($errors)) {
                    $this->registerForm(compact('errors'));
                } else {
                    $hash = password_hash($_POST['registerPwd'], PASSWORD_DEFAULT);
                    $usersManager->createUser($_POST['registerEmail'], $_POST['registerNickname'], $hash);
                    header('Location: ' . BASEURL . '/authform');
                    exit;
                }
            } else {
               header('Location: ' . BASEURL);
               exit;
            }

    }

    /**
     * Delete an user and his comments
     */
    public function deleteUser() {
        if (isset($_POST['userId'])) {
            $userId = (int) $_POST['userId'];
            if ($userId != 0) {
                $userManager = new UsersManager();
                $userManager->deleteUser($userId);
                $userManager->deleteUserComments($userId);
                echo json_encode('success');
            } else {
                echo json_encode('error');
            }
        } else {
            echo json_encode('error');
        }
    }
/**
* Disconnect the user
*/
    public function disconnect()
    {
        session_destroy();
        header('Location:' . BASEURL);
        exit;
    }

}