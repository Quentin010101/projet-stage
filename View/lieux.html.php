<?php $pageTitle = 'Lieux' ?>
<?php $pageCss = 'lieux.css' ?>

<section id='lieux-modify'>
    <h1>Mise à jour des différents lieux:</h1>
    <div class="form-wrapper">
        <?php foreach ($locations as $lieux) : ?>
            <form action="index.php?page=lieux&method=modify&id=<?php echo htmlspecialchars($lieux['lieux_id']); ?>" method="post">
                <div>
                    <label for="nom">Nom</label>
                    <input type="text" name="nom" id="nom" value="<?php echo htmlspecialchars($lieux['nom']); ?>" placeholder="Entrer un nom de lieux">
                </div>
                <div>
                    <label for="ville">Ville</label>
                    <input type="text" name="ville" id="ville" value="<?php echo htmlspecialchars($lieux['ville']); ?>" placeholder="Entrer un nom de ville">
                </div>
                <div>
                    <label for="code_postale">Code postale</label>
                    <input type="text" name="code_postale" id="code_postale" value="<?php echo htmlspecialchars($lieux['code_postale']); ?>" placeholder="Entrer un code postale">
                </div>
                <div>
                    <label for="gps_lat">Latitude</label>
                    <input type="number" name="gps_lat" id="gps_lat" value="<?php echo htmlspecialchars($lieux['gps_lat']); ?>" placeholder="Entrer une latitude" step="any">
                </div>
                <div>
                    <label for="gps_long">Longitude</label>
                    <input type="number" name="gps_long" id="gps_long" value="<?php echo htmlspecialchars($lieux['gps_long']); ?>" placeholder="Entrer une longitude" step="any">
                </div>
                <div>
                    <input type="submit" value="Modifier" class="valid" name="modify">
                    <input type="submit" value="Supprimer" class="inValid" name="delete">
                </div>
            </form>
        <?php endforeach; ?>
    </div>
    <div class="error">
        <?php
        if (isset($message_update) && !empty($message_update)) :
            foreach ($message_update as $m) :
        ?>
                <p><?php echo htmlspecialchars($m); ?></p>
        <?php
            endforeach;
        endif;
        ?>
    </div>
</section>
<section id='lieux-set'>
    <h1>Ajout d'un lieux:</h1>
    <form id='form-set' action="index.php?page=lieux&method=set" method="post">
        <div>
            <label for="nom">Nom</label>
            <input type="text" name="nom" id="nom" placeholder="Entrer un nom">
        </div>
        <div>
            <label for="ville">Ville</label>
            <input type="text" name="ville" id="ville" placeholder="Entrer une ville">
        </div>
        <div>
            <label for="code">Code postale</label>
            <input type="text" name="code_postale" id="code" placeholder="Entrer un code postale">
        </div>
        <div>
            <label for="lat">Latitude</label>
            <input type="number" name="gps_lat" id="lat" placeholder="Entrer une latitude" step="any">
        </div>
        <div>
            <label for="long">Longitude</label>
            <input type="number" name="gps_long" id="long" placeholder="Entrer une longitude" step="any">
        </div>
        <div class="error">
            <?php
            if (isset($message_set) && !empty($message_set)) :
                foreach ($message_set as $m) :
            ?>
                    <p><?php echo htmlspecialchars($m); ?></p>
            <?php
                endforeach;
            endif;
            ?>
        </div>
        <div>
            <input type="submit" value="Ajouter" class="valid" name="set">
        </div>
    </form>
</section>