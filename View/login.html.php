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
            <?php
                if(isset($message) && !empty($message)):
                    ?>
                        <div class="error">
                            <p><?php echo htmlspecialchars($message); ?></p>
                        </div>
                    <?php
                endif;
            ?>
            <div>
                <input type="submit" value="Valider">
            </div>
        </form>
    </div>
</main>


