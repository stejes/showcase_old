<?php

session_start();
require_once 'bootstrap.php';

use OWG\Weggeefwinkel\Business\UserService;
use OWG\Weggeefwinkel\Business\CityService;
use OWG\Weggeefwinkel\Business\ItemService;


if (isset($_POST["login"])) {
    //print "in eerste if";
    if (isset($_POST["username"]) && isset($_POST["password"])) {
        $userSvc = new UserService();
        $id = $userSvc->checkLogin($_POST["username"], $_POST["password"]);
        //print "in tweede if";
        //print $isValid;
        if ($id != null) {
            $_SESSION["username"] = $_POST["username"];
            $_SESSION["id"] = $id;
            header("location: account.php");
            exit(0);
        }
    }
} elseif (isset($_POST["register"])) {
    //print "in eerste if";
    if (isset($_POST["username"]) && isset($_POST["password"])) {
        try {
            $userSvc = new UserService();
            $isValid = $userSvc->registerUser($_POST["username"], $_POST["password"], $_POST["password2"], $_POST["city"]);
            //print "in tweede if";
            //print $isValid;
            if ($isValid) {

                $_SESSION["username"] = $_POST["username"];
                header("location: items.php");
                exit(0);
            }
        } catch (UsernameExistsException $ex) {
            header("location: login.php?error=userexists");
            exit(0);
        }
    }
} elseif (isset($_GET["action"])) {
    if ($_GET["action"] == "logout") {
        unset($_SESSION["username"]);
        header("location: index.php");
        exit(0);
    }
}






if (!isset($_SESSION["username"])) {
    $citySvc = new CityService();
    $cityList = $citySvc->getAll();
    $error = "";
    if (isset($_GET["error"])) {
        $error = $_GET["error"];
    }
    $view = $twig->render("loginForm.twig", array("cityList" => $cityList, "error" => $error));
    print($view);
} else {
    $itemSvc = new ItemService();
    $itemList = $itemSvc->getByUser($_SESSION["username"]);
    $view = $twig->render("account.twig", array("itemList" => $itemList, "username" => $_SESSION["username"]));
    print($view);
    //print "jeuj: " . $_SESSION["username"];
}

