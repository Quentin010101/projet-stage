<?php

namespace App\Model;

use App\Model\utils\Database;

class Organisation
{
    public function set($array){
        $query='UPDATE organisation SET nom = :nom, adresse = :adresse, email = :email, tel = :tel, gps_lat = :gps_lat, gps_long = :gps_long WHERE organisation_id = 1';

        $db = new Database();
        $db->action($query, $array);
    }

    public function get(){
        $query='SELECT * FROM organisation WHERE organisation_id = 1';
        $db = new Database();
        $request = $db->findOne($query, []);
        return $request;
    }

    public function setLogo($array){
        $query = 'UPDATE organisation SET logo = :logo WHERE organisation_id = 1';

        $db = new Database();
        $db->action($query, $array);
    }

    public function getLogo(){
        $query = 'SELECT logo FROM organisation WHERE organisation_id = 1';

        $db = new Database();
        $request = $db->findOne($query, []);
        return $request;
    }

    public function getName(){
        $query = 'SELECT nom FROM organisation WHERE organisation_id = 1';

        $db = new Database();
        $request = $db->findOne($query, []);
        return $request;
    }
    public function getEmail(){
        $query = 'SELECT email FROM organisation WHERE organisation_id = 1';

        $db = new Database();
        $request = $db->findOne($query, []);
        return $request;
    }
}