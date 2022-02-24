<?php $pageTitle = 'Redaction' ?>
<?php $pageCss = 'redaction.css' ?>


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
                        <input type="text" id="titre" name="titre" placeholder="Entrer un titre">
                    </div>
                    <div>
                        <label for="sous-titre">Sous-titre</label>
                        <input type="text" id="sous-titre" name="sous-titre" placeholder="Entrer un sous-titre">
                    </div>
                    <div>
                        <label for="date">Date de l'actualité</label>
                        <input type="date" id="sous-titre" name="date-event">
                    </div>
                </div>
                <div>
                    <label for="text">Contenue</label>
                    <textarea name="text" id="text" cols="30" rows="10" placeholder="Entrer votre text"></textarea>
                </div>
                <div class="container-file">
                    <label for="file" id="file-label">Ajouter une illustration</label>
                    <input type="file" name="file" id="file">
                </div>
                <?php
                if($_SESSION['user-type'] == 'redacteur-evenement'):
                ?>
                <div>
                    <label for="lieux">Selectionner un lieux</label>
                    <select name="lieux" id="lieux">
                        <?php
                            if(isset($lieux) && !empty($lieux)):
                                    ?>
                                        <option value="">--Selectionner un lieux</option>
                                    <?php
                                foreach ($lieux as $key => $l) :
                                    ?>
                                        <option value="<?php echo htmlspecialchars($l['lieux_id']); ?>"><?php echo htmlspecialchars($l['ville']) . ' - ' . htmlspecialchars($l['nom']);?></option>
                                    <?php
                                endforeach;
                            else:
                                ?>
                                    <option value="">Aucun lieux disponible</option>
                                <?php                                        
                            endif;
                        ?>
                    </select>
                    <a href="/lieux">Vous voulez ajouter un lieux ?</a>
                </div>
                <?php 
                endif;
                ?>
                <?php
                if (isset($message) && !empty($message)) :
                    foreach ($message as $m) :
                ?>
                        <div class="error">
                            <p><?php echo htmlspecialchars($m); ?></p>
                        </div>
                <?php
                    endforeach;
                endif;
                ?>
                <div>
                    <input type="submit" value="Envoyer" name="<?php echo htmlspecialchars($type) . 'submit'; ?>">
                </div>
            </form>
        </div>
    </section>
</main>

<?php 
    include('../View/include/_footer.html.php');
?>