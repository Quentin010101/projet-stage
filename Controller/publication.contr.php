<?php

namespace App\Controller;

use App\Model\Lieux;
use App\Model\Publication as publi;
use App\Model\Organisation;
use App\Model\utils\Render;
use App\Controller\utils\ModelController;


class Publication extends ModelController
{
    public function index()
    {

        if (isset($_SESSION['user-type']) && ($_SESSION['user-type'] == "redacteur-evenement" || $_SESSION['user-type'] == "redacteur-actualite")) :

            if ($_SESSION['user-type'] == "redacteur-evenement") :
                $lieu = new Lieux();
                $lieux = $lieu->getLieux();
                $type = 'evenement';
            elseif ($_SESSION['user-type'] == "redacteur-actualite") :
                $type = 'actualite';
            endif;

        else :
            return header('Location: /login');
            exit;
        endif;

        //Gerer les message
        $messages = $this->get_message();

        // Récupération du logo
        $organisation = new Organisation;
        $logo = $organisation->getLogo();

        $view = 'actualite-evenement';
        $array = compact('type', 'logo', 'messages');

        if (isset($lieux)) :
            $array['lieux'] = $lieux;
        endif;
        Render::renderer($view, $array);
    }

    public function set()
    {
        if (isset($_POST['titre']) && isset($_POST['sous-titre']) && isset($_POST['date-event']) && isset($_POST['text']) && isset($_FILES['file'])) :
            if (!empty($_POST['titre']) && !empty($_POST['sous-titre']) && !empty($_POST['date-event']) && !empty($_POST['text']) && !empty($_FILES['file'])) :

                $check = $this->checkPublication($_POST['titre'], $_POST['sous-titre'], $_POST['date-event'], $_POST['text'], $_FILES['file']);

                if ($check) :

                    $publication = new publi();

                    $fileName = $this->uploadFile($_FILES['file']);

                    $publication_id = $publication->set($_POST['date-event'], $_POST['titre'], $_POST['sous-titre'], $_POST['text'], $fileName, $_SESSION['user-type']);

                    if ($_SESSION['user-type'] == 'redacteur-evenement') :
                        if (isset($_POST['lieux']) && isset($_POST['date']) && isset($_POST['time'])) :
                            if (!empty($_POST['lieux']) && !empty($_POST['date']) && !empty($_POST['time']) && count($_POST['lieux']) == count($_POST['date']) && count($_POST['lieux']) === count($_POST['time'])) :
                                $All_lieux = $_POST['lieux'];
                                $All_date = $_POST['date'];
                                $All_time = $_POST['time'];

                                for($i = 0; $i < count($All_lieux); $i++):
                                    $lieux = $All_lieux[$i];
                                    $date = $All_date[$i];
                                    $time = $All_time[$i];

                                    
                                    $array = ['publication_id' => $publication_id[0], 'lieux_id' => $lieux, 'date' => $date, 'time' => $time];
                                    $hebergeur = new Lieux();
                                    $hebergeur->setHebergeur($array);
                                endfor;
                            else :
                                $this->set_message('Vous devez renseigner tout les champs concernant les lieux', 'error');
                                return header('Location: /publication');
                                exit;
                            endif;
                        endif;
                    endif;

                    $this->set_message('Votre publication à bien été posté', 'success');
                    return header('Location: /publication');
                    exit;
                else :
                    return header('Location: /publication');
                    exit;
                endif;

            else :
                $this->set_message('Vous devez remplir tous les champs avant de valider.', 'error', 'set');
                return header('Location: /publication');
                exit;
            endif;
        else :
            return header('Location: /publication');
            exit;
        endif;
    }

    private function checkPublication($titre, $sousTitre, $date, $text, $file)
    {

        $result = true;

        if (strlen($titre) >= 100) :
            $result = false;
            $message = 'Le titre peut contenir 100 caractères max.';
            $this->set_message($message, 'error', 'set');
        endif;
        if (strlen($sousTitre) >= 255) :
            $result = false;
            $message = 'Le sous-titre peut contenir 255 caractères max.';
            $this->set_message($message, 'error', 'set');
        endif;
        if (strlen($text) >= 10000) :
            $result = false;
            $message = 'Le contenue ne peut contenir que 10000 caractères max.';
            $this->set_message($message, 'error', 'set');
        endif;
        if (!strtotime($date)) :
            $result = false;
            $message = 'Le format de la date n\'est pas valide.';
            $this->set_message($message, 'error', 'set');
        endif;

        //File
        $extensionAllowed = ['jpeg', 'png', 'jpg'];
        $filePath = pathinfo($file['name']);
        $fileExtension = strtolower($filePath['extension']);
        $fileSize = $file['size'];

        if (!in_array($fileExtension, $extensionAllowed)) :
            $result = false;
            $message = "Ce type d'illustration n'est pas pris en charge.";
            $this->set_message($message, 'error', 'set');
        endif;

        if ($fileSize > 5000000) :
            $result = false;
            $message = "La taille de l'illustration ne doit pas dépasser 5Mo";
            $this->set_message($message, 'error', 'set');
        endif;

        return $result;
    }

    public function uploadFile($file)
    {
        $upload_dir = '../Public/upload';
        $filePath = pathinfo($file['name']);
        $fileExtension = strtolower($filePath['extension']);
        $fileName = uniqid() . '.' . $fileExtension;
        $tmp_name = $file['tmp_name'];

        move_uploaded_file($tmp_name, "$upload_dir/$fileName");

        return $fileName;
    }
}
