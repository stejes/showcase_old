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
    
   header("location: login.php");
   exit(0);
} elseif (isset($_GET["action"])) {

    if ($_GET["action"] == "add"){
        if (isset($_POST["addItem"])){
        $userId = $userSvc->getByUsername($_SESSION["username"]);
        $itemSvc->addItem($_POST["title"], $_POST["description"], $_POST["img"], $_POST["section"], $userId);
        header("location: account.php");
        exit(0);
        }
        else{
            $view = $twig->render("addItem.twig", array("sectionList" => $sectionList, "username" => $_SESSION["username"]));
              print($view); 
        }
    }
    $item = $itemSvc->getById($_GET["id"]);
    if ($item->getUser()->getUsername() == $_SESSION["username"]) {
        //print_r($item);
        if ($_GET["action"] == "edit") {


            if (isset($_POST["submit"])) {
                $itemSvc->updateItem($_GET["id"], $_POST["title"], $_POST["description"], $_POST["img"], $_POST["sectionId"]);
                /* $itemSvc = new ItemService();
                  $item = $itemSvc->getById($_GET["id"]); */
                header("location: account.php");
                exit(0);
                //print_r($item);
                //$itemUser = $itemSvc->getUser($_GET["id"]);
            }

            $view = $twig->render("editItem.twig", array("item" => $item, "sectionList" => $sectionList, "username" => $_SESSION["username"]));
              print($view); 
        }

        if ($_GET["action"] == "delete") {
            $itemSvc->deleteItem($_GET["id"]);
            header("location: account.php");
        }
    }
    else {
        print "ni van u eh";
    }


    //print "jeuj: " . $_SESSION["username"];
}

