<?php $pageTitle = 'Evènement'; ?>
<?php $pageCss = "publication.css"; ?>

<?php
include('../View/include/_header.html.php');
?>

<main>
    <section>
        <h2>Liste des évènement:</h2>
        <?php 
            if(isset($evenement) && !empty($evenement)):
                foreach ($evenement as $e) :       
        ?>
        <div>
            <article>
                <div>
                    <h3><?php echo htmlspecialchars($e['titre'])?></h3>
                    <h4><?php echo htmlspecialchars($e['sous_titre'])?></h4>
                    <h5><span><?php echo htmlspecialchars($e['date_event'])?></span></h5>
                </div>
                <div class='content'>
                    <figure>
                        <img src="<?php echo  'upload/' . htmlspecialchars($e['illustration'])?>" alt="illustration">
                    </figure>
                    <p><?php echo htmlspecialchars($e['text'])?></p>
                </div>
                <div class='publication'>
                    <h5>Article publié le: <span><?php echo htmlspecialchars($e['date_publication'])?></span></h5>
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