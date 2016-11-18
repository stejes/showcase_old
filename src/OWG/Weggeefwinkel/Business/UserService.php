<?php
//include_once 'data/UserDAO.php';

namespace OWG\Weggeefwinkel\Business;
use OWG\Weggeefwinkel\Data\UserDAO;
class UserService {

    public function checkLogin($gebruikersnaam, $wachtwoord) {
        $userDao = new UserDAO();
        $user = $userDao->getValidUser($gebruikersnaam, $wachtwoord);
        if(isset($user)){
            return true;
        }
        return false;
    }

}
