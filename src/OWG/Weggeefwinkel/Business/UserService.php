<?php
//include_once 'data/UserDAO.php';

namespace OWG\Weggeefwinkel\Business;
use OWG\Weggeefwinkel\Data\UserDAO;
use OWG\Weggeefwinkel\Data\CityDAO;
use OWG\Weggeefwinkel\Entities\User;
class UserService {

    public function checkLogin($username, $password) {
        $userDao = new UserDAO();
        //print "user" . $user;
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $user = $userDao->getByUsername($username);
       
        if(password_verify($password, $user->getPassword())){
            return $user;
        }
        else { return null; };
    }
    
    public function registerUser($username, $password, $password2, $cityId){
        if($password == $password2){
            $cityDao = new CityDAO();
            $city = $cityDao->getById($cityId);
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $user = User::create(null, $username, $city, null, $hash);
            $userDao = new UserDAO();
            $userDao->create($user);
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
        $oldHash = password_hash($oldPass, PASSWORD_DEFAULT);
        if($oldHash == $user->getPassword()){
            
            
            if($pass == $pass2){
                $hash = password_hash($pass, PASSWORD_DEFAULT);
                $user->setPassword($hash);
                //print_r($user);
                $userDao->update($user);
            }
        }
    }

}
