<?php $pageTitle = 'Carte Membre'; ?>
<?php $pageCss = 'carte-membre.css'; ?>

<main>

    <div class="title">
        <div class="logo">
            <img src="<?php echo '/logo/' . htmlspecialchars($organisation['logo']); ?>" alt="logo">
        </div>
        <div class='title-content'>
            <h1>Carte adhérent</h1>
            <h2><?php echo htmlspecialchars($organisation['nom'])?></h2>
        </div>
    </div>
    <div class="content">
        <div class="photo">
            <img src="<?php echo '/photo_identite/' . htmlspecialchars($adhesionData['photo_identite']); ?>" alt="photo_identite">
        </div>
        <div class="text">
            <p>Nom: <span><?php echo htmlspecialchars($utilisateur['nom']); ?></span></p>
            <p>Prénom: <span><?php echo htmlspecialchars($utilisateur['prenom']); ?></span></p>
            <p>Date de naissance: <span><?php $date = new DateTime(htmlspecialchars($adhesionData['date_naissance'])); echo $date->format('d-m-Y'); ?></span></p>
            <p>Adresse postale: <span><?php echo htmlspecialchars($adhesionData['adresse']); ?></span></p>
        </div>
    </div>
    <div class="info">
        <p>Tel: <span><?php echo htmlspecialchars($organisation['tel']); ?></span></p>
        <p>Email: <span><?php echo htmlspecialchars($organisation['email']); ?></span></p>
        <p>Adresse: <span><?php echo htmlspecialchars($organisation['adresse']); ?></span></p>
    </div>
</main>