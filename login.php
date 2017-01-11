<?php

session_start();
require_once 'bootstrap.php';

use OWG\Weggeefwinkel\Business\UserService;
use OWG\Weggeefwinkel\Business\CityService;
use OWG\Weggeefwinkel\Business\ItemService;

/*
 * login en registratiepagina
 * 
 */


if (isset($_POST["login"])) {
    //check of het over een geldige login gaat, zet sessie of breek af

    if (isset($_POST["username"]) && isset($_POST["password"])) {

        try {
            $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
            $userSvc = new UserService();
            $validUser = $userSvc->checkLogin($username, $_POST["password"]);
        } catch (LoginFailedException $ex) {
            header("location:login.php?error=loginfailed");
            exit(0);
        }
        if (!$validUser) {
            header("location:login.php?error=loginfailed");
            exit(0);
        } else {
            $_SESSION["username"] = $username;
            $_SESSION["id"] = $validUser->getId();
            header("location: items.php");
            exit(0);
        }
    }
} elseif (isset($_POST["register"])) {
    //geeft ingevoerde input aan de service voor validatie, log onmiddellijk in als registratie gelukt is

    if (isset($_POST["username"]) && isset($_POST["password"])) {
        try {
            
            $userSvc = new UserService();
            $isValid = $userSvc->registerUser($_POST["username"], $_POST["password"], $_POST["password2"], $_POST["city"]);
            //print $isValid;
            if ($isValid) {
                $_SESSION["username"] = $_POST["username"];
                header("location: items.php");
                exit(0);
            }
        } catch (UsernameExistsException $ex) {
            header("location: login.php?error=userexists");
            exit(0);
        } catch(Exception $ex){
            echo $ex->getMessage();
            header("location: login.php");
        }
    }
} elseif (isset($_GET["action"])) {
    //bij logout, destroy de session en redirect naar de index

    if ($_GET["action"] == "logout") {
        session_destroy();
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

