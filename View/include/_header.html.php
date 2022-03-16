<?php $pageScript[] = "burger.js" ?>

<header class="flex">
    <div class="logo">
        <a href="/home">
            <img src="<?php if (isset($logo) && !empty($logo)) : echo 'logo/' . htmlspecialchars($logo['logo']);
                        endif; ?>" alt="logo">
        </a>
    </div>
    <nav>
        <ul class="flex">
            <li>
                <a href="/actualite">Actualités</a>
            </li>
            <li>
                <a href="/evenement">Evènements</a>
            </li>
            <li>
                <a href="/activite">Activités</a>
            </li>
            <li>
                <a href="/organisation">Organisation (Club)</a>
            </li>
        </ul>
    </nav>
    <div class="inscription">
        <?php if (!isset($_SESSION['user-type'])) :
        ?>
            <a href="/login">Login</a>
            <a href="/inscription">Inscription</a>
        <?php
        else :
        ?>
            <?php
            if (isset($_SESSION['user-type'])) :
                if ($_SESSION['user-type'] === 'admin') :
            ?>
                        <a class="lien-role" href="/admin"><i class="fas fa-user"></i><span> Espace Administrateur</span></a>
                <?php
                elseif ($_SESSION['user-type'] === 'redacteur-evenement') :
                ?>
                        <a class="lien-role" href="/publication"><i class="fas fa-pen"></i><span> Ecriture Evènements</span> </a>
                <?php
                elseif ($_SESSION['user-type'] === 'redacteur-actualite') :
                ?>
                        <a class="lien-role" href="/publication"><i class="fas fa-pen"></i><span> Ecriture Actualités</span> </a>
                <?php
                elseif ($_SESSION['user-type'] === 'user') :
                ?>
                        <a class="lien-role" href="/utilisateur"><i class="fas fa-user"></i><span> Espace Utilisateur</span> </a>
            <?php
                endif;
            endif;

            ?>
            <a href="/login/logout">Deconnexion <i class="fas fa-sign-out-alt"></i></a>
        <?php
        endif;
        ?>
        <div class="burger">
            <i class="fas fa-bars"></i>
        </div>
    </div>
</header>