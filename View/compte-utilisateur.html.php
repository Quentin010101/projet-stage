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
    <section id="update">
        <div class="wrapper">
            <h3>Mise à jour: <span><i class="fas fa-angle-down"></i></span></h3>
            <div class="menu">
                <form action="/utilisateur/update" method="post">
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
                    <div>
                        <input type="submit" class="validate">
                    </div>
                </form>
            </div>
        </div>
        </div>
    </section>
    <section id="contact" class="flex">
        <div class="wrapper">
            <h3>Formulaire de contact: <span><i class="fas fa-angle-down"></i></span></h3>
            <div class="menu">
                <form action="" method="post">
                    <div>
                        <label for="nom">Nom</label>
                        <input id="nom" type="text" placeholder="Entrez votre nom" value="<?php echo htmlspecialchars($utilisateur['nom']) ?>">
                    </div>
                    <div>
                        <label for="prenom">Prénom</label>
                        <input id="prenom" type="text" placeholder="Entrez votre prénom" value="<?php echo htmlspecialchars($utilisateur['prenom']) ?>">
                    </div>
                    <div>
                        <label for="email">Email</label>
                        <input id="email" type="email" placeholder="Entrez votre email" value="<?php echo htmlspecialchars($utilisateur['email']) ?>">
                    </div>
                    <div>
                        <label for="tel">Tel</label>
                        <input id="tel" type="text" placeholder="Entrez votre numéro de téléphone">
                    </div>
                    <div>
                        <label for="objet">Objet de la demande</label>
                        <input id="objet" type="text" placeholder="Entrez l'objet de votre demande">
                    </div>
                    <hr>
                    <div class="radio">
                        <p>Type de demande:</p>
                        <div>
                            <input type="radio" name="demande" id="renseignement" value="renseignement">
                            <label for="renseignement">Renseignement</label>
                            <input type="radio" name="demande" id="partenariat" value="partenariat">
                            <label for="partenariat">Partenariat</label>
                            <input type="radio" name="demande" id="inscription" value="inscription">
                            <label for="inscription">S'inscrire</label>
                            <input type="radio" name="demande" id="autre" value="autre">
                            <label for="autre">Autre</label>
                        </div>
                    </div>
                    <hr>
                    <div>
                        <label for="text">Message</label>
                        <textarea name="message" id="message" cols="30" rows="10" placeholder="Entrer votre message"></textarea>
                    </div>
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