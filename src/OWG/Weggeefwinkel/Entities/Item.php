<?php
namespace OWG\Weggeefwinkel\Entities;
/**
 * Description of Item
 *
 * @author steven.jespers
 */
class Item {
    private $id;
    private $title;
    private $description;
    private $user;
    private $section;
    private $img;
    private $date;
    private $postcode;
    private $city;
    
    function __construct($id, $title, $description, $user, $section, $img, $date, $postcode, $city) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->user = $user;
        $this->section = $section;
        $this->img = $img;
        $this->date = $date;
        $this->postcode = $postcode;
        $this->city = $city;
    }
    
    function getTitle() {
        return $this->title;
    }

    function getId() {
        return $this->id;
    }

    function getDescription() {
        return $this->description;
    }

    function getUser() {
        return $this->user;
    }

    function getSection() {
        return $this->section;
    }

    function getImg() {
        return $this->img;
    }

    function getDate() {
        return $this->date;
    }

    function getPostcode() {
        return $this->postcode;
    }

    function getCity() {
        return $this->city;
    }




    
    

}
