<?php

session_start();
require_once 'bootstrap.php';

use OWG\Weggeefwinkel\Business\UserService;
use OWG\Weggeefwinkel\Business\CityService;

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
if (isset($_GET["action"]) && $_GET["action"] == "login") {
    //print "in eerste if";
    if (isset($_POST["username"]) && isset($_POST["password"])) {
        $userSvc = new UserService();
        $isValid = $userSvc->checkLogin($_POST["username"], $_POST["password"]);
        //print "in tweede if";
        print $isValid;
        if ($isValid) {
            
            $_SESSION["username"] = $_POST["username"];
            header("location: account.php");
            exit(0);
        }
    }
}

if (isset($_GET["action"]) && $_GET["action"] == "register") {
    //print "in eerste if";
    if (isset($_POST["username"]) && isset($_POST["password"])) {
        $userSvc = new UserService();
        $isValid = $userSvc->registerUser($_POST["username"], $_POST["password"], $_POST["password2"]);
        //print "in tweede if";
        print $isValid;
        if ($isValid) {
            
            $_SESSION["username"] = $_POST["username"];
            header("location: account.php");
            exit(0);
        }
    }
}

if (isset($_GET["action"]) && $_GET["action"] == "logout"){
    unset($_SESSION["username"]);
}

if (!isset($_SESSION["username"])) {
    $citySvc = new CityService();
    $cityList = $citySvc->getAll();
    $view = $twig->render("loginForm.twig", array("cityList"=>$cityList));
    print($view);
} else {
    $view = $twig->render("account.twig", array("username" => $_SESSION["username"]));
    print($view);
    //print "jeuj: " . $_SESSION["username"];
}

