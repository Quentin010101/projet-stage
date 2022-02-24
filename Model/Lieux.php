<?php

namespace Model;

use Exception;

class Lieux
{
    public function getLieux(){
        $db = new \Model\utils\DATABASE();

        $query = 'SELECT * FROM lieux';
        $requests = $db->findAll($query,[]);
        
        if(count($requests) == 0 ){
            throw new Exception("Aucun lieux trouvé");
        }

        return $requests;
    }

    public function setLieux(array $array){
        $db = new \Model\utils\DATABASE();

        $query = 'INSERT INTO lieux(nom, ville, code_postale, gps_lat, gps_long) VALUES(:nom, :ville, :code_postale, :gps_lat, :gps_long)';
        $db->action($query,$array);

    }
    public function setHebergeur(array $array){
        $db = new \Model\utils\DATABASE();

        $query = 'INSERT INTO hebergeur(publication_id, lieux_id) VALUES(:publication_id, :lieux_id)';
        $db->action($query,$array);

    }
    public function updateLieux(array $array){
        $db = new \Model\utils\DATABASE();

        $query = 'UPDATE lieux set nom = :nom, ville = :ville, code_postale = :code_postale, gps_lat = :gps_lat, gps_long = :gps_long WHERE lieux_id = :lieux_id';
        $db->action($query,$array);

    }
    public function deleteLieux(array $array){
        $db = new \Model\utils\DATABASE();

        $query = 'DELETE FROM lieux WHERE lieux_id = :lieux_id';
        $db->action($query,$array);

    }
}