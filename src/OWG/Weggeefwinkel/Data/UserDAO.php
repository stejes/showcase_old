<?php

/*include_once 'DBConfig.php';
include_once 'entities/User.php';*/
namespace OWG\Weggeefwinkel\Data;
use OWG\Weggeefwinkel\Data\DBConfig;
use OWG\Weggeefwinkel\Entities\User;
use PDO;
class UserDAO {
     public function getValidUser($username, $password) {
        $sql = "select username from users where username = :username and password = :password";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':username' => $username, ':password' => $password));
        $rij = $stmt->fetch(PDO::FETCH_ASSOC);
        $dbh = null;
        if($rij){
            $user = new User($username, $password);
            return $user;
        }
        return null;
        
    }
    
    public function insertUser($username, $password, $city){
        $sql = "insert into users (username, password, city_id) values (:username, :password, :city)";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':username' => $username, ':password' => $password, ":city"=>$city));
        $dbh = null;
    }
}
