<?php

namespace Kantas_net\Database;

class QueryBuilder{

    private $pdo;

    public function __construct(\PDO $pdo){
        $this->pdo = $pdo;
    }

    public function selectAll($table){

    $statement = $this->pdo->prepare("SELECT * FROM {$table}");

    $statement->execute();

    return $statement->fetchAll(\PDO::FETCH_CLASS);

    }

    public function selectWhere($table,$attribute,$value){
    
    $query = sprintf("SELECT * FROM %s WHERE %s = %s LIMIT 1",$table,$attribute,$value);

    $statement = $this->pdo->prepare($query);

    $statement->execute();

    return $statement->fetch(\PDO::FETCH_OBJ);

    }

    public function insertInto($table,$data){

    $insertString = "INSERT INTO $table (";
    $valuesString = "VALUES (";

    foreach ($data as $key=>$element){
        $insertString.= $key.",";
        $valuesString.="'".$element."',";
    }

    $insertString = substr($insertString,0,-1);
    $insertString.=") ";
    $valuesString = substr($valuesString,0,-1);
    $valuesString.=");";

    $query=$insertString.$valuesString;

    $statement = $this->pdo->prepare($query);

    $statement->execute();

    }

    public function deleteWhere($table,$attribute,$value){
    
        $query = sprintf("DELETE FROM %s WHERE %s = %s",$table,$attribute,$value);
        try{
            $statement = $this->pdo->prepare($query);
            $statement->execute();
         } catch (PDOException $e) {
            die("Oups something wrong: ".$e->getMessage());
         }
    }

}