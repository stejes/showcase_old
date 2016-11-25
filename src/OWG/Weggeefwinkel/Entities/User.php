<?php

namespace OWG\Weggeefwinkel\Entities;
/*
 * Description of User
 *
 * @author steven.jespers
 */
class User {
    private static $idMap = array();
    private $id;
    private $username;
    private $city;
    
    private function __construct($id, $username, $city){
        $this->id = $id;
        $this->username = $username;
        $this->city = $city;
    }
    
    public static function create($id, $username, $city){
        if (!isset(self::$idMap[$id])) {
            self::$idMap[$id] = new User($id, $username, $city);
        }
        return self::$idMap[$id];
    }
    
    function getId() {
        return $this->id;
    }

        
    function getUsername() {
        return $this->username;
    }

    
    
    function getCity() {
        return $this->city;
    }




}
