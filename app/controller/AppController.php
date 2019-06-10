<?php

namespace app\controller;

class AppController
{
/**
 * Load twig environement
 * Add var session to twig
 * Extended in each controllers
 */
    public function __construct()
    {
        $loader = new \Twig\Loader\FilesystemLoader('app/view');
        $this->twig = new \Twig\Environment($loader, ['debug' => true, 'cache' => false]);
        $this->twig->addGlobal('baseUrl', BASEURL);

        if(isset($_SESSION['user'])) {
            $this->twig->addGlobal('session', $_SESSION['user']);
        }
    }
    /**
     * Display error view
     */
    public function errorPage(){
        echo $this->twig->render('error.twig');
    }
}