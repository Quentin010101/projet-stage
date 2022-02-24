<?php

use Model\Utilisateur;
use Model\utils\Render;


class login
{
    public function index()
    {

        //Gerer les message
        if (isset($_SESSION['message-auth']) && !empty($_SESSION['message-auth'])) :
            $message = $_SESSION['message-auth'];
            unset($_SESSION['message-auth']);
        endif;

        $view = 'login';
        $array = [];
        if (isset($message)) :
            $array = compact('message');
        endif;
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

            $request = $user->check($array);
            $this->checkPassword($password, $request['password']);
            $this->authentification($request);
            return header('Location: /home');

        else :
            return header('Location: /login');
        endif;
    }

    private function checkPassword($password, $hash)
    {
        if (password_verify($password, $hash)) :
            return;
        else :
            $_SESSION['message-auth'] = 'Vos identifiants ne sont pas valide.';
            return header('Location: /login');
        endif;
    }

    private function authentification($request)
    {
        $_SESSION['firstname'] = $request['prenom'];
        $_SESSION['lastname'] = $request['nom'];
        $_SESSION['user-type'] = $request['type'];
        $_SESSION['user-id'] = $request['utilisateur_id'];
    }

    private function redirectionType()
    {
        if ($_SESSION['user-type'] === 'admin') :
            return header('Location: /admin');
        elseif ($_SESSION['user-type'] === 'redacteur-actualite' || $_SESSION['user-type'] === 'redacteur-evenement') :
            return header('Location: /publication');
        endif;
    }

    //Enregistrer utilisateur manuellement
    // public function test(){
    //     $user = new Utilisateur();
    //     $user->test();
    // }

    public function logout(){
        session_destroy();
        return header('Location: /login');
    }
}
