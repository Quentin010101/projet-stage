<?php

namespace App\Controller;

use App\Model\Publication;
use App\Model\Organisation;
use App\Model\utils\Render;

class Actualite
{
    public function index(){
        
        $publication = new Publication();
        $actualite = $publication->getPublication('actualite','1year');

        $organisation = new Organisation;
        $logo = $organisation->getLogo();

        $view = 'actualite';
        $array = compact('logo','actualite');
        Render::renderer($view, $array);
    }
}