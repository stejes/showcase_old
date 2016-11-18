<?php
session_start();
require_once 'bootstrap.php';
use OWG\Weggeefwinkel\Business\ItemService;


$itemSvc = new ItemService();
$itemList = $itemSvc->getLastItems();
//$arr = (array)$item;
/*if(empty($arr)){
    print "jaja";
}
print sizeof($arr);
//print "<pre>" . $arr . "</pre>";
print_r($arr);*/

//print_r($itemList);

$view = $twig->render("index.twig", array("itemList" => $itemList));
print($view);