<?php

namespace app\controller;

class AppController
{
    protected $twig;
    public function __construct()
    {
        $loader = new \Twig\Loader\FilesystemLoader('app/view');
        $this->twig = new \Twig\Environment($loader, ['debug' => true, 'cache' => 'cache']);
        $this->id = basename($_SERVER['REQUEST_URI']); // get id at the end of the url
        // $this->twig->addGlobal("CurrentUrl", $_SERVER["REQUEST_URI"]);
        $this->twig->addGlobal('baseUrl', BASEURL);
    }
}