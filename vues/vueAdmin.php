<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Quoi de "News" ? - Admin</title>
        <?php require(__DIR__."/../pages/head.php") ?>

    </head>
    <body>
        <div class="container-fluid">
            <header class="row">
                <h1 class="col-lg-8 offset-lg-2 text-white">Gestion des flux</h1>
                <a href="index.php" class="col-lg-1 btn btn-dark btn-lg" role="button" aria-pressed="true">Accueil</a>
                <a href="index.php?action=deconnexion" class="col-lg-1 btn btn-danger btn-lg" role="button" aria-pressed="true">Déconnexion</a>
            </header>
                <article class="row">
                    <form class="bg-dark text-white col-lg-8 offset-lg-2 articleAdmin rounded" method="post" action="index.php?action=ajouter">
                        <div class="form-group">
                            <label>Lien du flux</label>
                            <input class="form-control bg-dark text-white" type="text" name="adresse" placeholder="ex : http://unlien.com" required>
                        </div>
                        <input type="submit" class="btn btn-secondary" value="Enregistrer"/>
                    </form>
                </article>

                <article class="row">
                    <form class="col-lg-8 offset-lg-2 bg-dark text-white articleAdmin rounded" method="post" action="index.php?action=supprimer">
                        <div class="form-group">
                            <ul class="list-group list-group-flush">
                                <?php
                                    if(empty($listeFlux)){
                                        echo('<p class="alert bg-dark text-white">Pas de flux à afficher.</p>');
                                    }
                                    $i = 1;
                                    foreach ($listeFlux as $value) {
                                        echo('
                                            <li class="list-group-item bg-dark text-white">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="0['.$value['adresse'].']" id="defaultCheck'.$i.'">
                                                    <label class="form-check-label" for="defaultCheck'.$i.'">
                                                    '.$value['adresse'].'
                                                    </label>
                                                </div>
                                            </li>'
                                        );
                                        $i++;
                                    }
                                ?>
                            </ul>
                        </div>
                        <?php
                            if(!empty($listeFlux)){
                                echo('<input type="submit" class="btn btn-secondary" value="Supprimer le(s) flux selectionné(s)"/>');
                            }
                        ?>
                    </form>
                </article>

                <article class="row">
                    <form class="col-lg-8 offset-lg-2 bg-dark text-white articleAdmin rounded" method="post" action="index.php?action=changerNbNewsParPage">
                        <label>Nombre de news par page</label>
                        <div class="form-group">
                            <input class="form-control bg-dark text-white" type="number" min="1" name="nbNews" required>
                        </div>
                        <input type="submit" class="btn btn-secondary" value="Changer"/>
                    </form>
                </article>
        </div>
    </body>
</html>