<?php

session_start();
require_once 'bootstrap.php';

//use OWG\Weggeefwinkel\Business\UserService;
//use OWG\Weggeefwinkel\Business\CityService;
use OWG\Weggeefwinkel\Business\ItemService;
use OWG\Weggeefwinkel\Business\SectionService;
use OWG\Weggeefwinkel\Business\UserService;
use OWG\Weggeefwinkel\Entities\Item;

$sectionSvc = new SectionService();
$sectionList = $sectionSvc->getAll();
$itemSvc = new ItemService();
$userSvc = new UserService();
if (!isset($_SESSION["username"])) {
    $citySvc = new CityService();
    $cityList = $citySvc->getAll();
    $view = $twig->render("loginForm.twig", array("cityList" => $cityList));
    print($view);
} elseif (isset($_GET["action"]) && $_GET["action"] == "edit") {

    $item = $itemSvc->getById($_GET["id"]);
    //print_r($item);

    if ($item->getUser()->getUsername() == $_SESSION["username"]) {
        if (isset($_POST["submit"])) {
            $itemSvc->updateItem($_GET["id"], $_POST["title"], $_POST["description"], $_POST["img"], $_POST["sectionId"]);
            $itemSvc = new ItemService();
            $item = $itemSvc->getById($_GET["id"]);
            //print_r($item);
            //$itemUser = $itemSvc->getUser($_GET["id"]);
        }

        $view = $twig->render("editItem.twig", array("item" => $item, "sectionList" => $sectionList, "username" => $_SESSION["username"]));
        print($view);
    } else {
        print "ni van u";
    }
    //print "jeuj: " . $_SESSION["username"];
} elseif (isset($_POST["addItem"])) {
    if (isset($_GET["action"]) && $_GET["action"] == "add") {
        $userId = $userSvc->getByUsername($_SESSION["username"]);
        $itemSvc->addItem($_POST["title"], $_POST["description"], $_POST["img"], $_POST["section"], $userId);
        header("location: account.php");
        exit(0);
    } else {
        $view = $twig->render("addItem.twig", array("sectionList" => $sectionList, "username" => $_SESSION["username"]));
        print($view);
    }
}

