<?php

namespace Kantas_net\Database;

class Connection{
    public static function make($config){
    
        try {
            return new \PDO(
                $config['dbprefix'].":host=".$config['host'].";dbname=".$config['dbname'],
                $config['username'],
                $config['password'],
                $config['options']
                );
        } catch (\PDOException $e){
            die("Could not connect because ".$e->getMessage());
        }
    }
}