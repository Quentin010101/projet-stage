<?php $pageTitle = 'Espace Administrateur'; ?>
<?php $pageCss = 'account.css'; ?>
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
                <?php 
                    $label = 'Modifiez le logo';
                    include('../View/include/_input-file.html.php');
                ?>
                    <div>
                        <label for="">Nom de l'organisation</label>
                        <input type="text" name="nom" value="<?php if (isset($organisation) && !empty($organisation)) : echo htmlspecialchars($organisation['nom']);
                                                                endif; ?>" placeholder="Entrez un nom">
                    </div>
                    <div>
                        <label for="">Numero de téléphone de l'organisation</label>
                        <input type="text" name="tel" value="<?php if (isset($organisation) && !empty($organisation)) : echo htmlspecialchars($organisation['tel']);
                                                                endif; ?>" placeholder="Entrez un numéro de téléphone">
                    </div>
                    <div>
                        <label for="">Email de l'organisation</label>
                        <input type="email" name="email" value="<?php if (isset($organisation) && !empty($organisation)) : echo htmlspecialchars($organisation['email']);
                                                                endif; ?>" placeholder="Entrez un email">
                    </div>
                    <div>
                        <label for="">Adresse de l'organisation</label>
                        <input type="text" name="adresse" value="<?php if (isset($organisation) && !empty($organisation)) : echo htmlspecialchars($organisation['adresse']);
                                                                    endif; ?>" id="" placeholder="Entrez une adresse">
                    </div>
                    <div>
                        <h4>Nouvelles coordonnées GPS</h4>
                        <div>
                            <label for="">Latitude</label>
                            <input type="number" name="gps_lat" step="any" value="<?php if (isset($organisation) && !empty($organisation)) : echo htmlspecialchars($organisation['gps_lat']);
                                                                                    endif; ?>" placeholder="Entrez une latitude">
                        </div>
                        <div>
                            <label for="">Longitude</label>
                            <input type="number" name="gps_long" step="any" value="<?php if (isset($organisation) && !empty($organisation)) : echo htmlspecialchars($organisation['gps_long']);
                                                                                    endif; ?>" placeholder="Entrez une longitude">
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
                        <input type="text" name="nom" placeholder="Entrez un nom">
                    </div>
                    <div>
                        <label>Prénom</label>
                        <input type="text" name="prenom" placeholder="Entrez un prénom">
                    </div>
                    <div>
                        <label>Fonction</label>
                        <input type="text" name="fonction" placeholder="Entrez une fonction">
                    </div>
                    <div>
                        <input type="submit" value="Ajouter" class="validate">
                    </div>
                </form>
            </div>
        </div>
    </section>
    <section id="membre-adhesion">
        <div class="wrapper">
            <h3>Valider les demandes d'adhésions <span><i class="fas fa-angle-down"></i></span></h3>
            <div  class="menu">
                <?php 
                    if(isset($users) && !empty($users)):
                        foreach($users as $u):
                ?>
                <form action="/admin/adminAdhesion" method="post" class='formulaire-adhesion'>
                    <p><?php echo htmlspecialchars($u['nom']); ?></p>
                    <p><?php echo htmlspecialchars($u['prenom']); ?></p>
                    <p><span> date de naissance:</span> <?php $date= new DateTime(htmlspecialchars($u['date_naissance'])); echo $date->format('d-m-Y'); ?></p>
                    <input type="hidden" value="<?php echo htmlspecialchars($u['utilisateur_id'])?>" name="id">
                    <div>
                        <input type="submit" value="Valider l'adhésion" name="validate" class="validate">
                    </div>
                    <div>
                        <input type="submit" value="Refuser l'afhésion" name="invalidate" class="inValidate">
                    </div>
                </form>
                <?php
                    endforeach;
                else:
                        ?>
                            <p>Aucune demande d'adhésion en attente</p>
                        <?php
                endif;
                ?>
            </div>
        </div>
    </section>
</main>

<?php include('../View/include/_message.html.php'); ?>

<?php
include('../View/include/_footer.html.php');
?>