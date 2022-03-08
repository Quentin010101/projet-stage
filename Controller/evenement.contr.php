<?php

namespace App\Controller;

use App\Model\Publication;
use App\Model\Organisation;
use App\Model\utils\Render;

class Evenement
{
    public function index(){
        
        $publication = new Publication();
        $evenement = $publication->getPublication('evenement','1year');

        $organisation = new Organisation;
        $logo = $organisation->getLogo();

        $view = 'evenement';
        $array = compact('logo','evenement');
        Render::renderer($view, $array);
    }
}