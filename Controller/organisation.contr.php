<?php

namespace App\Controller;

use App\Model\Membre;
use App\Model\Organisation as org;
use App\Model\utils\Render;

class Organisation
{
    public function index()
    {

        // Récupération de l'organisation
        $organisations = new org;
        $logo = $organisations->getLogo();
        $organisation = $organisations->get();

        // Récupération des membres du bureau
        $membre = new Membre();
        $membres = $membre->getAll();

        $view = 'organisation';
        $array = compact('organisation', 'logo', 'membres');

        Render::renderer($view, $array);
    }


}
