<?php $pageTitle = 'Inscription' ?>
<?php $pageCss = 'login.css' ?>
<?php $pageScript[] = "inscription.js" ?>


<main>
    <div class="homePage">
        <a href="/home"><i class="fas fa-house"></i>Retour à la page d'accueil</a>
    </div>
    <div class="wrapper">
        <h1>S'inscrire</h1>

        <form id="form-inscription" action="/inscription/logupPost" method="post">
            <div>
                <label for="">Nom:</label>
                <span class="obligation" >* Champs obligatoire</span>
                <input class='input' type="text" name="nom" placeholder="Entrer votre Nom">
            </div>
            <div>
                <label for="">Prénom:</label>
                <span class="obligation" >* Champs obligatoire</span>
                <input class='input' type="text" name="prenom" placeholder="Entrer votre Prénom">
            </div>
            <div>
                <label for="">Email:</label>
                <span class="obligation" >* Champs obligatoire</span>
                <input class='input' type="email" name="email" placeholder="Entrer votre Email">
            </div>
            <div>
                <label for="">Mot de passe:</label>
                <span class="span-password" >* Doit contenir au moins:<br> <span id="span-check-num"  class='obligation-single'><span class='tiret'>-</span><i class="fas fa-check"></i> un numérique</span> <br> <span id="span-check-letter" class='obligation-single'><span class='tiret'>-</span><i class="fas fa-check"></i> une lettre</span> <br> <span id="span-check-carac" class='obligation-single'><span class='tiret'>-</span><i class="fas fa-check"></i> 6 caractères</span></span>
                <span class="obligation" >* Champs obligatoire</span>
                <input class='input' id="password" type="password" name="password" placeholder="Entrer votre Password">
            </div>
            <div>
                <label for="">Confirmation mot de passe:</label>
                <span class="confirmation">* Vos mots de passe ne sont pas identique</span>
                <span class="obligation" >* Champs obligatoire</span>
                <input class='input' id="passwordConfirmation" type="password" name="password-confirmation" placeholder="Entrer votre Password">
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
                <input id="form-submit" type="submit" value="Valider">
            </div>
        </form>
    </div>
</main>

<?php include('../View/include/_message.html.php'); ?>