<?php
//include_once 'data/UserDAO.php';

namespace OWG\Weggeefwinkel\Business;
use OWG\Weggeefwinkel\Data\UserDAO;
use OWG\Weggeefwinkel\Data\CityDAO;
class UserService {

    public function checkLogin($username, $password) {
        $userDao = new UserDAO();
        //print "user" . $user;
        $id = $userDao->isValidUser($username, $password);
        if($id != null){
            return $id;
        }
        return null;
    }
    
    public function registerUser($username, $password, $password2, $cityId, $email){
        if($password == $password2){
            $cityDao = new CityDAO();
            $city = $cityDao->getById($cityId);
            $user = User::create($username, $city, $email, $password);
            $userDao = new UserDAO();
            $userDao->create($username, $password, $city, $email);
            return $user;
        }
        return false;
    }
    
    public function getByUsername($username){
        $userDAO = new UserDAO();
        return $userDAO->getByUsername($username);
    }
    
    public function getByEmail($email){
        $userDAO = new UserDAO();
        return $userDAO->getByEmail($email);
    }
    
    public function update($email, $cityId){
        $userDao = new UserDAO();
        $user = $userDao->getByUsername($_SESSION["username"]);
        $cityDao = new CityDAO();
        $city = $cityDao->getById($cityId);
        $user->setEmail($email);
        $user->setCity($city);
        $userDao->update($user);
    }
    
    public function updatePass($oldPass, $pass, $pass2){
        $userDao = new UserDAO();
        $user = $userDao->getByUsername($_SESSION["username"]);
        //print_r($user);
        if($oldPass == $user->getPassword()){
            
            
            if($pass == $pass2){
                $user->setPassword($pass);
                //print_r($user);
                $userDao->update($user);
            }
        }
    }

}
