<?php


use Model\Lieux;
use Model\Organisation;
use Model\utils\Render;

class publication
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
        endif;

        //Gerer les message
        if (isset($_SESSION['message-publication']) && !empty($_SESSION['message-publication'])) :
            $message = $_SESSION['message-publication'];
            unset($_SESSION['message-publication']);
        endif;
        
        $organisation = new Organisation;
        $logo = $organisation->getLogo();

        $view = 'actualite-evenement';
        $array = compact('type', 'logo');
        if (isset($message)) :
            $array['message'] = $message;
        endif;
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

                if ($check[0]) :
                    $publication = new \Model\Publication();
                    
                    $fileName = $this->uploadFile($_FILES['file']);
                    
                    $publication_id = $publication->set($_POST['date-event'], $_POST['titre'], $_POST['sous-titre'], $_POST['text'], $fileName, $_SESSION['user-type']);

                    if($_SESSION['user-type'] == 'redacteur-evenement' && isset($_POST['lieux'])):
                        $lieux_id = $_POST['lieux'];
                        $array = ['publication_id' => $publication_id[0], 'lieux_id' => $lieux_id];
                        $hebergeur = new Lieux();
                        $hebergeur->setHebergeur($array);
                    endif;

                    $_SESSION['message-publication'] = ['Votre publication à bien été poster'];
                    return header('Location: /publication');
                else :
                    $_SESSION['message-publication'] = $check[1];
                    return header('Location: /publication');
                endif;

            else :
                $_SESSION['message-publication'] = ['Vous devez remplir tous les champs avant de valider.'];
                return header('Location: /publication');
            endif;
        else :
            return header('Location: /publication');
        endif;
    }

    private function checkPublication($titre, $sousTitre, $date, $text, $file)
    {

        $result = true;
        $message = [];
        if (strlen($titre) >= 100) :
            $result = false;
            $message[] = 'Le titre peut contenir 100 caractères max.';
        endif;
        if (strlen($sousTitre) >= 255) :
            $result = false;
            $message[] = 'Le sous-titre peut contenir 255 caractères max.';
        endif;
        if (strlen($text) >= 10000) :
            $result = false;
            $message[] = 'Le contenue ne peut contenir que 10000 caractères max.';
        endif;
        if (!strtotime($date)) :
            $result = false;
            $message[] = 'Le format de la date n\'est pas valide.';
        endif;

        //File
        $extensionAllowed = ['jpeg', 'png', 'jpg'];
        $filePath = pathinfo($file['name']);
        $fileExtension = strtolower($filePath['extension']);
        $fileSize = $file['size'];

        if (!in_array($fileExtension, $extensionAllowed)) :
            $result = false;
            $message[] = "Ce type d'illustration n'est pas pris en charge.";
        endif;

        if ($fileSize > 5000000):
            $result = false;
            $message[] = "La taille de l'illustration ne doit pas dépasser 5Mo";            
        endif;


        $array = [$result, $message];
        return $array;
    }

    public function uploadFile($file){
        $upload_dir = '../Public/upload';
        $filePath = pathinfo($file['name']);
        $fileExtension = strtolower($filePath['extension']);
        $fileName = uniqid() . '.' . $fileExtension;
        $tmp_name = $file['tmp_name'];

        move_uploaded_file($tmp_name, "$upload_dir/$fileName");

        return $fileName;
    }
}
