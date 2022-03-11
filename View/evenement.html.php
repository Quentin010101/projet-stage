<?php $pageTitle = 'Evènement'; ?>
<?php $pageCss = "publication.css"; ?>

<?php
include('../View/include/_header.html.php');
?>

<main>
    <section>
        <h2>Liste des évènements:</h2>
        <?php
        if (isset($evenement) && !empty($evenement)) :
            foreach ($evenement as $e) :
        ?>
                <div>
                    <article>
                        <div>
                            <h3><?php echo htmlspecialchars($e['titre']) ?></h3>
                            <h4><?php echo htmlspecialchars($e['sous_titre']) ?></h4>
                            <h5><span><?php echo htmlspecialchars($e['date_event']) ?></span></h5>
                        </div>
                        <div class='content'>
                            <figure>
                                <img src="<?php echo  'upload/' . htmlspecialchars($e['illustration']) ?>" alt="illustration">
                            </figure>
                            <p><?php echo htmlspecialchars($e['text']) ?></p>
                        </div>
                        <div class='publication'>
                            <h5>Article publié le: <span><?php $date = new DateTime(htmlspecialchars($e['date_publication']));
                                                            echo $date->format('d-m-Y'); ?></span> à <span><?php echo $date->format('H:i'); ?></span></h5>
                        </div>
                    </article>
                    <?php
                    if (isset($lieux) && !empty($lieux)) :
                        $arr = [];
                        foreach ($lieux as $l) :
                            if ($l['publication_id'] === $e['publication_id']) :
                                $arr[] = $l['lieux_id'];
                            endif;
                        endforeach;
                        if (count($arr) !== 0) :
                    ?>
                            <div class="map-container">
                                <?php include('../View/include/_map-evenement.html.php'); ?>
                                <div class="evenement-lieux">
                                    <?php if (isset($lieux) && !empty($lieux)) :
                                        foreach ($lieux as $l) :
                                            if ($l['publication_id'] == $e['publication_id']) :
                                    ?>
                                                <div>
                                                    <p>Le: <span><?php echo date_format(new DateTime(htmlspecialchars($l['date'])), 'd-m-Y'); ?></span> à: <span><?php echo date_format(new DateTime(htmlspecialchars($l['time'])), 'H:m'); ?></span></p>
                                                    <p><span><?php echo htmlspecialchars($l['nom']); ?></span> - <span><?php echo htmlspecialchars($l['ville']) . ' ' . htmlspecialchars($l['code_postale']); ?></span></p>
                                                </div>
                                    <?php
                                            endif;
                                        endforeach;
                                    endif;
                                    ?>
                                </div>
                            </div>

                    <?php
                        endif;
                    endif;
                    ?>

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