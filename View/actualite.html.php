<?php $pageTitle = 'Actualité'; ?>
<?php $pageCss = "publication.css"; ?>

<?php
include('../View/include/_header.html.php');
?>

<main>
    <section>
        <h2>Liste des actualitées:</h2>
        <?php 
            if(isset($actualite) && !empty($actualite)):
                foreach ($actualite as $a) :       
        ?>
        <div>
            <article>
                <div>
                    <h3><?php echo htmlspecialchars($a['titre'])?></h3>
                    <h4><?php echo htmlspecialchars($a['sous_titre'])?></h4>
                    <h5><span><?php echo htmlspecialchars($a['date_event'])?></span></h5>
                </div>
                <div class='content'>
                    <figure>
                        <img src="<?php echo  'upload/' . htmlspecialchars($a['illustration'])?>" alt="illustration">
                    </figure>
                    <p><?php echo htmlspecialchars($a['text'])?></p>
                </div>
                <div class='publication'>
                    <h5>Article publié le: <span><?php echo htmlspecialchars($a['date_publication'])?></span></h5>
                </div>
            </article>
        </div>
        <?php
                endforeach;
            endif;
        ?>
    </section>
</main>
<?php
include('../View/include/_footer.html.php');
?>