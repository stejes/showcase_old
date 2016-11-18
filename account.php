<?php

session_start();
require_once 'bootstrap.php';

use OWG\Weggeefwinkel\Business\UserService;

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
    if (isset($_POST["username"]) && isset($_POST["password"])) {
        $userSvc = new UserService();
        $isValid = $userSvc->checkLogin($_POST["username"], $_POST["password"]);
        if ($isValid) {
            $user = $userSvc->getUser($_POST["username"]);
            $_SESSION["username"] = $user->getUsername();
            header("location: bla.php");
            exit(0);
        }
    }
}
if (!isset($_SESSION["username"])) {
    $view = $twig->render("loginForm.twig");
    print($view);
} else {
    $view = $twig->render("account.twig", array());
    print($view);
    print "jeuj";
}