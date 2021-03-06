<?php

namespace App\Model;

use App\Model\utils\Database;
use Exception;

class Lieux
{
    public function getLieux(){
        $db = new Database();

        $query = 'SELECT * FROM lieux';
        $requests = $db->findAll($query,[]);
        
        // if(count($requests) == 0 ){
        //     throw new Exception("Aucun lieux trouvé");
        // }

        return $requests;
    }

    public function setLieux(array $array){
        $db = new Database();

        $query = 'INSERT INTO lieux(nom, ville, code_postale, gps_lat, gps_long) VALUES(:nom, :ville, :code_postale, :gps_lat, :gps_long)';
        $db->action($query,$array);

    }
    public function setHebergeur(array $array){
        $db = new Database();

        $query = 'INSERT INTO hebergeur(publication_id, lieux_id, date, time) VALUES(:publication_id, :lieux_id, :date, :time)';
        $db->action($query,$array);

    }
    public function getHebergeurJoinLieux(){
        $db = new Database();

        $query = 'SELECT hebergeur.publication_id, hebergeur.date, hebergeur.time, lieux.* FROM hebergeur INNER JOIN lieux ON lieux.lieux_id = hebergeur.lieux_id'; 
        $request = $db->findAll($query,[]);

        return $request;

    }
    public function updateLieux(array $array){
        $db = new Database();

        $query = 'UPDATE lieux set nom = :nom, ville = :ville, code_postale = :code_postale, gps_lat = :gps_lat, gps_long = :gps_long WHERE lieux_id = :lieux_id';
        $db->action($query,$array);

    }
    public function deleteLieux(array $array){
        $db = new Database();

        $query = 'DELETE FROM lieux WHERE lieux_id = :lieux_id';
        $db->action($query,$array);

    }
}