<?php

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
        $this->showMessage("<p>Oups!</p><p>An Error occupied!</p>");
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
        echo '<p>You are not authorized for this action!</p>';
        die();
    }

}