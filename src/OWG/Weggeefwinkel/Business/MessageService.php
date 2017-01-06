<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace OWG\Weggeefwinkel\Business;
use OWG\Weggeefwinkel\Data\MessageDAO;
use OWG\Weggeefwinkel\Data\UserDAO;
use OWG\Weggeefwinkel\Entities\Message;
use OWG\Weggeefwinkel\Entities\User;

/**
 * Description of MessageService
 *
 * @author steven.jespers
 */
class MessageService {
    //put your code here
    public function writeMessage($title, $text, $receiver, $parentId){
        $messageDao = new MessageDAO();
        $date = date('Y-m-d H:i:s');
        $userDao  = new UserDAO();
        $sender = $userDao->getByUsername($_SESSION["username"]);
        //print_r($sender);
        $senderId = $sender->getId();
        $receiverId = $receiver->getId();
        $message = new Message($title, $text, $senderId, $receiverId, $date, $parentId);
        $messageDao->create($message);
    }
}
