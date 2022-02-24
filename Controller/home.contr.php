<?php

use Model\Organisation;
use Model\utils\Render;


class Home
{
        public function index(){

            $organisation = new Organisation;
            $logo = $organisation->getLogo();

            $publication = new \Model\Publication();
            $actualite = $publication->getPublication('actualite', '1month');
            $evenement = $publication->getPublication('evenement', '1month');

            $view = 'accueil';
            $array = compact('actualite', 'evenement', 'logo');

            Render::renderer($view, $array); 
        }
}