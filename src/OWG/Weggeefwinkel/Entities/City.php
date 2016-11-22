<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace OWG\Weggeefwinkel\Entities;

/**
 * Description of City
 *
 * @author steven.jespers
 */
class City {
    private $id;
    private $name;
    private $postcode;
    
    public function __construct($id, $postcode, $name) {
        $this->id = $id;
        $this->postcode = $postcode;
        $this->name = $name;
    }
    
    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function getPostcode() {
        return $this->postcode;
    }


}
