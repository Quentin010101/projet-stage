<?php $pageTitle = 'Récupération mot de passe' ?>
<?php $pageCss = 'login.css' ?>

<main>
    <div class="wrapper">
        <h1>Réinitialiser votre mot de passe</h1>
        
        <form action="/verify/passwordRecoverPost" method="post">
            <div>
                <label for="">Email</label>
                <input type="password" name="password" placeholder="Entrer un nouveau password">
            </div>
            <div>
                <label for="">Email confirmation</label>
                <input type="password" name="password-confirmation" placeholder="Confirmer votre password">
            </div>
            <div>
                <input type="hidden" name="token" value="<?php echo htmlspecialchars($tokenPassword); ?>">
                <input type="hidden" name="user-id" value="<?php echo htmlspecialchars($utilisateur_id); ?>">
            </div>
            <div>
                <input type="submit" value="Envoyer">
            </div>
        </form>
    </div>
</main>

<?php include('../View/include/_message.html.php'); ?>