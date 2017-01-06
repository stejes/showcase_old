<?php

session_start();
require_once 'bootstrap.php';


use OWG\Weggeefwinkel\Business\ItemService;
use OWG\Weggeefwinkel\Business\UserService;
use OWG\Weggeefwinkel\Business\CityService;

if (!isset($_SESSION["username"])) {
    header("location: login.php");
    exit(0);
} else {
    
    if(isset($_POST['send'])){
        print ("jaja");
    }
    //$view = $twig->render("items.twig", array("itemList" => $itemList, "username" =>$_SESSION["username"], "user" => $user));
    //print($view);
}

