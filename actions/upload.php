<?php

require '../vendor/autoload.php';

$quizAction = new Kantas_net\Actions\QuizAction;

$action = new Kantas_net\Actions\Action;

$name = $_POST['name'];
$level = $_POST['level'];

if($name === ""){
    $action->showMessage("Name is not Defined!");
    die();
}

$localImage = $_FILES['image']['tmp_name'] ?? "";

if($localImage !== ""){
    $question = new Kantas_net\Question($name,$level,$localImage);
    $quizAction->addQuestion($question);
    echo "Image added Succefully!";
    header( "refresh:2;url='/admin/dashboard.html'" );
    die();
}

$imageURL = $_POST['imgUrl'] ;
$localStorage = $_POST['localStore'] ?? "" ;


$question = new Kantas_net\Question($name,$level,$localImage,$imageURL,$localStorage);
$quizAction->addQuestion($question);

echo "Image added Succefully!";
header( "refresh:2;url='/admin/dashboard.html'" );
die();

