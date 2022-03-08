<?php $pageTitle = 'Confirmation'; ?>
<?php $pageCss = 'confirmation.css'; ?>

<main>
    <div>
        <?php
        if (isset($messages) && !empty($messages)) :
        ?>
            <h2>Inscription</h2>
            <?php
            foreach ($messages as $m) :
            ?>
                <p>Votre compte à bien été crée.</p>
                <p>Un email de confirmation vous à été envoyé à: <span><?php if ($m['code'] == 'confirmation') : echo htmlspecialchars($m['message']);
                    endif; ?></span></p>
        <?php
            endforeach;
        endif;
        ?>
    </div>
</main>