<?php

session_start();
require_once 'bootstrap.php';


use OWG\Weggeefwinkel\Business\ItemService;
use OWG\Weggeefwinkel\Business\UserService;

if (!isset($_SESSION["username"])) {
    header("location: login.php");
    exit(0);
} else {
    
    $itemSvc = new ItemService();
    $itemList = $itemSvc->getByUser($_SESSION["username"]);
    $userSvc = new UserService();
    $user = $userSvc->getByUsername($_SESSION["username"]);
    //print_r($user);
    $view = $twig->render("account.twig", array("itemList" => $itemList, "user" => $user));
    print($view);
}

