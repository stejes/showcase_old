<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace OWG\Weggeefwinkel\Business;

/**
 * Description of PhotoService
 *
 * @author steven.jespers
 */
class PhotoService {

    private static $target_dir = "src/OWG/Weggeefwinkel/Presentation/Img/";

    public function handlePhoto($photo) {
        $fileName = $_SESSION["username"] . "_" . basename($photo["name"]);
       // $usernameDir = $_SESSION["username"] . "/";
        
              // Check if file already exists
        if (file_exists(self::$target_dir . $fileName)) {
            /*$random = mt_rand(0, 100000);
            $fileName =  $random . $fileName;*/
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
        $target_file = self::$target_dir . $fileName;
        //print $target_file . " ";
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
        //print $imageFileType . " ";
        $check = getimagesize($photo["tmp_name"]);
        //print_r($check);
        if ($check) {
            //return basename($photo["name"]);
        } else {
            //
        }
      
            // Check file size
        if ($_FILES["img"]["size"] > 2000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
            // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        
            // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
                echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
                return $fileName;
            } else {
                echo "Sorry, there was an error uploading your file.";
                //return $target_file;
                return "ja";
            }
        }
    }

}
