<?php

namespace App\Controller;

use App\Model\Lieux as l;
use App\Model\Organisation;
use App\Model\utils\Render;

class Lieux extends Controller
{
    private $nom;
    private $ville;
    private $code_postale;
    private $gps_lat;
    private $gps_long;

    public function index()
    {     
        if (isset($_SESSION['user-type']) && ($_SESSION['user-type'] == "redacteur-evenement")) :
                $type = 'evenement';
        else :
            return header('Location: /login');
            exit;
        endif;

        // Recuperation des messages
        $messages = $this->get_message();

        // Recuperation du logo
        $organisation = new Organisation;
        $logo = $organisation->getLogo();

        // Recuperation des lieux
        $location = new l();
        $locations = $location->getLieux();

        $array = compact('locations', 'messages','type','logo');
        $view = 'lieux';

        Render::renderer($view, $array);
    }

    public function modify($id)
    {
        // Code servant à trier les messages lors de l'affichage
        $code = 'modify';

        if (isset($_POST['nom']) && isset($_POST['ville']) && isset($_POST['code_postale']) && isset($_POST['gps_lat']) && isset($_POST['gps_long'])) :
            $this->nom = $_POST['nom'];
            $this->ville = $_POST['ville'];
            $this->code_postale = $_POST['code_postale'];
            $this->gps_lat = $_POST['gps_lat'];
            $this->gps_long = $_POST['gps_long'];
            
            //Update

            if (isset($_POST['modify']) && isset($id) && !empty($id)) :
                $check = $this->checkLieux($code);
                if ($check) :
                   
                    $array = ['nom' => $this->nom, 'ville' => $this->ville, 'code_postale' => $this->code_postale, 'gps_lat' => $this->gps_lat, 'gps_long' => $this->gps_long, 'lieux_id' => $id];
                    $location = new l();
                    $location->updateLieux($array);

                    $this->set_message("le lieux $this->nom à bien été mis à jour",'success');

                endif;
            //Delete    
            elseif (isset($_POST['delete']) && isset($id) && !empty($id)) :

                $array = ['lieux_id' => $id];
                $location = new l();
                $location->deleteLieux($array);

                $this->set_message("le lieux $this->nom à bien été supprimé",'success');

            endif;
        endif;

        header('Location: /lieux');
        exit;
    }

    public function set()
    {
        // Code servant à trier les messages lors de l'affichage
        $code = 'set';

        if (isset($_POST['set'])) :
            if (isset($_POST['nom']) && isset($_POST['ville']) && isset($_POST['code_postale']) && isset($_POST['gps_lat']) && isset($_POST['gps_long'])) :

                $this->nom = $_POST['nom'];
                $this->ville = $_POST['ville'];
                $this->code_postale = $_POST['code_postale'];
                $this->gps_lat = $_POST['gps_lat'];
                $this->gps_long = $_POST['gps_long'];

                $check = $this->checkLieux($code);
                if ($check) :
                    $array = ['nom' => $this->nom, 'ville' => $this->ville, 'code_postale' => $this->code_postale, 'gps_lat' => $this->gps_lat, 'gps_long' => $this->gps_long];
                    $location = new l();
                    $location->setLieux($array);

                    $this->set_message("le lieux $this->nom à bien été ajouté", 'success');
                endif;
            endif;
        endif;
        header('Location: /lieux');
        exit;
    }

    private function checkLieux($code)
    {
        $nom = $this->nom;
        $ville = $this->ville;
        $code_postale = $this->code_postale;
        $gps_lat = (float)$this->gps_lat;
        $gps_long = (float) $this->gps_long;

        //Default
        $result = true;

        //Condition
        if (empty($nom) || empty($ville) || empty($code_postale) || empty($gps_lat) || empty($gps_long)) :
            $result = false;
            $message = 'Les champs ne peuvent pas être vide.';
            $this->set_message($message, 'error', $code);
        endif;
        if (strlen($nom) >= 40) :
            $result = false;
            $message = 'Le nom ne peut contenir que 40 caractères maximum.';
            $this->set_message($message, 'error', $code);
        endif;
        if (strlen($ville) >= 40) :
            $result = false;
            $message = 'La ville ne peut contenir que 40 caractères maximum.';
            $this->set_message($message, 'error', $code);
        endif;
        if (strlen($code_postale) !== 5) :
            $result = false;
            $message = 'Le code postale doit contenir 5 chiffres.';
            $this->set_message($message, 'error', $code);
        endif;
        if (strlen($gps_lat) >= 20 || strlen($gps_lat) >= 20) :
            $result = false;
            $message = 'Les coordonnées gps ne sont pas valide.';
            $this->set_message($message, 'error', $code);
        endif;


        return $result;
    }
}
