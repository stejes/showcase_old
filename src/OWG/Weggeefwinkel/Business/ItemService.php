<?php

//business/BoekService.php
//require_once("data/BoekDAO.php");
namespace OWG\Weggeefwinkel\Business;
use OWG\Weggeefwinkel\Data\ItemDAO;

class ItemService {

    public function getLastItems() {
        $itemDAO = new ItemDAO();
        $itemList = $itemDAO->getLast();
        return $itemList;
    }
    
    public function getByUser($username){
        $itemDAO = new ItemDAO();
        $itemList = $itemDAO->getByUser($username);
        return $itemList;
    }

    

}
