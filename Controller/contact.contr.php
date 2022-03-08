<?php 

namespace App\Controller;

use App\Model\utils\Render;

class Contact
{
    public function index(){

        $view = 'formulaire-contact';
        $array = [];

        Render::renderer($view, $array);

    }
}