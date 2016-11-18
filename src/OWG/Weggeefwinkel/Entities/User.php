<?php

/**
 * Description of User
 *
 * @author steven.jespers
 */
class User {
    private $username;
    private $password;
    
    public function __construct($username, $password){
        $this->username = $username;
        $this->password = $password;
    }
    
    function getUsername() {
        return $this->username;
    }

    function getPassword() {
        return $this->password;
    }


}
