<?php

namespace Kantas_net;

class Question {
    private $name;
    private $level;
    private $imageURL;
    private $saveLocally;
    private $localFile;

    function __construct($name,$level,$localFile="",$imageURL="",$saveLocally="off"){
        $this->name = $name;
        $this->level = $level;
        $this->imageURL = $imageURL;
        $this->saveLocally = $saveLocally;
        $this->localFile = $localFile;
    }

    function saveLocally(){
        return $this->saveLocally === "on" ? true : false ;
    }

    function localFileExists(){
        return $this->localFile !== "" ? true : false ;
    }

    function insertData(){
        $data = [
            "name" => $this->name,
            "level"=> $this->level
            ];

        if($this->localFileExists()){
            $this->imageURL = Actions\ImageActions\Image::resizeSave($this->localFile,368);
            $data["image"] = $this->imageURL;
            return $data;
        }

        if(!filter_var($this->imageURL, FILTER_VALIDATE_URL)){
            echo "Image URL is not valid!" ;
            die();
        }

        if($this->saveLocally()){
            $this->imageURL = Actions\ImageActions\Image::resizeSave($this->imageURL,368);
        }

        $data["image"] = $this->imageURL;
        return $data;
    }

}