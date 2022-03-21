<?php

namespace App\Controller;

use App\Model\Organisation;
use App\Model\Utilisateur as ModelUtilisateur;
use App\Model\utils\Render;
use App\Controller\utils\ModelController;



class Utilisateur extends ModelController
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
        $utilisateur_id = $_SESSION['user-id'];
        $arrayId = compact('utilisateur_id');

        $utilisateurs = new ModelUtilisateur();
        $utilisateur = $utilisateurs->getUser($arrayUser);
        $adhesionData = $utilisateurs->getUserAdhesionData($arrayId);

        $view = 'compte-utilisateur';
        $array = compact('logo', 'utilisateur', 'messages', 'adhesionData');

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
                $this->set_message('Vos informations ont bien été mise à jour.', 'success');

            else :
                $this->set_message('Vous devez remplir tous les champs.', 'error');
                header('Location: /utilisateur');
                exit;
            endif;
        else :
            header('Location: /utilisateur');
            exit;
        endif;

        if (isset($_POST['age-update']) && isset($_POST['adresse-update'])) :
            if (!empty($_POST['age-update']) && !empty($_POST['adresse-update'])) :
                $date_naissance = $_POST['age-update'];
                $adresse = $_POST['adresse-update'];
                $utilisateur_id = $_SESSION['user-id'];

                $this->checkAdhesion($adresse, $date_naissance);

                $array = compact('date_naissance', 'adresse', 'utilisateur_id');
                $utilisateur = new ModelUtilisateur();
                $utilisateur->updateDataAdhesion($array);

            else :
                $this->set_message('Vous devez remplir tous les champs.', 'error');
                header('Location: /utilisateur');
                exit;
            endif;
        else :
            header('Location: /utilisateur');
            exit;
        endif;

        if (isset($_FILES['file'])) :
            if (!empty($_FILES['file'])) :
                $file = $_FILES['file'];
                $utilisateur_id = $_SESSION['user-id'];

                $this->checkFile($file);
                $photo_identite = $this->uploadFile($file);

                $array = compact('photo_identite', 'utilisateur_id');
                $utilisateur = new ModelUtilisateur();
                $utilisateur->updatePhotoAdhesion($array);

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

    public function adhesion(){
        if ($_SESSION['user-type'] != 'user') :
            header('Location: /login');
            exit;
        endif;
        if (isset($_POST['age-adhesion']) && isset($_POST['adresse-adhesion']) && isset($_FILES['file'])) :
            if (!empty($_POST['age-adhesion']) && !empty($_POST['adresse-adhesion']) && !empty($_FILES['file'])) :


                $date_naissance = $_POST['age-adhesion'];
                $adresse = $_POST['adresse-adhesion'];
                $file = $_FILES['file'];
                $utilisateur_id = $_SESSION['user-id'];
                $type_adhesion = 'demande';

                $this->checkAdhesion($adresse, $date_naissance);
                $this->checkFile($file);
                $photo_identite = $this->uploadFile($file);

                $array = compact('date_naissance', 'adresse', 'photo_identite', 'type_adhesion', 'utilisateur_id');
                $utilisateur = new ModelUtilisateur();
                $utilisateur->demandAdhesion($array);


                $this->set_message('Votre demande d\adhesion à bien été envoyé', 'success');

            else :
                $this->set_message('Vous devez remplir tous les champs.', 'error');
                header('Location: /utilisateur');
                exit;
            endif;
        else :
            header('Location: /utilisateur');
            exit;
        endif;
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

    private function checkAdhesion($adresse, $date){
        if(strlen($adresse) >= 255 ):
            $this->set_message('Votre adresse ne peux contenir que 255 caractères maximum', 'error');
            header('Location: /utilisateur');
            exit;
        endif;

        if (!strtotime($date)) :
            $this->set_message('Votre date de naissance n\'est pas valide', 'error');
            header('Location: /utilisateur');
            exit;
        endif;
    }

    private function checkFile($photo){
        $extensionAllowed = ['jpeg', 'png', 'jpg'];
        $filePath = pathinfo($photo['name']);
        $fileExtension = strtolower($filePath['extension']);
        $fileSize = $photo['size'];

        if (!in_array($fileExtension, $extensionAllowed)) :
            $message = "Ce type d'illustration n'est pas pris en charge.";
            $this->set_message($message, 'error', 'set');
            header('Location: /utilisateur');
            exit;
        endif;

        if ($fileSize > 5000000) :
            $message = "La taille de l'illustration ne doit pas dépasser 5Mo";
            $this->set_message($message, 'error', 'set');
            header('Location: /utilisateur');
            exit;
        endif;
    }
    private function uploadFile($file)
    {
        $upload_dir = '../Public/photo_identite';
        $filePath = pathinfo($file['name']);
        $fileExtension = strtolower($filePath['extension']);
        $fileName = uniqid() . '.' . $fileExtension;
        $tmp_name = $file['tmp_name'];

        move_uploaded_file($tmp_name, "$upload_dir/$fileName");

        return $fileName;
    }
}
