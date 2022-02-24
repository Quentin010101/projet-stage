<?php $pageTitle = 'Espace Administrateur'; ?>
<?php $pageCss = 'admin.css'; ?>
<?php $pageScript[] ="menu-admin.js" ?>


<?php
include('../View/include/_header.html.php');
?>

<main>
    <section id="title" class="flex">
        <h1>Espace <span>Administrateur</span></h1>
        <div>
            <h2>Bonjour <span><?php echo htmlspecialchars($_SESSION['firstname']); ?></span></h2>
            <div>
                <a href="/login/logout"> Deconnexion <i class="fas fa-sign-out-alt"></i></a>
            </div>
        </div>
    </section>
    <section id="organisation">
        <div class="wrapper">
            <h3>Mise à jour Club: <span><i class="fas fa-angle-down"></i></span></h3>
            <div class="menu">
                <form action="/admin/adminPostClub" method="post" enctype="multipart/form-data">
                    <div class="container-file">
                        <label for="file" id="file-label">Modifier le logo</label>
                        <input type="file" name="file" id="file">
                    </div>
                    <div>
                        <label for="">Nom de l'organisation</label>
                        <input type="text" name="nom" value="<?php if (isset($organisation) && !empty($organisation)) : echo htmlspecialchars($organisation['nom']);
                                                                endif; ?>" placeholder="Entrer un nom">
                    </div>
                    <div>
                        <label for="">Numero de téléphone de l'organisation</label>
                        <input type="text" name="tel" value="<?php if (isset($organisation) && !empty($organisation)) : echo htmlspecialchars($organisation['tel']);
                                                                endif; ?>" placeholder="Entrer un numéro de téléphone">
                    </div>
                    <div>
                        <label for="">Email de l'organisation</label>
                        <input type="email" name="email" value="<?php if (isset($organisation) && !empty($organisation)) : echo htmlspecialchars($organisation['email']);
                                                                endif; ?>" placeholder="Entrer un email">
                    </div>
                    <div>
                        <label for="">Adresse de l'organisation</label>
                        <input type="text" name="adresse" value="<?php if (isset($organisation) && !empty($organisation)) : echo htmlspecialchars($organisation['adresse']);
                                                                    endif; ?>" id="" placeholder="Entrer une adresse">
                    </div>
                    <div>
                        <h4>Nouvelles coordonnées GPS</h4>
                        <div>
                            <label for="">Latitude</label>
                            <input type="number" name="gps_lat" step="any" value="<?php if (isset($organisation) && !empty($organisation)) : echo htmlspecialchars($organisation['gps_lat']);
                                                                                    endif; ?>" placeholder="Entrer une latitude">
                        </div>
                        <div>
                            <label for="">Longitude</label>
                            <input type="number" name="gps_long" step="any" value="<?php if (isset($organisation) && !empty($organisation)) : echo htmlspecialchars($organisation['gps_long']);
                                                                                    endif; ?>" placeholder="Entrer une longitude">
                        </div>
                    </div>
                    <div>
                        <input type="submit" value="Mettre à jour" class="validate">
                    </div>
                </form>
            </div>
        </div>
    </section>
    <section id="membre-modify">
        <div class="wrapper">
            <h3>Mise à jour membres du bureau: <span><i class="fas fa-angle-down"></i></span></h3>
            <div  class="menu">
                <div class="tableau">
                    <h4>Nom</h4>
                    <h4>Prénom</h4>
                    <h4>Fonction</h4>
                </div>
                <?php
                if (isset($membres) && !empty($membres)) :
                    foreach ($membres as $membre) :
                ?>
                        <div>
                            <form action="<?php echo '/admin/adminPostMembre/' . htmlspecialchars($membre['membre_id']); ?>" method="post">
                                <input type="text" value="<?php echo htmlspecialchars($membre['nom']); ?>" name="nom">
                                <input type="text" value="<?php echo htmlspecialchars($membre['prenom']); ?>" name="prenom">
                                <input type="text" value="<?php echo htmlspecialchars($membre['fonction']); ?>" name="fonction">
                                <div>
                                    <input type="submit" value="Modifier" name="modify" class="validate">
                                    <input type="submit" value="Supprimer" name="delete" class="inValidate">
                                </div>
                            </form>
                        </div>
                <?php
                    endforeach;
                endif;
                ?>
            </div>
        </div>
    </section>
    <section id="membre-set">
        <div class="wrapper">
            <h3>Ajout d'un membre du bureau: <span><i class="fas fa-angle-down"></i></span></h3>
            <div  class="menu">
                <form action="/admin/adminSetMembre" method="post">
                    <div>
                        <label>Nom</label>
                        <input type="text" name="nom" placeholder="Entrer un nom">
                    </div>
                    <div>
                        <label>Prénom</label>
                        <input type="text" name="prenom" placeholder="Entrer un prénom">
                    </div>
                    <div>
                        <label>Fonction</label>
                        <input type="text" name="fonction" placeholder="Entrer une fonction">
                    </div>
                    <div>
                        <input type="submit" value="Ajouter" class="validate">
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>

<?php
include('../View/include/_footer.html.php');
?>