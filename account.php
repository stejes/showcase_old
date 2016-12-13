<?php

session_start();
require_once 'bootstrap.php';


use OWG\Weggeefwinkel\Business\ItemService;






if (!isset($_SESSION["username"])) {
    header("location: login.php");
    exit(0);
} else {
    $itemSvc = new ItemService();
    $itemList = $itemSvc->getByUser($_SESSION["username"]);
    $view = $twig->render("account.twig", array("itemList" => $itemList, "username" => $_SESSION["username"]));
    print($view);
}

