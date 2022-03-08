<?php

namespace App\Controller;

use App\Model\Utilisateur;
use App\Model\utils\Render;


class Login extends Controller
{
    public function index()
    {

        $messages = $this->get_message();

        $view = 'login';
        $array = [];

        $array = compact('messages');

        Render::Renderer($view, $array);
    }

    public function loginPost()
    {

        if ((isset($_POST['email']) && isset($_POST['password'])) && (!empty($_POST['email']) && !empty($_POST['password']))) :
            // Recupération de l'email et password
            $email = $_POST['email'];
            $password = $_POST['password'];

            $array = compact('email');

            // Récupération de l'utilisateur dans la base de donnée
            $user = new Utilisateur();
            $request = $user->getPassword($array);

            if ($request == false) {
                $this->set_message('Vos identifiants ne sont pas valide.', 'error');
                header('Location: /login');
                exit;
            }

            $this->checkPassword($password, $request['password']);
            $this->authentification($array);

        else :
            header('Location: /login');
            exit;
        endif;
    }


    private function checkPassword($password, $hash)
    {   
        if (password_verify($password, $hash)) :
            return;
        else :
            $this->set_message('Vos identifiants ne sont pas valides.', 'error');
            header('Location: /login');
            exit;
        endif;
    }

  

    private function authentification($array)
    {
        $utilisateur = new Utilisateur();
        $request = $utilisateur->getUser($array);

        if($request['actif'] == 0):
            $this->set_message('Vottre compte n\'est pas activé.', 'error');
            header('Location: /login');
            exit;
        else:
            $_SESSION['firstname'] = $request['prenom'];
            $_SESSION['lastname'] = $request['nom'];
            $_SESSION['user-type'] = $request['type'];
            $_SESSION['email'] = $request['email'];
            $_SESSION['user-id'] = $request['utilisateur_id'];

            header('Location: /home');
            exit;

        endif;

    }

    // private function redirectionType()
    // {
    //     if ($_SESSION['user-type'] === 'admin') :
    //         return header('Location: /admin');
    //     elseif ($_SESSION['user-type'] === 'redacteur-actualite' || $_SESSION['user-type'] === 'redacteur-evenement') :
    //         return header('Location: /publication');
    //     endif;
    // }

    //Enregistrer utilisateur manuellement
    // public function test(){
    //     $user = new Utilisateur();
    //     $user->test();
    // }

    public function logout()
    {
        session_destroy();
        header('Location: /login');
        exit;
    }

    public function passwordForgotten(){

        $messages = $this->get_message();

        $view = 'login-passwordForgotten';
        $array = compact('messages');

        Render::renderer($view, $array);
    }

    public function passwordRecover(){
        if(isset($_POST['email'])):
            if(!empty($_POST['email'])):
                $email = $_POST['email'];
                $array = compact('email');
                $utilisateur = new Utilisateur();
                $id = $utilisateur->getId($array);
                if($id == false):
                    $this->set_message('Votre email n\'est pas valide', 'error');
                    header('Location: /login/passwordForgotten');
                endif;
                $utilisateur_id = $id['utilisateur_id'];
                $tokenPassword = $this->create_token();

                $array = compact('tokenPassword', 'utilisateur_id');
                $utilisateur->updateTokenPassword($array);

                $this->sendConfirmation($utilisateur_id, $tokenPassword, $email);

                header('Location: /login/passwordForgotten');
                exit;
            else:
                $this->set_message('Vous devez rensigner votre email', 'error');
                header('Location: /login/passwordForgotten');
                exit;
            endif;
            header('Location: /login/passwordForgotten');
            exit;
        endif;

    }

    private function sendConfirmation($id, $token, $email){
        $host = 'cozic.alwaysdata.net';

        $userId = $id;
        
        $url = "https://$host/verify/passwordRecover/" . $token . "user=" . $userId;
        
        $to = $email;
        $objet = 'Reinitialiser votre mot de passe';
        $message = "Pour réinitialiser votre mot de passe cliquer le lien suivant: <a href='$url' target='_Blank'>Réinitialiser votre mot de passe</a>";
        $headers = 'Content-type: text/html; charset=UTF-8';
        $headers .= 'From: projet-stage@cozic.alwaysdata.net';
        
        if(mail($to, $objet, $message, $headers)):
            $this->set_message('Un email vous à été envoyé.', 'success');
        endif;
    }

    private function create_token(){

        $token = bin2hex(openssl_random_pseudo_bytes(16));

        return $token;
    }
}
