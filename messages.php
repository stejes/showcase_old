<?php

session_start();
require_once 'bootstrap.php';

use OWG\Weggeefwinkel\Business\ItemService;
use OWG\Weggeefwinkel\Business\UserService;
use OWG\Weggeefwinkel\Business\CityService;
use OWG\Weggeefwinkel\Business\MessageService;

if (!isset($_SESSION["username"])) {
    header("location: login.php");
    exit(0);
} else {

    if (isset($_POST['send'])) {
        print ("jaja");
        $messageSvc = new MessageService();
        $messageSvc->writeMessage($_POST['title'], $_POST['text'], $_SESSION['username'], null);
    }


    //$view = $twig->render("items.twig", array("itemList" => $itemList, "username" =>$_SESSION["username"], "user" => $user));
    //print($view);
}

