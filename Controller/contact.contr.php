<?php 

namespace App\Controller;

use Exception;
use App\Model\Organisation;
use App\Model\utils\Render;

class Contact extends Controller
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
                
                $this->contactMail($nom,$prenom,$email,$tel,$objet,$demande, $message, $emailOrganisation);
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

        //Email de contact
        $to = $emailOrganisation;
        $subject = $objet;
        $message = "$nom $prenom <br>
                    Email: $email <br>
                    Tel: $tel <br>
                    Type de demande $demande <br>
                    $messageClient";
        $message = wordwrap($message, 70, "\r\n");
        
        $headers = array(
            'From' => 'projet-stage@cozic.alwaysdata.net',
            'Content-type: text/html; charset=iso-8859-1',
            'MIME-Version: 1.0',
            'X-Mailer' => 'PHP/' . phpversion()
        );

        if(mail($to, $subject, $message, $headers)):
            $this->set_message('Votre demande à bien été envoyé', 'success');
        else:
            throw new Exception('Une erreur est survenu');
        endif;        

    }
}