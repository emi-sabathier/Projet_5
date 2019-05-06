<?php

namespace app\controller;

use app\model\UsersManager;

class UsersController extends AppController
{

    public function loginPage()
    {
        echo $this->twig->render('login.twig');
    }

    /**
     * @param compacted array $compactVars
     * To display errors in the twig view
     */
    public function registerPage($compactVars = null)
    {
        if ($compactVars == null) {
            echo $this->twig->render('register.twig');
        } else {
            echo $this->twig->render('register.twig', $compactVars);
        }
    }

    public function login()
    {
        $usersController = new UsersController();
        $usersController->getUser();
    }

    public function newUser()
    {
        try {
            // $array = ['sdf', 'sdfgfgh', true] -> if (in_array('empty_field', $errors)) {<p>REMPLIS LES CHAMPS ENFOIRE</p>}
            if (isset($_POST['registerEmail'], $_POST['registerNickname'], $_POST['registerPwd'])) {
                $errors = [];
                $usersManager = new UsersManager();
                $emailExists = $usersManager->getEmail($_POST['registerEmail']);
                $nicknameExists = $usersManager->getNickname($_POST['registerNickname']);

                if (empty($_POST['registerEmail']) || empty(['registerNickname']) || empty($_POST['registerPwd'])) {
                    $errors['empty_field'] = true;
                }
                if ($emailExists == true) {
                    $errors['email_exists'] = true;
                }
                if (!preg_match('#^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]{2,4}+$#', $_POST['registerEmail'])) {
                    $errors['regex_email'] = true;
                }
                if ($nicknameExists == true) {
                    $errors['nickname_exists'] = true;
                }
                if(!preg_match('#^[a-zA-Z0-9]#', $_POST['registerNickname'])){
                    $errors['regex_nickname'] = true;
                }
                if (strlen($_POST['registerNickname']) < 3 ) {
                    $errors['short_nickname'] = true;
                }
                if (!preg_match('#^[a-zA-Z0-9]#', $_POST['registerPwd'])) {
                    $errors['regex_pwd'] = true;
                }
                if (strlen($_POST['registerPwd']) < 8) {
                    $errors['short_pwd'] = true;
                }
                if (!empty($errors)) {
                    // Si erreurs, on compacte le tableau pour les afficher dans la view contenue dans registerPage
                    // Si on ne fait pas ça on perd les erreurs entre les méthodes
                    $this->registerPage(compact('errors'));
                } else {
                    $hash = password_hash($_POST['registerPwd'], PASSWORD_DEFAULT);
                    $usersManager->createUser($_POST['registerEmail'], $_POST['registerNickname'], $hash);
                    header('location:' . BASEURL);
                }
            } else {
                header('Location: ' . BASEURL . '/register');
            }
        } catch (Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}