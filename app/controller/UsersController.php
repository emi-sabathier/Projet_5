<?php
namespace app\controller;

class UsersController extends AppController
{
    public function loginPage(){
        echo $this->twig->render('login.twig');
    }
    public function registerPage(){
        echo $this->twig->render('register.twig');
    }
}