<?php
//include_once 'data/UserDAO.php';

namespace OWG\Weggeefwinkel\Business;
use OWG\Weggeefwinkel\Data\UserDAO;
class UserService {

    public function checkLogin($username, $password) {
        $userDao = new UserDAO();
        //print "user" . $user;
        if($userDao->isValidUser($username, $password)){
            return true;
        }
        return false;
    }
    
    public function registerUser($username, $password, $password2, $city){
        if($password == $password2){
            $userDao = new UserDAO();
            $userDao->create($username, $password, $city);
            return true;
        }
        return false;
    }

}
