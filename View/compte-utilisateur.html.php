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
</main>

<?php include('../View/include/_message.html.php'); ?>

<?php
include('../View/include/_footer.html.php');
?>