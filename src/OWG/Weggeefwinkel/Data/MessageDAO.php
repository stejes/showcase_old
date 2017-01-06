<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace OWG\Weggeefwinkel\Data;
use PDO;

/**
 * Description of MessageDAO
 *
 * @author steven.jespers
 */
class MessageDAO {
    //put your code here
    
    public function create($message){
        $sql = "insert into messages(parent_id, title, text, timestamp, sender_id, receiver_id, deleted)"
                . "values (:parent_id, :title, :text, :timestamp, :sender_id, :receiver_id, false)";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':parent_id'=>$message->getParentId(), ':title' => $message->getTitle(), ':text' => $message->getText(), ':timestamp' => $message->getDate()
                , ':sender_id' => $message->getSender(), ':receiver_id' => $message->getReceiver()));
        $messageId = $dbh->lastInsertId();
        $dbh=null;
        
        $sql = "insert into message_inbox(message_id, user_id, isSender, isRead)"
                . "values (:messageId, :user_id, false, false)";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':messageId' => $messageId, ':user_id' => $message->getReceiver()));
        $dbh=null;
        $sql = "insert into message_inbox(message_id, user_id, isSender, isRead)"
                . "values (:messageId, :user_id, true, true)";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':messageId' => $messageId, ':user_id' => $message->getSender()));
        $dbh=null;
        
    }
}
