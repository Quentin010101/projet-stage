<?php 

namespace App\Controller;

use Exception;
use App\Model\Organisation;
use App\Model\utils\Render;
use App\Controller\utils\ModelController;



class Contact extends ModelController
{
    public function index(){

        $messages = $this->get_message();

        $view = 'formulaire-contact';
        $array = compact('messages');

        Render::renderer($view, $array);

    }

    public function contactPost(){
        if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email']) && isset($_POST['tel']) && isset($_POST['objet']) && isset($_POST['demande']) && isset($_POST['message'])):
            if(!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['email']) && !empty($_POST['tel']) && !empty($_POST['objet']) && !empty($_POST['demande']) && !empty($_POST['message'])):
                $nom = $_POST['nom'];
                $prenom = $_POST['prenom'];
                $email = $_POST['email'];
                $tel = $_POST['tel'];
                $objet = $_POST['objet'];
                $demande = $_POST['demande'];
                $message = $_POST['message'];

                $organisation = new Organisation();
                $emailOrganisation = $organisation->getEmail();
                
                $this->contactMail($nom,$prenom,$email,$tel,$objet,$demande, $message, $emailOrganisation['email']);
                header('Location: /contact');
                exit;
            else:
                $this->set_message('Tous les champs doivent être remplit.','error');
                header('Location: /contact');
                exit;
            endif;
        else:
            throw new Exception('Une erreur es survenue');
        endif;
    }

    private function contactMail($nom,$prenom,$email,$tel,$objet,$demande, $messageClient, $emailOrganisation){

        $nom = strtoupper($nom);
        $prenom = ucfirst($prenom);
        $demande = ucfirst($demande);


        //Email de contact
        $to = $emailOrganisation;
        $subject = $objet;
        $message = "Mr, Mme: <strong>$nom $prenom</strong> <br>
                    Email: <strong>$email</strong> <br>
                    Tel: <strong>$tel</strong> <br>
                    Type de demande: <strong>$demande</strong> <br>
                    Message: <br>
                    <hr>
                    <br>
                    $messageClient
                    <br>
                    <br>
                    <hr>";
        $message = wordwrap($message, 70, "\r\n");
        

        $headers = 'Content-type: text/html; charset=iso-8859-1';
        $headers .= 'From: projet-stage@cozic.alwaysdata.net';
        
        if(mail($to, $subject, $message, $headers)):
            $this->set_message('Votre demande à bien été envoyé', 'success');
        else:
            throw new Exception('Une erreur est survenu');
        endif;        

    }
}