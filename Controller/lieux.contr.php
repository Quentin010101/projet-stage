<?php

namespace App\Controller;

use App\Model\Lieux as ModelLieux;

class Lieux
{
    public function index()
    {
        if (isset($_SESSION['user-type']) && $_SESSION['user-type'] === 'redacteur-evenement') {
            $data = json_decode(file_get_contents("php://input"));

            if (isset($data->nom) && isset($data->ville) && isset($data->code) && isset($data->lat) && isset($data->long)) :

                $nom = $data->nom;
                $ville = $data->ville;
                $code_postale = $data->code;
                $gps_lat = $data->lat;
                $gps_long = $data->long;

                $array = compact('nom', 'ville', 'code_postale', 'gps_lat', 'gps_long');

                $lieu = new ModelLieux();
                $lieu->setLieux($array);

                $lieux = $lieu->getLieux();

                echo '<option value="">--Selectionner un lieu</option>';
                echo '<option value="">Aucun lieu disponible</option>';
                foreach ($lieux as $l) :
                    echo  '<option value="' . htmlspecialchars($l['lieux_id']) . '" >' .
                        htmlspecialchars($l['ville']) . ' - ' . htmlspecialchars($l['nom'])
                        . '</option>';
                endforeach;
            endif;
        } else {
            header('Location: /login');
            exit;
        }
    }
    public function update()
    {
        if (isset($_SESSION['user-type']) && $_SESSION['user-type'] === 'redacteur-evenement') {

                $lieu = new ModelLieux();
                $lieux = $lieu->getLieux();

                echo '<option value="">--Selectionner un lieu</option>';
                echo '<option value="">Aucun lieu disponible</option>';
                foreach ($lieux as $l) :
                    echo  '<option value="' . htmlspecialchars($l['lieux_id']) . '" >' .
                        htmlspecialchars($l['ville']) . ' - ' . htmlspecialchars($l['nom'])
                        . '</option>';
                endforeach;
        } else {
            header('Location: /login');
            exit;
        }
    }

    public function modify()
    {
        if (isset($_SESSION['user-type']) && $_SESSION['user-type'] === 'redacteur-evenement') {
            $data = json_decode(file_get_contents("php://input"));

            if (isset($data->nom) && isset($data->ville) && isset($data->code) && isset($data->lat) && isset($data->long) && isset($data->id)) :

                $nom = $data->nom;
                $ville = $data->ville;
                $code_postale = $data->code;
                $gps_lat = $data->lat;
                $gps_long = $data->long;
                $lieux_id = $data->id;

                $array = compact('nom', 'ville', 'code_postale', 'gps_lat', 'gps_long', 'lieux_id');

                $lieu = new ModelLieux();
                $lieu->updateLieux($array);

                $lieux = $lieu->getLieux();

                echo '<i class="fas fa-close" onclick="close_modify()"></i>
                    <h1>Modification d\'un lieux:</h1>';
                foreach ($lieux as $l) :
                    echo '<form action="" method="post">
                    <div class="container-modify">
                        <p>' . htmlspecialchars($l['nom']) . ' à ' . htmlspecialchars($l['ville']) . ' ' . htmlspecialchars($l['code_postale']) . '</p>
                        <p>Coordonnées lat: ' . htmlspecialchars($l['gps_lat']) . ' long: ' . htmlspecialchars($l['gps_long']) . '</p>
                        <div class="hidden input-container">
                            <div>
                                <div>
                                <label for="nom">Nom</label>
                                <span>*Champ obligatoire</span>
                                </div>
                                <input type="text" name="nom" class="nom-modify" value="' . htmlspecialchars($l['nom']) . '" placeholder="Entrer un nom de lieux">
                            </div>
                            <div>
                                <div>
                                <label for="ville">Ville</label>
                                <span>*Champ obligatoire</span>
                                </div>
                                <input type="text" name="ville" class="ville-modify" value="' . htmlspecialchars($l['ville']) . '" placeholder="Entrer un nom de ville">
                            </div>
                            <div>
                                <div>
                                <label for="code_postale">Code postale</label>
                                <span>*Champ obligatoire</span>
                                </div>
                                <input type="text" name="code_postale" class="code-modify" value="' . htmlspecialchars($l['code_postale']) . '" placeholder="Entrer un code postale">
                            </div>
                            <div>
                                <div>
                                <label for="gps_lat">Latitude</label>
                                <span>*Champ obligatoire</span>
                                </div>
                                <input type="number" name="gps_lat" class="lat-modify" value="' . htmlspecialchars($l['gps_lat']) . '" placeholder="Entrer une latitude" step="any">
                            </div>
                            <div>
                                <div>
                                <label for="gps_long">Longitude</label>
                                <span>*Champ obligatoire</span>
                                </div>
                                <input type="number" name="gps_long" class="long-modify" value="' . htmlspecialchars($l['gps_long']) . '" placeholder="Entrer une longitude" step="any">
                            </div>
                            <input type="hidden" class="id-modify" name="id_modify" value="' . htmlspecialchars($l['lieux_id']) . '" >
                        </div>
                        <div class="container-button-modify">
                            <div>
                                <button type="button" class="button-validate-modify b-modify" onclick="b_modify(this)">Modifier</button>
                                <button type="button" class="button-validate-delete b-delete" onclick="b_delete(this)">Supprimer</button>
                            </div>
                            <div>
                                <button type="button" class="button-validate-modify hidden b-v-modify" onclick="b_v_modify(this)">Valider Modification</button>
                                <button type="button" class="hidden button-validate-cancel b-cancel" onclick="b_cancel(this)">Annuler</button>
                            </div>
                        </div>
                    </div>
                </form>';
                endforeach;
            endif;
        } else {
            header('Location: /login');
            exit;
        }
    }

    public function delete()
    {
        if (isset($_SESSION['user-type']) && $_SESSION['user-type'] === 'redacteur-evenement') {
            $data = json_decode(file_get_contents("php://input"));

            if (isset($data->id)) :


                $lieux_id = $data->id;

                $array = compact('lieux_id');

                $lieu = new ModelLieux();
                $lieu->deleteLieux($array);

                $lieux = $lieu->getLieux();

                echo '<i class="fas fa-close" onclick="close_modify()"></i>
                    <h1>Modification d\'un lieux:</h1>';
                foreach ($lieux as $l) :
                    echo '<form action="" method="post">
                    <div class="container-modify">
                        <p>' . htmlspecialchars($l['nom']) . ' à ' . htmlspecialchars($l['ville']) . ' ' . htmlspecialchars($l['code_postale']) . '</p>
                        <p>Coordonnées lat: ' . htmlspecialchars($l['gps_lat']) . ' long: ' . htmlspecialchars($l['gps_long']) . '</p>
                        <div class="hidden input-container">
                            <div>
                                <label for="nom">Nom</label>
                                <input type="text" name="nom" class="nom-modify" value="' . htmlspecialchars($l['nom']) . '" placeholder="Entrer un nom de lieux">
                            </div>
                            <div>
                                <label for="ville">Ville</label>
                                <input type="text" name="ville" class="ville-modify" value="' . htmlspecialchars($l['ville']) . '" placeholder="Entrer un nom de ville">
                            </div>
                            <div>
                                <label for="code_postale">Code postale</label>
                                <input type="text" name="code_postale" class="code-modify" value="' . htmlspecialchars($l['code_postale']) . '" placeholder="Entrer un code postale">
                            </div>
                            <div>
                                <label for="gps_lat">Latitude</label>
                                <input type="number" name="gps_lat" class="lat-modify" value="' . htmlspecialchars($l['gps_lat']) . '" placeholder="Entrer une latitude" step="any">
                            </div>
                            <div>
                                <label for="gps_long">Longitude</label>
                                <input type="number" name="gps_long" class="long-modify" value="' . htmlspecialchars($l['gps_long']) . '" placeholder="Entrer une longitude" step="any">
                            </div>
                            <input type="hidden" class="id-modify" name="id_modify" value="' . htmlspecialchars($l['lieux_id']) . '" >
                        </div>
                        <div class="container-button-modify">
                            <div>
                                <button type="button" class="button-validate-modify b-modify" onclick="b_modify(this)">Modifier</button>
                                <button type="button" class="button-validate-delete b-delete" onclick="b_delete(this)">Supprimer</button>
                            </div>
                            <div>
                                <button type="button" class="button-validate-modify hidden b-v-modify" onclick="b_v_modify(this)">Valider Modification</button>
                                <button type="button" class="hidden button-validate-cancel b-cancel" onclick="b_cancel(this)">Annuler</button>
                            </div>
                        </div>
                    </div>
                </form>';
                endforeach;
            endif;
        } else {
            header('Location: /login');
            exit;
        }
    }
}
