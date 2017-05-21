<?php

require '../vendor/autoload.php';

$quizAction = new Kantas_net\Actions\QuizAction;

$level = $_POST['level'] ;

$quizAction->showLevelQuestions($level);