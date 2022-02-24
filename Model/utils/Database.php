<?php

namespace Model\utils;

use \PDO;

class Database
{
    private string $db_name = 'projet-stage';
    private string $db_password = '';
    private string $db_user = 'root';
    private string $db_host = 'localhost';
    private $pdo;
    private $statement;
    private $variables;

    private function getPDO(){

        if($this->pdo === null):
            $pdo = new PDO('mysql:dbname=' . $this->db_name . ';host=' . $this->db_host  ,  $this->db_user , $this->db_password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo = $pdo;

        endif;

        return $this->pdo;

    }

    private function query(){
        // prepare
        $stmt = $this->getPDO()->prepare($this->statement);
        
        //stocke les clefs des variable pour la fonction bindParam
        $keys = array_keys($this->variables);
        

        $i=0;
        foreach($this->variables as $variable):
             $stmt->bindParam(':' . $keys[$i], $variable);
             $i++;
        endforeach;
        
        $stmt->execute($this->variables);
        
        return $stmt;
    }

    public function findAll(string $statement, array $variables){

        $this->statement = $statement;
        $this->variables = $variables;

        $stmt = $this->query();

        $request = $stmt->fetchAll();
        return $request;
    }
    public function findOne(string $statement, array $variables){

        $this->statement = $statement;
        $this->variables = $variables;

        $stmt = $this->query();

        $request = $stmt->fetch();
        return $request;
    }
    public function action(string $statement, array $variables){

        $this->statement = $statement;
        $this->variables = $variables;

        $stmt = $this->query();
    }
}