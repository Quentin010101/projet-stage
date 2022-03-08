<?php

namespace App\Controller;

use App\Model\Organisation;
use App\Model\Utilisateur as ModelUtilisateur;
use App\Model\utils\Render;

class Utilisateur extends Controller
{
    public function index()
    {
        if ($_SESSION['user-type'] != 'user') :
            header('Location: /login');
            exit;
        endif;

        // Récupération des messages
        $messages = $this->get_message();

        //Récupération du logo
        $organisations = new Organisation();
        $logo = $organisations->getLogo();

        //Récupération de l'utilisateur
        $email = $_SESSION['email'];
        $arrayUser = compact('email');
        $utilisateurs = new ModelUtilisateur();
        $utilisateur = $utilisateurs->getUser($arrayUser);

        $view = 'compte-utilisateur';
        $array = compact('logo', 'utilisateur', 'messages');

        Render::renderer($view, $array);
    }

    public function update()
    {
        if ($_SESSION['user-type'] != 'user') :
            header('Location: /login');
            exit;
        endif;

        if (isset($_POST['nom-update']) && isset($_POST['prenom-update']) && isset($_POST['email-update'])) :
            if (!empty($_POST['nom-update']) && !empty($_POST['prenom-update']) && !empty($_POST['email-update'])) :
                $nom = $_POST['nom-update'];
                $prenom = $_POST['prenom-update'];
                $email = $_POST['email-update'];
                $this->checkUser($nom,$prenom,$email);
                $this->set_message('Vos information ont bien été mise à jour.', 'success');

            else :
                $this->set_message('Vous devez remplir tous les champs: nom, prénom, email.', 'error');
                header('Location: /utilisateur');
                exit;
            endif;
        else :
            header('Location: /utilisateur');
            exit;
        endif;

        $utilisateur_id = $_SESSION['user-id'];
        $array = compact('nom', 'prenom', 'email', 'utilisateur_id');
        $utilisateur = new ModelUtilisateur();
        $utilisateur->updateUser($array);


        header('Location: /utilisateur');
    }

    private function checkUser($nom, $prenom, $email){
        if(strlen($nom) >= 40 ):
            $this->set_message('Le nom ne peux contenir que 40 caractères maximum', 'error');
            header('Location: /utilisateur');
            exit;
        endif;
        if(strlen($prenom) >= 40 ):
            $this->set_message('Le prénom ne peux contenir que 40 caractères maximum', 'error');
            header('Location: /utilisateur');
            exit;
        endif;
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)):
            $this->set_message('Votre email n\'est pas valide', 'error');
            header('Location: /utilisateur');
            exit;
        endif;
    }
}
