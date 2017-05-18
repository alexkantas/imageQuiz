<?php

$id = $_REQUEST['id'] ?? "";

echo "Deleting image with id $id !";

$path = "../images/1494976264.jpg";

if(unlink($path)){
    echo "Successfully deleteted image in $path";
    die();
}

echo "Not Successfully deleteted image in $path";