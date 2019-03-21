<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Quoi de "News" ? - Erreurs</title>
        <?php require(__DIR__."/../pages/head.php") ?>
    </head>
    <body>
        <div class="container-fluid">
            <header class="row">
                <h1 class="col-lg-8 offset-lg-2 text-center text-white">Erreur(s) rencontrée(s)</h1>
                <a href="index.php" class="col-lg-2 btn btn-dark btn-lg" role="button" aria-pressed="true">Accueil</a>
            </header>
            <article class="row">
                <?php
                    foreach ($dVueEreur as $value) {
                        echo('<p class="alert alert-danger col-lg-8 offset-lg-2">' .$value. '</p>');
                    }
                ?>
            </article>
        </div>
    </body>
</html>