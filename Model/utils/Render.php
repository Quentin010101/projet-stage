<?php


class Render
{
    public static function render($view, array $variable){
        //extraction des variables
        if(!empty($variable)):
            extract($variable);
        endif;

        //Mise en place de la view
        ob_start();
        require_once('./View/' . $view . '.html.php');
        $pageContent = ob_get_clean();

        //Mise en place du template
        require_once('./View/template/template.php');
    }
}