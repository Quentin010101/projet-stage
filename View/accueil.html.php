<?php $pageTitle = 'Accueil' ?>
<?php $pageCss = 'accueil.css' ?>

<?php require_once('include/_header.html.php'); ?>

<main class="flex">
    <section>
        <h1>Actualités :</h1>
        <div class="article-wrapper">
            <?php
            if (isset($actualite) && !empty($actualite)) :
                foreach ($actualite as $a) :
            ?>
                    <article>
                        <div>
                            <h2><?php echo htmlspecialchars($a['titre']); ?></h2>
                            <h3><?php echo htmlspecialchars($a['sous_titre']); ?></h3>
                            <h4><?php $date = new DateTime($a['date_event']);
                                echo htmlspecialchars($date->format('d-m-Y')); ?></h4>
                        </div>
                        <hr>
                        <div class="content-container">
                            <figure>
                                <img src="<?php echo 'upload/' . htmlspecialchars($a['illustration']); ?>" alt="actualite-img">
                            </figure>
                            <p><?php echo htmlspecialchars($a['text']); ?></p>
                        </div>
                        <hr>
                        <div>
                            <h5>Actualité postée le: <span><?php $date = new DateTime($a['date_publication']);
                                echo htmlspecialchars($date->format('d-m-Y')); ?></span></h5>
                        </div>
                    </article>
                <?php
                endforeach;
            else :
                ?>
                <p>Aucune Actualités disponible.</p>
            <?php

            endif;
            ?>
        </div>
    </section>
    <aside>
        <h1>Evènements :</h1>
        <div class="evenement-wrapper">
            <?php
            if (isset($evenement) && !empty($evenement)) :
                foreach ($evenement as $e) :
            ?>
                    <article>
                        <div>
                            <h2><?php echo htmlspecialchars($e['titre']); ?></h2>
                            <h3><?php echo htmlspecialchars($e['sous_titre']); ?></h3>
                            <h4><?php $date = new DateTime($e['date_event']);
                                echo htmlspecialchars($date->format('d-m-Y')); ?></h4>
                        </div>
                        <hr>
                        <div  class="content-container">
                            <figure>
                                <img src="<?php echo 'upload/' . htmlspecialchars($e['illustration']); ?>" alt="actualite-img">
                            </figure>
                            <p>
                                <?php echo htmlspecialchars($e['text']); ?>
                            </p>
                        </div>
                        <hr>
                        <div>
                            <h5>Evènement postée le: <span><?php $date = new DateTime($e['date_publication']);
                                echo htmlspecialchars($date->format('d-m-Y')); ?></span></h5>
                        </div>
                    </article>
                <?php
                endforeach;
            else :
                ?>
                <p>Aucun Evènements disponible.</p>
            <?php

            endif;
            ?>
        </div>
    </aside>
</main>

<?php require_once('include/_footer.html.php'); ?>