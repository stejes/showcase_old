<?php

session_start();
require_once 'bootstrap.php';

//use OWG\Weggeefwinkel\Business\UserService;
//use OWG\Weggeefwinkel\Business\CityService;
use OWG\Weggeefwinkel\Business\ItemService;
use OWG\Weggeefwinkel\Business\SectionService;


//$itemSvc = new ItemService();
//$itemList = $itemSvc->getLastItems();
//$arr = (array)$item;
/* if(empty($arr)){
  print "jaja";
  }
  print sizeof($arr);
  //print "<pre>" . $arr . "</pre>";
  print_r($arr); */

//print_r($itemList);


if (!isset($_SESSION["username"])) {
    $citySvc = new CityService();
    $cityList = $citySvc->getAll();
    $view = $twig->render("loginForm.twig", array("cityList"=>$cityList));
    print($view);
} else {
    $itemSvc = new ItemService();
    $item = $itemSvc->getById($_GET["id"]);
    ;
    //print_r($item);
    $sectionSvc = new SectionService();
    $sectionList = $sectionSvc->getAll();
    $view = $twig->render("editItem.twig", array("item"=>$item, "sectionList" => $sectionList, "username" => $_SESSION["username"]));
    print($view);
    //print "jeuj: " . $_SESSION["username"];
}

