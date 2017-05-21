<?php
/**
*Copyright 2017 Kantas.net
*
*Licensed under the Apache License, Version 2.0 (the "License");
*you may not use this file except in compliance with the License.
*You may obtain a copy of the License at
*
*    http://www.apache.org/licenses/LICENSE-2.0
*
*Unless required by applicable law or agreed to in writing, software
*distributed under the License is distributed on an "AS IS" BASIS,
*WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
*See the License for the specific language governing permissions and
*limitations under the License.
*/ 
namespace Kantas_net\Actions;

class Action {

    private $coreData=[];

    public function __construct($coreData=[]){
        $this->coreData = $coreData;
    }

    public function showMessage($message){
    echo $message;
    }

    public function showErrorMessage(){
    header('Content-type: application/json');
    echo json_encode([
                "status"=>"error",
                "error_msg"=>"<p>Oups!</p><p>An Error occupied!</p>"]);
    die();
    }

    public function authorizedError(){
        $this->showMessage("<p>You are not authorized for this action!</p>");
        die();
    }

    public function validate($password){
        if($password===$this->coreData["password"]){
            return true;
        }
        $this->authorizedError();
    }

    public static function validateUser(){
        if(isset($_SESSION['isAdmin'])){
            if($_SESSION['isAdmin'] === 1){
            return true;
            }
        }
        header('Content-type: application/json');
        echo json_encode([
                "status"=>"error",
                "error_msg"=>"You are not authorized for this action"]);
        die();
    }

    public static function isLocalImage($path){
        return substr($path,0,8) === '/images/' ? true : false ;
    }

}