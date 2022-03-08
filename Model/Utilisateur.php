<?php

namespace App\Model;

use App\Model\utils\Database;

class Utilisateur
{
    public function getUser($array){
        $query = 'SELECT utilisateur_id, nom, prenom, email, type, actif FROM utilisateur WHERE email = :email';

        $db = new Database();
        $request = $db->findOne($query, $array);

        return $request;
    }

    public function getPassword($array){
        $query = 'SELECT password FROM utilisateur WHERE email = :email';

        $db = new Database();
        $request = $db->findOne($query, $array);

        return $request;
    }

    public function save($array){
        $query = 'INSERT INTO utilisateur(nom, prenom, email, password, type, actif, token) VALUES(:nom, :prenom, :email, :password, "user", 0, :token)';

        $db = new Database();
        $request = $db->action($query, $array);

        return $request;
    }

    public function getId($array){
        $query = 'SELECT utilisateur_id FROM utilisateur WHERE email = :email';

        $db = new Database();
        $request = $db->findOne($query, $array);

        return $request;
    }

    public function confirmUser($array){
        $query = 'SELECT token FROM utilisateur WHERE utilisateur_id = :utilisateur_id';

        $db = new Database();
        $request = $db->findOne($query, $array);

        return $request;
    }

    public function confirmUserRecoverPassword($array){
        $query = 'SELECT tokenPassword FROM utilisateur WHERE utilisateur_id = :utilisateur_id';

        $db = new Database();
        $request = $db->findOne($query, $array);

        return $request;
    }

    public function activateAccount($array){
        $query = 'UPDATE utilisateur SET actif = 1 WHERE utilisateur_id = :utilisateur_id';

        $db = new Database();
        $request = $db->action($query, $array); 
    }

    public function updateUser($array){
        $query = 'UPDATE utilisateur SET nom = :nom, prenom = :prenom, email = :email WHERE utilisateur_id = :utilisateur_id';

        $db = new Database();
        $request = $db->action($query, $array); 
    }

    public function updateTokenPassword($array){
        $query = 'UPDATE utilisateur SET tokenPassword = :tokenPassword WHERE utilisateur_id = :utilisateur_id';

        $db = new Database();
        $request = $db->action($query, $array); 
    }

    public function updatePassword($array){
        $query = 'UPDATE utilisateur SET password = :password WHERE utilisateur_id = :utilisateur_id';

        $db = new Database();
        $request = $db->action($query, $array);
    }

}