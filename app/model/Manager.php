<?php
namespace app\model;
use PDO;

class Manager
{
    /**
     *  @return object
     */
    protected function dbconnect()
    {
        $db = new PDO('mysql:host=localhost;dbname=p5_cooking;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        return $db;
    }

}
