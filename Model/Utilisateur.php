<?php

namespace Model;

use Model\utils\Database;

class Utilisateur
{
    public function check($array){
        $query = 'SELECT * FROM utilisateur WHERE email = :email';

        $db = new Database();
        $request = $db->findOne($query, $array);

        if($request):
            return $request;
        else:
            $_SESSION['message-auth'] = 'Vos identifiants ne sont pas valide.';
            return header('Location: /login');
        endif;

    }

    //Enregistrer une personne manuellement
    // public function test(){
    //     $query = 'INSERT INTO utilisateur(nom,prenom,email,password,type) VALUES(:nom, :prenom, :email, :password, :type)';

    //     $nom = 'Durand';
    //     $prenom = 'Sylvain';
    //     $email = 'redacteur1e@gmail.com';
    //     $password = password_hash('123', PASSWORD_DEFAULT);
    //     $type = 'redacteur-evenement';

    //     $array = compact('nom', 'prenom', 'email', 'password', 'type');
    //     $db = new Database();
    //     $db->action($query, $array);
    // }
}