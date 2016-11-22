<?php
session_start();
require_once 'bootstrap.php';
use OWG\Weggeefwinkel\Business\ItemService;


$itemSvc = new ItemService();
$itemList = $itemSvc->getLastItems();


if(isset($_SESSION["username"])){
    $username = $_SESSION["username"];
}
else{
    $username="";
}

$view = $twig->render("index.twig", array("itemList" => $itemList, "username" => $username));
print($view);