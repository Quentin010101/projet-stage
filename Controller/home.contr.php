<?php

namespace App\Controller;

use App\Model\Publication;
use App\Model\Organisation;
use App\Model\utils\Render;


class Home
{
        public function index(){

            $organisation = new Organisation;
            $logo = $organisation->getLogo();
            $organisationName = $organisation->getName();

            $publication = new Publication();
            $actualite = $publication->getPublication('actualite', '1month');
            $evenement = $publication->getPublication('evenement', '1month');

            $view = 'accueil';
            $array = compact('actualite', 'evenement', 'logo', 'organisationName');

            Render::renderer($view, $array); 
        }
}