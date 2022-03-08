<?php

namespace App\Controller;

use App\Model\Membre;
use App\Model\Organisation;
use App\Model\utils\Render;

class Admin extends Controller
{
    public function index()
    {
        if ($_SESSION['user-type'] !== 'admin') :
            return header('Location: /login');
            exit;
        endif;

        // Récupération des messages
        $messages = $this->get_message();

        // Recupération des membres
        $m = new Membre();
        $membres = $m->getAll();

        // Recupération du logo et de l'organisation
        $o = new Organisation;
        $organisation = $o->get();
        $logo = $o->getLogo();

        $view = 'admin';
        $array = compact('organisation', 'membres', 'logo', 'messages');
        Render::renderer($view, $array);
    }

    public function adminPostClub()
    {
        if ($_SESSION['user-type'] !== 'admin') :
            return header('Location: /login');
            exit;
        endif;
        if (isset($_FILES['file']) && isset($_POST['nom']) && isset($_POST['tel']) && isset($_POST['email']) && isset($_POST['adresse']) && isset($_POST['gps_lat']) && isset($_POST['gps_long'])) :
            if (!empty($_POST['nom']) && !empty($_POST['tel']) && !empty($_POST['email']) && !empty($_POST['adresse']) && !empty($_POST['gps_lat']) && !empty($_POST['gps_long'])) :
                $nom = $_POST['nom'];
                $tel = $_POST['tel'];
                $email = $_POST['email'];
                $adresse = $_POST['adresse'];
                $gps_lat = $_POST['gps_lat'];
                $gps_long = $_POST['gps_long'];

                $array = compact('nom', 'adresse', 'email', 'tel', 'gps_lat', 'gps_long');

                $organisation = new Organisation();
                $organisation->set($array);

                $this->set_message("L'organisation du Club à bien été mise à jour", 'success');

            endif;
            if (!empty($_FILES['file']) && $_FILES['file']['error'] !== 4) :

                $file = $_FILES['file'];
                $extensionAllowed = ['jpeg', 'png', 'jpg'];
                $filePath = pathinfo($file['name']);
                $fileExtension = strtolower($filePath['extension']);
                $fileSize = $file['size'];

                if (in_array($fileExtension, $extensionAllowed)) :
                    if ($fileSize < 5000000 && $fileSize > 0) :

                        $logo = $this->uploadFile($file);
                        $arrayLogo = compact('logo');

                        $organisation = new Organisation();
                        $organisation->setLogo($arrayLogo);
                    else :
                        $this->set_message("Le logo que vous avez choisit n'est pas valide.", 'error');
                    endif;
                else :
                    $this->set_message("Le logo que vous avez choisit n'est pas valide.", 'error');
                endif;
            endif;
        endif;

        return header('Location: /admin');
    }

    private function uploadFile($file)
    {
        $upload_dir = '../Public/logo';
        $filePath = pathinfo($file['name']);
        $fileExtension = strtolower($filePath['extension']);
        $fileName = uniqid() . '.' . $fileExtension;
        $tmp_name = $file['tmp_name'];

        move_uploaded_file($tmp_name, "$upload_dir/$fileName");

        return $fileName;
    }

    public function adminPostMembre($id)
    {
        if ($_SESSION['user-type'] !== 'admin') :
            return header('Location: /login');
        endif;
        if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['fonction']) && isset($id)) :

            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $fonction = $_POST['fonction'];

            if (isset($_POST['delete']) && !empty($id)) :

                $membre_id = $id;
                $array = compact('membre_id');

                $membre = new Membre();
                $membre->delete($array);

                $this->set_message("Le membre $nom $prenom à bien été suprimé", "success");

            elseif (isset($_POST['modify']) && !empty($id)) :

                $membre_id = $id;
                $array = compact('membre_id', 'nom', 'prenom', 'fonction');

                $membre = new Membre();
                $membre->update($array);

                $this->set_message("Le membre $nom $prenom à bien été modifié", "success");

            endif;
        endif;
        return header('Location: /admin');
        exit;
    }

    public function adminSetMembre()
    {
        if ($_SESSION['user-type'] !== 'admin') :
            return header('Location: /login');
            exit;
        endif;
        if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['fonction'])) :
            if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['fonction'])) :

                $nom = $_POST['nom'];
                $prenom = $_POST['prenom'];
                $fonction = $_POST['fonction'];

                $array = compact('nom', 'prenom', 'fonction');
                $membre = new Membre();
                $membre->set($array);

                $this->set_message("Le membre $nom $prenom à bien été crée", "success");

            endif;
        endif;
        return header('Location: /admin');
        exit;
    }
}
