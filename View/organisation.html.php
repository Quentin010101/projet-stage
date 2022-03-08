<?php $pageTitle = 'Organisation' ?>
<?php $pageCss = 'organisation.css' ?>

<?php
include('../View/include/_header.html.php');
?>

<main>
    <section>
        <h2>L'histoire de l'association :</h2>
        <hr>
        <div class="inner-section">
            <div class="flex histoire">
                <figure>
                    <img src="asset/Etoile-Avenir.jpg" alt="photo association">
                </figure>
                <div>
                    <h3>L’Etoile de l’Avenir </h3>
                    <h4>Notre histoire</h4>
                    <div class="lien-histoire">
                        <a href="/histoire" target="_Blank" >En savoir plus ...</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <h2>Le bureau de l'association :</h2>
        <hr>
        <div class="inner-section">
            <div class="table">
                <div class='table-title'>
                    <h3>Nom</h3>
                    <h3>Prénom</h3>
                    <h3>Fonction</h3>
                </div>
                <?php
                if (isset($membres) && !empty($membres)) :
                    foreach ($membres as $m) :
                ?>
                        <div>
                            <h4><?php echo htmlspecialchars($m['nom']); ?></h4>
                            <h4><?php echo htmlspecialchars($m['prenom']); ?></h4>
                            <h4><?php echo htmlspecialchars($m['fonction']); ?></h4>
                        </div>
                <?php
                    endforeach;
                endif;
                ?>
            </div>
        </div>
    </section>
    <section>
        <h2>Informations générales :</h2>
        <hr>
        <div class="inner-section">
            <?php
            if (isset($organisation) && !empty($organisation)) :
            ?>
                <div class='information-general-container'>
                    <div>
                        <?php include('../View/include/_map.html.php'); ?>
                    </div>
                    <div>
                        <h3 class="adresse"><i class="fas fa-map-marked-alt"></i> Adresse: <address><?php echo htmlspecialchars($organisation['adresse']); ?></address></h3>
                        <h3 class="adresse"><i class="fas fa-envelope"></i> Tel: <address><?php echo htmlspecialchars($organisation['tel']); ?></address></h3>
                        <h3 class="adresse"><i class="fas fa-phone"></i> Email: <address><?php echo htmlspecialchars($organisation['email']); ?></address></h3>
                    </div>
                </div>
            <?php
            endif;
            ?>
        </div>
    </section>
    <section>
        <h2>Statuts de l'organisation:</h2>
        <hr>
        <div class="inner-section">
            <div>
                <a href="asset/status/status.docx" download><i class="fas fa-download"></i> Lien 1</a>
            </div>
        </div>
    </section>
</main>

<?php
include('../View/include/_footer.html.php');
?>