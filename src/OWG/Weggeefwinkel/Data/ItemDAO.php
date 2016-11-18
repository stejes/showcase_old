<?php

namespace OWG\Weggeefwinkel\Data;

use OWG\Weggeefwinkel\Entities\Item;
use PDO;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ItemDAO
 *
 * @author steven.jespers
 */
class ItemDAO {

    //put your code here
    public function getLast() {
        /* $sql="select items.id, title, description, users.username, postcode, city_id, cities.name, section_id, sections.name, img, date from items"
          . "where user_id = users.id and users.city_id=cities.id and section_id = :id sort by date desc limit 1"; */
        /*$sql = "select items.id, items.title, description, users.username, img, postcode, sections.name as sectionname, date, cities.name as cityname from items, users, cities, sections where items.section_id = sections.id and user_id = users.id and city_id = cities.id group by section_id order by section_id asc";*/
        $sql = "select items.id, items.title, description, users.username, img, postcode, sections.name as sectionname, date, cities.name as cityname from items, users, cities, sections where items.section_id = sections.id and user_id = users.id and city_id = cities.id and items.id in(select max(id) from items group by section_id)";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        /* print $section;
          print "in dao, titel = " . $rij["title"]; */
        $resultSet = $dbh->query($sql);
        $lijst = array();
        foreach ($resultSet as $rij) {
            $item = new Item($rij["id"], $rij["title"], $rij["description"], $rij["username"], $rij["sectionname"], $rij["img"], $rij["date"], $rij["postcode"], $rij["cityname"]);
            array_push($lijst, $item);
        }
        $dbh = null;
        return $lijst;
    }

}
