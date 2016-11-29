<?php
session_start();
require_once 'bootstrap.php';
use OWG\Weggeefwinkel\Business\ItemService;
use OWG\Weggeefwinkel\Business\SectionService;



$itemSvc = new ItemService();
$itemList = $itemSvc->getLastItems();
$sectionSvc = new SectionService();
$sectionList = $sectionSvc->getAll();


if(isset($_SESSION["username"])){
    $username = $_SESSION["username"];
}
else{
    $username="";
}
//print_r($itemList);
$view = $twig->render("index.twig", array("itemList" => $itemList,"sectionList" => $sectionList, "username" => $username));
print($view);