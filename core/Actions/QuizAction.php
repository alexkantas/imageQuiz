<?php

namespace Kantas_net\Actions;

require '../vendor/autoload.php';

class QuizAction {

    private $databaseActions;

    public function __construct(){
        session_start();

        $action = new Action(require '../data/coreData.php');

        /* Display error message and die() if user is not verified */
        $action->validateUser();

        $connection = \Kantas_net\Database\Connection::make(require '../data/configDB.php');

        $this->databaseActions = new \Kantas_net\Database\QueryBuilder($connection);
    }

    public function showAllQuestions(){
        $questions = $this->databaseActions->selectAll('questions');
        header('Content-type: application/json');
        echo json_encode($questions);
    }

}