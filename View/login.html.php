<?php $pageTitle = 'Login' ?>
<?php $pageCss = 'login.css' ?>

<main>
    <div class="homePage">
        <a href="/home"><i class="fas fa-house"></i>Retour à la page d'accueil</a>
    </div>
    <div class="wrapper">
        <h1>Se connecter</h1>
        
        <form action="/login/loginPost" method="post">
            <div>
                <label for="">Email:</label>
                <input type="email" name="email" placeholder="Entrer votre Email">
            </div>
            <div>
                <label for="">Mot de passe:</label>
                <input type="password" name="password" placeholder="Entrer votre Password">
            </div>
            <div>
                <input type="submit" value="Valider">
            </div>
        </form>
        <div class="lien">
            <a href="/login/passwordForgotten">Vous avez oublié votre mot de passe?</a>
        </div>
    </div>
</main>

<?php include('../View/include/_message.html.php'); ?>



