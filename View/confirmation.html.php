<?php $pageTitle = 'Confirmation'; ?>
<?php $pageCss = 'confirmation.css'; ?>

<main>  
    <div class="homePage">
        <a href="/home"><i class="fas fa-house"></i>Retour à la page d'accueil</a>
    </div>
    <div class="account-create">
        <?php
        if (isset($messages) && !empty($messages)) :
            if (isset($variable) && !empty($variable)) :
                if ($variable == 'password') :
        ?>
                    <h2>Récupération mot de passe</h2>
                    <?php
                    foreach ($messages as $m) :
                    ?>
                        <p>Un email vous à été envoyé à: <span><?php if ($m['code'] == 'confirmation') : echo htmlspecialchars($m['message']);
                                                                                endif; ?></span></p>
                        <p>Pensez à vérifier vos courriers indésirables</p>
                    <?php
                    endforeach;

                elseif ($variable == 'account') :
                    ?>
                    <h2>Inscription</h2>
                    <?php
                    foreach ($messages as $m) :
                    ?>
                        <p>Votre compte à bien été crée.</p>
                        <p>Un email de confirmation vous à été envoyé à: <span><?php if ($m['code'] == 'confirmation') : echo htmlspecialchars($m['message']);
                                                                                endif; ?></span></p>
                        <p>Pensez à vérifier vos courriers indésirables</p>
        <?php
                    endforeach;
                endif;
            endif;
        endif;
        ?>
    </div>
</main>