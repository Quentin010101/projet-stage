<?php

namespace App\Controller;

use App\Model\Organisation;
use App\Model\utils\Render;

class Histoire
{

    public function index()
        {
    
            // Récupération du logo
            $organisations = new Organisation;
            $logo = $organisations->getLogo();
    
            $view = 'organisation-histoire';
            $array = compact('logo');
    
            Render::renderer($view, $array);
        }
}



