<?php

session_start();
require_once 'bootstrap.php';

//use OWG\Weggeefwinkel\Business\UserService;
//use OWG\Weggeefwinkel\Business\CityService;
use OWG\Weggeefwinkel\Business\ItemService;
//use OWG\Weggeefwinkel\Exceptions\UsernameExistsException;
/*
if (isset($_GET["action"])) {
    if ($_GET["action"] == "login") {
        //print "in eerste if";
        if (isset($_POST["username"]) && isset($_POST["password"])) {
            $userSvc = new UserService();
            $isValid = $userSvc->checkLogin($_POST["username"], $_POST["password"]);
            //print "in tweede if";
            //print $isValid;
            if ($isValid) {

                $_SESSION["username"] = $_POST["username"];
                header("location: account.php");
                exit(0);
            }
        }
    }
    if ($_GET["action"] == "register") {
        //print "in eerste if";
        if (isset($_POST["username"]) && isset($_POST["password"])) {
            try {
                $userSvc = new UserService();
                $isValid = $userSvc->registerUser($_POST["username"], $_POST["password"], $_POST["password2"], $_POST["city"]);
                //print "in tweede if";
                //print $isValid;
                if ($isValid) {

                    $_SESSION["username"] = $_POST["username"];
                    header("location: account.php");
                    exit(0);
                }
            } catch (UsernameExistsException $ex) {
                header("location: account.php?error=userexists");
                exit(0);
            }
        }
    }
    if ($_GET["action"] == "logout") {
        unset($_SESSION["username"]);
    }
}*/





if (!isset($_SESSION["username"])) {
    /*$citySvc = new CityService();
    $cityList = $citySvc->getAll();
    $error = "";
    if (isset($_GET["error"])) {
        $error = $_GET["error"];
    }
    $view = $twig->render("loginForm.twig", array("cityList" => $cityList, "error" => $error));
    print($view);*/
    header("location: login.php");
    exit(0);
} else {
    $itemSvc = new ItemService();
    $itemList = $itemSvc->getByUser($_SESSION["username"]);
    $view = $twig->render("account.twig", array("itemList" => $itemList, "username" => $_SESSION["username"]));
    print($view);
    //print "jeuj: " . $_SESSION["username"];
}

