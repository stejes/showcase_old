<?php
//include_once 'data/UserDAO.php';

namespace OWG\Weggeefwinkel\Business;
use OWG\Weggeefwinkel\Data\UserDAO;
class UserService {

    public function checkLogin($username, $password) {
        $userDao = new UserDAO();
        $user = $userDao->getValidUser($username, $password);
        //print "user" . $user;
        if(isset($user)){
            return true;
        }
        return false;
    }

}
