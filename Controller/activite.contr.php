<?php

namespace App\Controller;

use App\Model\Organisation;
use App\Model\utils\Render;

class Activite
{
    public function index(){

        $organisation = new Organisation();
        $logo = $organisation->getLogo();

        $view = 'activite';
        $array = compact('logo');

        Render::renderer($view, $array);
    }
}
