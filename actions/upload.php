<?php

require '../vendor/autoload.php';

session_start();

$action = new Kantas_net\Actions\Action((require '../data/coreData.php'));

$action->validateUser();

$name = $_REQUEST['name'] ?? "";

if($name === ""){
    $action->showMessage("Name is not Defined!");
    die();
}

$localImage = $_FILES['image']['tmp_name'] ?? "";

if($localImage !== ""){
    $imageURL =Kantas_net\Actions\ImageActions\Image::resizeSave($localImage,368);
    echo 'Good!';
    die();
}

$imageURL = $_REQUEST['imgUrl'] ?? "";
$localStorage = $_REQUEST['localStore'] ?? "";

if(!filter_var($imageURL, FILTER_VALIDATE_URL)){
    $action->showMessage("Image URL is not valid!");
    die();
}

if($localStorage==="on"){
    $imageURL = Kantas_net\Actions\ImageActions\Image::resizeSave($imageURL,368);
}

var_dump($imageURL,$name,$localStorage,filter_var($imageURL, FILTER_VALIDATE_URL));

