<?php

namespace App\Controller;

use App\Model\Utilisateur;
use App\Model\utils\Render;

class Inscription extends Controller
{
    public function index()
    {

        $messages = $this->get_message();

        $view = 'inscription';
        $array = [];

        $array = compact('messages');

        Render::Renderer($view, $array);
    }

    public function logupPost()
    {

        if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['password-confirmation'])) :
            if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['password-confirmation'])) :

                $nom = $_POST['nom'];
                $prenom = $_POST['prenom'];
                $email = $_POST['email'];
                $pass = $_POST['password'];
                $pass_confirmation = $_POST['password-confirmation'];

                if ($this->validatePassword($pass, $pass_confirmation) && $this->validateEmail($email)) :

                    $password = password_hash($pass, PASSWORD_DEFAULT);

                    //Creation d'un token pour mail de confirmation
                    $token = $this->create_token();
                    //Creation du compte utilisateur
                    $utilisateur = new Utilisateur();
                    $array = compact('nom', 'prenom', 'email', 'password', 'token');
                    $utilisateur->save($array);
                    
                    //Envoi du mail de confirmation
                    $array = compact('email');
                    $id = $utilisateur->getId($array);
                    $userId = $id['utilisateur_id'];
                    
                    $this->send_confirmation($userId, $token, $email, $prenom);
                    $this->set_message($email, 'success', 'confirmation');

                    return header('Location: /inscription/confirmation');
                    exit;
                else :
                    return header('Location: /inscription');
                    exit;
                endif;

            else :
                $this->set_message('Tous les champs doivent être remplit.', 'error', 'validate');
                return header('Location: /inscription');
                exit;
            endif;

        else :
            return header('Location: /inscription');
            exit;
        endif;
    }

    private function validatePassword($password, $password_confirmation)
    {
        $result = true;
        //vérifier que le password contient au moins 6 caractères
        if (strlen($password) <= 5) :
            $this->set_message('Votre mot de passe doit contenir 6 caractères au minimum', 'error', 'validate');
            $result = false;
        endif;
        //verifier que le password contient au moins un chiffre
        if (!preg_match('/[0-9]/', $password)) :
            $this->set_message('Votre mot de passe doit contenir au moins un chiffre', 'error', 'validate');
            $result = false;
        endif;
        //verifier que le password contient au moins une lettre
        if (!preg_match('/[a-z]/', $password)) :
            $this->set_message('Votre mot de passe doit contenir au moins une lettre', 'error', 'validate');
            $result = false;
        endif;
        //verififier que les 2 passwords sont identique
        if ($password != $password_confirmation) :
            $this->set_message('Vos mots de passe ne correspondent pas', 'error', 'validate');
            $result = false;
        endif;

        return $result;
    }

    private function validateEmail($email)
    {
        $result = true;
        //vérifier email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) :
            $this->set_message('Votre email n\'est pas valide', 'error', 'validate');
            $result = false;
        endif;

        $array = compact('email');
        //Recuperation du password
        $user = new Utilisateur();
        $request = $user->getPassword($array);
        if ($request != false) :
            $this->set_message('Votre email n\'est pas valide.', 'error', 'validate');
            $result = false;
        endif;

        return $result;
    }

    private function send_confirmation($id, $token, $email, $prenom){
        
        $host = 'cozic.alwaysdata.net';

        $userId = $id;
        
        $url = "https://$host/verify/verifyaccount/" . $token . "user=" . $userId;

        $to = $email;
        $objet = 'Confirmation création compte';
        $message = "Bonjour $prenom: <a href='$url' target='_Blank'>Valider votre Compte</a>";
        $headers = 'Content-type: text/html; charset=UTF-8';
        $headers .= 'From: projet-stage@cozic.alwaysdata.net';
        
        mail($to, $objet, $message, $headers);
    }

    private function create_token(){

        $token = bin2hex(openssl_random_pseudo_bytes(16));

        return $token;
    }

    public function confirmation(){

        $messages = $this->get_message();

        $view = 'inscription-confirmation';
        $array = [];

        $array = compact('messages');

        Render::Renderer($view, $array);
    }

}
