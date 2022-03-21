<?php $pageTitle = 'Formulaire de contact'; ?>
<?php $pageCss = 'login.css'; ?>
<main>
<section id="contact" class="flex">
    <div class="homePage">
        <a href="/home"><i class="fas fa-house"></i>Retour à la page d'accueil</a>
    </div>
        <div class="wrapper">
            <h1>Formulaire de contact:</h1>
            <div class="menu">
                <form action="/contact/contactPost" method="post">
                    <div>
                        <label for="nom">Nom</label>
                        <input id="nom" type="text" name="nom" placeholder="Entrez votre nom" value="<?php if(isset($user) && !empty($user)): echo htmlspecialchars($user['nom']); endif;?>"  >
                    </div>
                    <div>
                        <label for="prenom">Prénom</label>
                        <input id="prenom" type="text" name="prenom" placeholder="Entrez votre prénom" value="<?php if(isset($user) && !empty($user)): echo htmlspecialchars($user['prenom']); endif;?>" >
                    </div>
                    <div>
                        <label for="email">Email</label>
                        <input id="email" type="email" name="email" placeholder="Entrez votre email" value="<?php if(isset($user) && !empty($user)): echo htmlspecialchars($user['email']); endif;?>" >
                    </div>
                    <div>
                        <label for="tel">Tel</label>
                        <input id="tel" type="text" name="tel" placeholder="Entrez votre numéro de téléphone">
                    </div>
                    <div>
                        <label for="objet">Objet de la demande</label>
                        <input id="objet" type="text" name="objet" placeholder="Entrez l'objet de votre demande">
                    </div>
                    <hr>
                    <div class="radio">
                        <p>Type de demande:</p>
                        <div>
                            <input type="radio" name="demande" id="renseignement" value="renseignement">
                            <label for="renseignement">Renseignement</label>
                            <input type="radio" name="demande" id="partenariat" value="partenariat">
                            <label for="partenariat">Partenariat</label>
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
