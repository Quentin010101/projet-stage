<?php $pageTitle = 'Récupération mot de passe' ?>
<?php $pageCss = 'login.css' ?>

<main>
    <div class="homePage">
        <a href="/home"><i class="fas fa-house"></i>Retour à la page d'accueil</a>
    </div>
    <div class="wrapper">
        <h1>Mot de passe oublié</h1>
        
        <form action="/login/passwordRecover" method="post">
            <div>
                <p class="message-recover">Un lien vous sera envoyé à cette adresse pour réinitialiser votre email</p>
            </div>
            <div>
                <label for="">Email</label>
                <input type="email" name="email" placeholder="Entrer votre Email">
            </div>
            <div>
                <input type="submit" value="Envoyer">
            </div>
        </form>
    </div>
</main>

<?php include('../View/include/_message.html.php'); ?>
