<?php

require '../vendor/autoload.php';

$quizAction = new Kantas_net\Actions\QuizAction;

$id = $_POST['id'] ;

$quizAction->removeQuestion($id);
