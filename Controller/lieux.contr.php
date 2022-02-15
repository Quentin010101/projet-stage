<?php

require_once('Model/Lieux.php');

class Lieux
{
    private $nom;
    private $ville;
    private $code_postale;
    private $gps_lat;
    private $gps_long;

    public function show()
    {
        //Default
        $message_update = [];
        $message_set = [];
        //condition
        if (isset($_SESSION['message_set'])) :
            $message_set = $_SESSION['message_set'];
            $_SESSION['message_set'] = '';
        elseif (isset($_SESSION['message_update'])) :
            $message_update = $_SESSION['message_update'];
            $_SESSION['message_update'] = '';
        endif;

        $location = new Model\Lieux();
        $locations = $location->getLieux();
        $array = compact('locations', 'message_update', 'message_set');
        $view = 'lieux';

        Render::render($view, $array);
    }

    public function modify()
    {

        if (isset($_POST['nom']) && isset($_POST['ville']) && isset($_POST['code_postale']) && isset($_POST['gps_lat']) && isset($_POST['gps_long'])) :
            $this->nom = $_POST['nom'];
            $this->ville = $_POST['ville'];
            $this->code_postale = $_POST['code_postale'];
            $this->gps_lat = $_POST['gps_lat'];
            $this->gps_long = $_POST['gps_long'];

            //Update
            if (isset($_POST['modify']) && isset($_GET['id']) && !empty($_GET['id'])) :
                $check = $this->checkLieux();
                if ($check[0]) :

                    $id = $_GET['id'];
                    $array = ['nom' => $this->nom, 'ville' => $this->ville, 'code_postale' => $this->code_postale, 'gps_lat' => $this->gps_lat, 'gps_long' => $this->gps_long, 'lieux_id' => $id];
                    $location = new Model\Lieux();
                    $location->updateLieux($array);
                else :
                    $_SESSION['message_update'] = $check[1];
                endif;
            //Delete    
            elseif (isset($_POST['delete']) && isset($_GET['id']) && !empty($_GET['id'])) :

                $id = $_GET['id'];
                $array = ['lieux_id' => $id];
                $location = new Model\Lieux();
                $location->deleteLieux($array);

            endif;
        endif;

        header('Location: ./index.php?page=lieux&method=show');
    }

    public function set()
    {
        if (isset($_POST['set'])) :
            if (isset($_POST['nom']) && isset($_POST['ville']) && isset($_POST['code_postale']) && isset($_POST['gps_lat']) && isset($_POST['gps_long'])) :

                $this->nom = $_POST['nom'];
                $this->ville = $_POST['ville'];
                $this->code_postale = $_POST['code_postale'];
                $this->gps_lat = $_POST['gps_lat'];
                $this->gps_long = $_POST['gps_long'];

                $check = $this->checkLieux();
                if ($check[0]) :
                    $array = ['nom' => $this->nom, 'ville' => $this->ville, 'code_postale' => $this->code_postale, 'gps_lat' => $this->gps_lat, 'gps_long' => $this->gps_long];
                    $location = new Model\Lieux();
                    $location->setLieux($array);
                else :
                    $_SESSION['message_set'] = $check[1];
                endif;
            endif;
        endif;
        header('Location: ./index.php?page=lieux&method=show');
    }

    private function checkLieux()
    {
        $nom = $this->nom;
        $ville = $this->ville;
        $code_postale = $this->code_postale;
        $gps_lat = (float)$this->gps_lat;
        $gps_long = (float) $this->gps_long;

        //Default
        $result = true;
        $message = [];
        //Condition
        if (empty($nom) || empty($ville) || empty($code_postale) || empty($gps_lat) || empty($gps_long)) :
            $result = false;
            $message[] = 'Les champs ne peuvent pas être vide.';
        endif;
        if (strlen($nom) >= 40) :
            $result = false;
            $message[] = 'Le nom ne peut contenir que 40 caractères maximum.';
        endif;
        if (strlen($ville) >= 40) :
            $result = false;
            $message[] = 'La ville ne peut contenir que 40 caractères maximum.';
        endif;
        if (strlen($code_postale) !== 5) :
            $result = false;
            $message[] = 'Le code postale doit contenir 5 chiffres.';
        endif;
        if (strlen($gps_lat) >= 20 || strlen($gps_lat) >= 20) :
            $result = false;
            $message[] = 'Les coordonnées gps ne sont pas valide.';
        endif;

        $array = [$result, $message];
        return $array;
    }
}
