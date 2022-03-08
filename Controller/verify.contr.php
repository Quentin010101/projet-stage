<?php

namespace App\Controller;

use Exception;
use App\Model\Utilisateur;
use App\Model\utils\Render;

class Verify extends Controller
{
    public function verifyaccount($array)
    {

        if (count($array) == 2) :

            $utilisateur_id = $array['utilisateur_id'];
            $token = $array['token'];

            $array = compact('utilisateur_id');
            $utilisateur = new Utilisateur();
            $token_confirmation = $utilisateur->confirmUser($array);

            if ($token === $token_confirmation['token']) :

                $array = compact('utilisateur_id');
                $utilisateur->activateAccount($array);
                $this->set_message('Votre compte à bien été activé!', 'success');
                return header('Location: /login');
                exit;

            else :
                throw new Exception('Une erreur est survenu.');
            endif;

        else :
            throw new Exception('Une erreur est survenu.');
        endif;
    }

    public function passwordRecover($array)
    {

        if (count($array) == 2) :

            $utilisateur_id = $array['utilisateur_id'];
            $tokenPassword = $array['token'];

            $array = compact('utilisateur_id');
            $utilisateur = new Utilisateur();
            $token_confirmation = $utilisateur->confirmUser($array);

            if ($tokenPassword === $token_confirmation['token']) :

                $array = compact('tokenPassword', 'utilisateur_id');
                $view = 'login-passwordRecover';

                Render::renderer($view, $array);
                exit;

            else :
                throw new Exception('Une erreur est survenu.');
            endif;

        else :
            throw new Exception('Une erreur est survenu.');
        endif;
    }

    public function passwordRecoverPost($array)
    {
        if (isset($_POST['password']) && isset($_POST['password-confirmation']) && isset($_POST['token']) && isset($_POST['user-id'])) :
            if (!empty($_POST['password']) && !empty($_POST['password-confirmation']) && !empty($_POST['token']) && !empty($_POST['user-id'])) :

                $password = $_POST['password'];
                $passwordConfirmation = $_POST['password-confirmation'];
                $token = $_POST['token'];
                $utilisateur_id = $_POST['user-id'];

                if ($password === $passwordConfirmation) :
                    $array = compact('utilisateur_id');
                    $utilisateur = new Utilisateur();
                    $token_confirmation = $utilisateur->confirmUser($array);

                    if ($token === $token_confirmation['token']) :
                        $array = compact('password', 'utilisateur_id');
                        $utilisateur->updatePassword($array);
                        $this->set_message('Votre mot de passe à bien été mis à jour', 'success');
                        header('Location: /login');
                        exit;
                    else :
                        throw new Exception('Une erreur est survenu.');
                    endif;
                else :
                    throw new Exception('Une erreur est survenu.');
                endif;

            else :
                throw new Exception('Une erreur est survenu.');
            endif;
        else :
            throw new Exception('Une erreur est survenu.');
        endif;
    }
}
