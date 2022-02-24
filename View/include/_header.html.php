<?php $pageScript[] ="burger.js" ?>

<header class="flex">
    <div class="logo">
        <a href="/home">
            <img src="<?php if(isset($logo) && !empty($logo)): echo 'logo/' . htmlspecialchars($logo['logo']); endif;?>" alt="logo">
        </a>
    </div>
    <nav >
        <ul class="flex">
            <li>
                <a href="/actualite">Actualités</a>
            </li>
            <li>
                <a href="/evenement">Evènement</a>
            </li>
            <li>
                <a href="#">Activités</a>
            </li>
            <li>
                <a href="#">Organisation (Club)</a>
            </li>
            <?php
            if (isset($_SESSION['user-type'])) :
                if ($_SESSION['user-type'] === 'admin') :
            ?>
                    <li>
                        <a href="/admin">Espace Administrateur</a>
                    </li>
                <?php
                elseif ($_SESSION['user-type'] === 'redacteur-evenement') :
                ?>
                    <li>
                        <a href="/publication"><i class="fas fa-pen"></i> Ecriture Evènement</a>
                    </li>
                <?php
                elseif ($_SESSION['user-type'] === 'redacteur-actualite') :
                ?>
                    <li>
                        <a href="/publication"><i class="fas fa-pen"></i> Ecriture Actualités</a>
                    </li>
            <?php
                endif;
            endif;

            ?>
        </ul>
    </nav>
    <div class="inscription">
        <a href="#">Inscription</a>
        <div class="burger">
            <i class="fas fa-bars"></i>
        </div>
    </div>
</header>