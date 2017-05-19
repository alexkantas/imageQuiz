<?php

namespace Kantas_net\Actions;

require '../vendor/autoload.php';

class QuizAction {

    private $databaseActions;
    private $action;

    public function __construct(){
        session_start();

        $this->action = new Action(require '../data/coreData.php');

        /* Display error message and die() if user is not verified */
        $this->action->validateUser();

        $connection = \Kantas_net\Database\Connection::make(require '../data/configDB.php');

        $this->databaseActions = new \Kantas_net\Database\QueryBuilder($connection);
    }

    public function showAllQuestions(){
        $questions = $this->databaseActions->selectAll('questions');
        header('Content-type: application/json');
        echo json_encode($questions);
    }

    public function addQuestion($question){
        $this->databaseActions->insertInto('questions',$question->insertData());
    }

    public function removeQuestion($id){
        $this->action->validateUser();
        $question = $this->databaseActions->selectWhere('questions','id',$id);
        if($this->action->isLocalImage($question->image)){
            $this->databaseActions->deleteWhere('questions','id',$id);
            unlink('../'.substr($question->image,1));
            echo "Image and correspond files deleted succefully!";
            header( "refresh:2;url='/admin/dashboard.html'" );
            die();
        }
        $this->databaseActions->deleteWhere('questions','id',$id);
        echo "Image deleted succefully!";
        header( "refresh:2;url='/admin/dashboard.html'" );
        die();
    }

}