<?php

namespace Model\utils;

class Rooter
{
    public static function Redirect()
    {
        $array = ['home', 'lieux', 'publication', 'login', 'admin','actualite','evenement'];
        
        if (isset($_GET['url']) && !empty($_GET['url'])) :
            //Transforme l'url en tableau
            if(substr($_GET['url'], -1) == "/"):
                $newUrl = rtrim($_GET['url'], "/");

               return header('Location: /' . $newUrl);
            endif;
            $url = explode('/', $_GET['url']);

            if(in_array($url[0], $array)){
                $className = ucfirst($url[0]);
                
                if(isset($url[1]) && !empty($url[1])){
                    $methodName = $url[1];
                }
                else{
                    $methodName = 'index';
                }
                $id ='';
                if(isset($url[2])):
                    $id = $url[2];
                endif;

                $instance = new $className();
                $instance->$methodName($id);

            }
            else{
                throw new \Exception("Url non valide.");
            }


        //Absence d'url => page d'acceuil    
        else:
            return header('Location: /home');
        endif;



        //instanciation

    }
}
