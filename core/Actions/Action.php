<?php

namespace Kantas_net\Actions;

class Action {

    private $coreData=[];

    function __construct($coreData=[]){
        $this->coreData = $coreData;
    }

    function showMessage($message){
    echo $message;
    }

    function showErrorMessage(){
        $this->showMessage("<p>Oups!</p><p>An Error occupied!</p>");
        die();
    }

    function authorizedError(){
        $this->showMessage("<p>You are not authorized for this action!</p>");
        die();
    }

    function validate($password){
        if($password===$this->coreData["password"]){
            return true;
        }
        $this->authorizedError();
    }

}