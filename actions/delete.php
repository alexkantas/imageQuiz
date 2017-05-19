<?php

require '../vendor/autoload.php';

$quizAction = new Kantas_net\Actions\QuizAction;

$id = $_POST['id'] ;

$quizAction->removeQuestion($id);

// echo "Deleting image with id $id !";

// $path = "../images/1494976264.jpg";

// if(unlink($path)){
//     echo "Successfully deleteted image in $path";
//     die();
// }

// echo "Not Successfully deleteted image in $path";