<?php

namespace App\Model;

use App\Model\utils\Database;

class membre
{
    public function set($array){
        $query='INSERT INTO membre(organisation_id, nom, prenom, fonction, actif) VALUES(1,:nom,:prenom,:fonction,1)';

        $db = new Database();
        $db->action($query, $array);
    }

    public function getAll(){
        $query='SELECT * FROM membre WHERE actif = 1';
        $db = new Database();
        $request = $db->findAll($query, []);

        return $request;
    }

    public function delete($array){
        $query='UPDATE membre SET actif = 0 WHERE membre_id = :membre_id';
        $db = new Database();
        $request = $db->action($query, $array);

    }

    public function update($array){
        $query='UPDATE membre SET nom = :nom, prenom = :prenom, fonction = :fonction WHERE membre_id = :membre_id';
        $db = new Database();
        $request = $db->action($query, $array);
    }
}