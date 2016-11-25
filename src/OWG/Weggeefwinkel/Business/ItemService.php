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
    
    public function getById($id){
        $itemDAO = new ItemDAO();
        $item = $itemDAO->getById($id);
        return $item;
    }
    
    public function getUser($id){
        $itemDAO = new ItemDAO();
        return $itemDAO->getById($id)->getUser();
    }
    
    public function updateItem($id, $title, $description, $img, $section){
        $itemDAO = new ItemDAO();
        $itemDAO->updateItem($id, $title, $description, $img, $section);
    }

    

}
