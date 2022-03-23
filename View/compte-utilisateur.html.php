<?php $pageTitle = 'Espace Utilisateur'; ?>
<?php $pageCss = 'account.css'; ?>
<?php $pageScript[] = "menu-admin.js" ?>

<?php
include('../View/include/_header.html.php');
?>

<main>
    <section id="title" class="flex">
        <h1>Espace <span>Utilisateur</span></h1>
        <div>
            <h2>Bonjour <span><?php echo htmlspecialchars($_SESSION['firstname']); ?></span></h2>
            <div>
                <a href="/login/logout"> Deconnexion <i class="fas fa-sign-out-alt"></i></a>
            </div>
        </div>
    </section>
    <section id="adhesion-user">
        <?php if (isset($adhesionData)) :
            if ($adhesionData['adhesion'] === 'null') : ?>
                <div class="wrapper">
                    <h3>Demande d'adhésion: <span><i class="fas fa-angle-down"></i></span></h3>
                    <div class="menu">
                        <form action="/utilisateur/adhesion" method="post" enctype="multipart/form-data">
                            <div>
                                <label for="nom-adhesion">Nom</label>
                                <p><?php echo htmlspecialchars($utilisateur['nom']) ?></p>
                            </div>
                            <div>
                                <label for="prenom-adhesion">Prénom</label>
                                <p><?php echo htmlspecialchars($utilisateur['prenom']) ?></p>
                            </div>
                            <div>
                                <label for="email-adhesion">Email</label>
                                <p><?php echo htmlspecialchars($utilisateur['email']) ?></p>
                            </div>
                            <div>
                                <label for="age-adhesion">Date de naissance</label>
                                <input id="age-adhesion" type="date" name="age-adhesion">
                            </div>
                            <div>
                                <label for="adresse-adhesion">Adresse</label>
                                <input id="adresse-adhesion" type="text" name="adresse-adhesion" placeholder="Entrez votre adresse">
                            </div>
                            <?php $label = 'photo d\'identité'; ?>
                            <?php include('../View/include/_input-file.html.php'); ?>
                            <div>
                                <input type="submit" class="validate">
                            </div>
                        </form>
                    </div>
                </div>
            <?php elseif ($adhesionData['adhesion'] === 'demande') : ?>
                <div class="adhesion-div">
                    <h3>Votre demande d'adhesion est en cour de traitement.</h3>
                </div>
            <?php elseif ($adhesionData['adhesion'] === 'refuser') : ?>
                <div class="adhesion-div">
                    <h3>Votre demande d'adhesion à été refusé.</h3>
                </div>
            <?php elseif ($adhesionData['adhesion'] === 'accepter') : ?>
                <div class="adhesion-div">
                    <h3>Votre carte de membre:</h3>
                    <img src="<?php echo "https://api.qrserver.com/v1/create-qr-code/?data=https%3A%2F%2Fcozic.alwaysdata.net%2Futilisateur%2Fcarte_membre%2F" . htmlspecialchars($utilisateur['utilisateur_id']) . "&amp;size=100x100"; ?>" alt="QR-code">
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </section>

    <section id="update">
        <div class="wrapper">
            <h3>Mise à jour de vos données personnelles: <span><i class="fas fa-angle-down"></i></span></h3>
            <div class="menu">
                <form action="/utilisateur/update" method="post" enctype="multipart/form-data">
                    <div>
                        <label for="nom-update">Nom</label>
                        <input id="nom-update" type="text" name="nom-update" placeholder="Entrez votre nom" value="<?php echo htmlspecialchars($utilisateur['nom']) ?>">
                    </div>
                    <div>
                        <label for="prenom-update">Prénom</label>
                        <input id="prenom-update" type="text" name="prenom-update" placeholder="Entrez votre prénom" value="<?php echo htmlspecialchars($utilisateur['prenom']) ?>">
                    </div>
                    <div>
                        <label for="email-update">Email</label>
                        <input id="email-update" type="email" name="email-update" placeholder="Entrez votre email" value="<?php echo htmlspecialchars($utilisateur['email']) ?>">
                    </div>
                    <?php if (isset($adhesionData) && !empty($adhesionData)) :
                        if ($adhesionData['adhesion'] !== 'null') :
                    ?>
                            <div>
                                <label for="age-update">Date de naissance</label>
                                <input id="age-update" type="date" name="age-update" value="<?php echo htmlspecialchars($adhesionData['date_naissance']) ?>">
                            </div>
                            <div>
                                <label for="adresse-update">Adresse</label>
                                <input id="adresse-update" type="text" name="adresse-update" placeholder="Entrez votre adresse" value="<?php echo htmlspecialchars($adhesionData['adresse']) ?>">
                            </div>
                            <div class="container_identite">
                                <div class="photo_identite">
                                    <img src="<?php echo 'photo_identite/' . htmlspecialchars($adhesionData['photo_identite']); ?>" alt="photo identité">
                                </div>
                                <?php $label = 'photo d\'identité'; ?>
                                <?php include('../View/include/_input-file.html.php'); ?>
                            </div>
                    <?php endif;
                    endif;
                    ?>
                    <div>
                        <input type="submit" class="validate">
                    </div>
                </form>
            </div>
        </div>
    </section>

</main>

<?php include('../View/include/_message.html.php'); ?>

<?php
include('../View/include/_footer.html.php');
?>