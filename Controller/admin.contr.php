<?php

use Model\Membre;
use Model\Organisation;
use Model\utils\Render;

class Admin
{
    public function index(){
        if($_SESSION['user-type'] !== 'admin') :
            return header('Location: /login');
        endif;
        $m = new Membre();
        $membres = $m->getAll();

        $o = new Organisation;
        $organisation = $o->get();
        $logo = $o->getLogo();

        $view = 'admin';
        $array = compact('organisation', 'membres', 'logo');
        Render::renderer($view, $array);
    }

    public function adminPostClub(){
        if($_SESSION['user-type'] !== 'admin') :
            return header('Location: /login');
        endif;
        if(isset($_FILES['file']) && isset($_POST['nom']) && isset($_POST['tel']) && isset($_POST['email']) && isset($_POST['adresse']) && isset($_POST['gps_lat']) && isset($_POST['gps_long'])):
            if(!empty($_POST['nom']) && !empty($_POST['tel']) && !empty($_POST['email']) && !empty($_POST['adresse']) && !empty($_POST['gps_lat']) && !empty($_POST['gps_long'])):
                $nom = $_POST['nom'];
                $tel = $_POST['tel'];
                $email = $_POST['email'];
                $adresse = $_POST['adresse'];
                $gps_lat = $_POST['gps_lat'];
                $gps_long = $_POST['gps_long'];

                $array = compact('nom','adresse','email','tel','gps_lat','gps_long');

                $organisation = new Organisation();
                $organisation->set($array);
            endif;
            if(!empty($_FILES['file'])):
                
                $file = $_FILES['file'];
                $extensionAllowed = ['jpeg', 'png', 'jpg'];
                $filePath = pathinfo($file['name']);
                $fileExtension = strtolower($filePath['extension']);
                $fileSize = $file['size'];
                
                if (in_array($fileExtension, $extensionAllowed)) :
                    if ($fileSize < 5000000 && $fileSize > 0):

                        $logo = $this->uploadFile($file);
                        $arrayLogo = compact('logo');

                        $organisation = new Organisation();
                        $organisation->setLogo($arrayLogo);
       
                    endif;
                endif;
            endif;
        endif;

        return header('Location: /admin');
    }

    private function uploadFile($file){
        $upload_dir = '../Public/logo';
        $filePath = pathinfo($file['name']);
        $fileExtension = strtolower($filePath['extension']);
        $fileName = uniqid() . '.' . $fileExtension;
        $tmp_name = $file['tmp_name'];

        move_uploaded_file($tmp_name, "$upload_dir/$fileName");

        return $fileName;
    }

    public function adminPostMembre($id){
        if($_SESSION['user-type'] !== 'admin') :
            return header('Location: /login');
        endif;
        if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['fonction']) && isset($id)):
            if (isset($_POST['delete']) && !empty($id)):

                $membre_id = $id;
                $array = compact('membre_id');

                $membre = new Membre();
                $membre->delete($array);
            elseif (isset($_POST['modify']) && !empty($id)):

                $membre_id = $id;
                $nom = $_POST['nom'];
                $prenom = $_POST['prenom'];
                $fonction = $_POST['fonction'];
                $array = compact('membre_id', 'nom', 'prenom', 'fonction');

                $membre = new Membre();
                $membre->update($array);
            endif;
        endif;
        return header('Location: /admin');

    }

    public function adminSetMembre(){
        if($_SESSION['user-type'] !== 'admin') :
            return header('Location: /login');
        endif;
        if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['fonction'])):
            if(!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['fonction'])):

                $nom = $_POST['nom'];
                $prenom = $_POST['prenom'];
                $fonction = $_POST['fonction'];

                $array = compact('nom', 'prenom', 'fonction');
                $membre = new Membre();
                $membre->set($array);

            endif;
        endif;
        return header('Location: /admin');

    }
}