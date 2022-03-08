<?php $pageTitle = 'Inscription' ?>
<?php $pageCss = 'login.css' ?>

<main>
    <div class="homePage">
        <a href="/home"><i class="fas fa-house"></i>Retour à la page d'accueil</a>
    </div>
    <div class="wrapper">
        <h1>S'inscrire</h1>

        <form action="/inscription/logupPost" method="post">
            <div>
                <label for="">Nom:</label>
                <input type="text" name="nom" placeholder="Entrer votre Nom">
            </div>
            <div>
                <label for="">Prénom:</label>
                <input type="text" name="prenom" placeholder="Entrer votre Prénom">
            </div>
            <div>
                <label for="">Email:</label>
                <input type="email" name="email" placeholder="Entrer votre Email">
            </div>
            <div>
                <label for="">Mot de passe:</label>
                <input type="password" name="password" placeholder="Entrer votre Password">
            </div>
            <div>
                <label for="">Confirmation mot de passe:</label>
                <input type="password" name="password-confirmation" placeholder="Entrer votre Password">
            </div>
            <div class="message-error">
                <?php if (isset($messages) && !empty($messages)) :
                    foreach ($messages as $m) :
                        if ($m['code'] == 'validate') :
                ?>
                            <div id="wrong">
                                <p><?php echo $m['message']; ?></p>
                            </div>
                <?php
                        endif;
                    endforeach;
                endif;
                ?>
            </div>
            <div>
                <input type="submit" value="Valider">
            </div>
        </form>
    </div>
</main>

<?php include('../View/include/_message.html.php'); ?>