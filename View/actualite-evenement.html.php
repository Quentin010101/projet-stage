<?php $pageTitle = 'Redaction' ?>
<?php $pageCss = 'redaction.css' ?>
<?php $pageScript[] = 'ajax.js' ?>


<?php
include('../View/include/_header.html.php');
?>
<main>
    <section id="title" class="flex">
        <h1>Espace rédaction <span><?php echo htmlspecialchars(ucfirst($type)) ?></span></h1>
        <div>
            <h2>Bonjour <span><?php echo htmlspecialchars($_SESSION['firstname']); ?></span></h2>
            <div>
                <a href="/login/logout"> Deconnexion <i class="fas fa-sign-out-alt"></i></a>
            </div>
        </div>
    </section>
    <section id="redaction">
        <div class="wrapper">
            <h2>Nouvelle Publication:</h2>
            <form action="/publication/set" method="POST" enctype="multipart/form-data">
                <div>
                    <div>
                        <label for="titre">Titre</label>
                        <input type="text" id="titre" name="titre" placeholder="Entrez un titre">
                    </div>
                    <div>
                        <label for="sous-titre">Sous-titre</label>
                        <input type="text" id="sous-titre" name="sous-titre" placeholder="Entrez un sous-titre">
                    </div>
                    <div>
                        <label for="date">Date de l'actualité</label>
                        <input type="date" id="date" name="date-event">
                    </div>
                </div>
                <div>
                    <label for="text">Contenu</label>
                    <textarea name="text" id="text" cols="30" rows="10" placeholder="Entrez votre text"></textarea>
                </div>
                <?php
                $label = 'Ajouter une illustration';
                include('../View/include/_input-file.html.php');
                ?>
                <?php
                if ($_SESSION['user-type'] == 'redacteur-evenement') :
                ?>
                    <div>
                        <label for="lieux">Selectionner un lieu</label>
                        <span>*Optionel</span>
                        <select id="lieux">
                            <?php
                            if (isset($lieux) && !empty($lieux)) :
                            ?>
                                <option value="" selected="true">--Selectionner un lieu</option>
                                <option value="">Aucun Lieu</option>
                                <?php
                                foreach ($lieux as $key => $l) :
                                ?>
                                    <option value="<?php echo htmlspecialchars($l['lieux_id']); ?>"><?php echo htmlspecialchars($l['ville']) . ' - ' . htmlspecialchars($l['nom']); ?></option>
                                <?php
                                endforeach;
                            else :
                                ?>
                                <option value="">Aucun lieu disponible</option>
                            <?php
                            endif;
                            ?>
                        </select>
                        <div id="container-lieux-selected">

                        </div>
                        <div class="container-button">
                            <button id="button-set" type="button">Ajouter un lieu à la liste</button>
                            <button id="button-modify" type="button">Modifier un lieu de la liste</button>
                        </div>
                    </div>
                <?php
                endif;
                ?>
                <?php
                if (isset($messages) && !empty($messages)) :
                    foreach ($messages as $m) :
                        if ($m['code'] == 'set') :
                ?>
                            <div id="wrong">
                                <p><?php echo htmlspecialchars($m['message']); ?></p>
                            </div>
                <?php
                        endif;
                    endforeach;
                endif;
                ?>
                <div>
                    <input type="submit" value="Envoyer" name="<?php echo htmlspecialchars($type) . 'submit'; ?>">
                </div>
            </form>
        </div>
    </section>
    <?php
    if ($_SESSION['user-type'] == 'redacteur-evenement') :
    ?>
        <section id='lieux-set' class='hidden'>
            <div class="overlay">
                <i class="fas fa-close"></i>
                <h1>Ajout d'un lieux:</h1>
                <form id='form-set' action="" method="post">
                    <div>
                        <label for="nom">Nom</label>
                        <span>*Champ obligatoire</span>
                        <input type="text" name="nom" id="nom" placeholder="Entrer un nom" value="">
                    </div>
                    <div>
                        <label for="ville">Ville</label>
                        <span>*Champ obligatoire</span>
                        <input type="text" name="ville" id="ville" placeholder="Entrer une ville" value="">
                    </div>
                    <div>
                        <label for="code">Code postale</label>
                        <span>*Champ obligatoire</span>
                        <input type="text" name="code_postale" id="code" placeholder="Entrer un code postale" value="">
                    </div>
                    <div>
                        <label for="lat">Latitude</label>
                        <span>*Champ obligatoire</span>
                        <input type="number" name="gps_lat" id="lat" placeholder="Entrer une latitude" value="" step="any">
                    </div>
                    <div>
                        <label for="long">Longitude</label>
                        <span>*Champ obligatoire</span>
                        <input type="number" name="gps_long" id="long" placeholder="Entrer une longitude" value="" step="any">
                    </div>
                    <button class='validate button-validate-set' type="button">Valider l'ajout</button>
                </form>
            </div>
        </section>
        <section id='lieux-modify' class='hidden'>
            <div class="overlay">
                <i class="fas fa-close" onclick="close_modify()"></i>
                <h1>Modification d'un lieux:</h1>
                <?php foreach ($lieux as $key => $l) : ?>
                    <form action="" method="post">
                        <div class="container-modify">
                            <p><?php echo htmlspecialchars($l['nom']) . ' à ' . htmlspecialchars($l['ville']) . ' ' . htmlspecialchars($l['code_postale']); ?></p>
                            <p><?php echo 'Coordonnées lat: ' . htmlspecialchars($l['gps_lat']) . ' long: ' . htmlspecialchars($l['gps_long']); ?></p>
                            <div class="hidden input-container">
                                <div>
                                    <div>
                                        <label for="nom">Nom</label>
                                        <span>*Champ obligatoire</span>
                                    </div>
                                    <input type="text" name="nom" class="nom-modify" value="<?php echo htmlspecialchars($l['nom']); ?>" placeholder="Entrer un nom de lieux">
                                </div>
                                <div>
                                    <div>
                                    <label for="ville">Ville</label>
                                    <span>*Champ obligatoire</span>
                                    </div>
                                    <input type="text" name="ville" class="ville-modify" value="<?php echo htmlspecialchars($l['ville']); ?>" placeholder="Entrer un nom de ville">
                                </div>
                                <div>
                                    <div>
                                    <label for="code_postale">Code postale</label>
                                    <span>*Champ obligatoire</span>
                                    </div>
                                    <input type="text" name="code_postale" class="code-modify" value="<?php echo htmlspecialchars($l['code_postale']); ?>" placeholder="Entrer un code postale">
                                </div>
                                <div>
                                    <div>
                                    <label for="gps_lat">Latitude</label>
                                    <span>*Champ obligatoire</span>
                                    </div>
                                    <input type="number" name="gps_lat" class="lat-modify" value="<?php echo htmlspecialchars($l['gps_lat']); ?>" placeholder="Entrer une latitude" step="any">
                                </div>
                                <div>
                                    <div>
                                    <label for="gps_long">Longitude</label>
                                    <span>*Champ obligatoire</span>
                                    </div>
                                    <input type="number" name="gps_long" class="long-modify" value="<?php echo htmlspecialchars($l['gps_long']); ?>" placeholder="Entrer une longitude" step="any">
                                </div>
                                <input type="hidden" name="id_modify" class="id-modify" value="<?php echo htmlspecialchars($l['lieux_id']); ?>">
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
                    </form>
                <?php endforeach; ?>
            </div>
        </section>
    <?php
    endif;
    ?>


</main>

<?php include('../View/include/_message.html.php'); ?>

<?php
include('../View/include/_footer.html.php');
?>