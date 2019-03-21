<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Quoi de "News" ?</title>
        <?php require(__DIR__."/../pages/head.php") ?>
    </head>
    <body>
        <div class="container-fluid">
            <header class="row">
                <h1 class="col-lg-8 offset-lg-2 text-white">Quoi de "News" ?</h1>
                <a href="index.php?action=pageAdmin" class="col-lg-2 btn btn-dark btn-lg " role="button" aria-pressed="true">Admin</a>
            </header>
            <article class="row">
                <ul class="list-goup col-lg-8 offset-lg-2">
                    <?php
                        if(!isset($listeNews)){
                            echo('<p class="alert bg-dark text-white">Pas de news à afficher.</p>');
                        }
                        else{
                            foreach ($listeNews as $value) {
                                echo('<li class="list-group-item bg-dark text-white">
                                <span class="titre font-weight-bold">'.$value->getTitre(). '</span><span class="badge badge-info titreBadge">' .$value->getCategorie().  '</span><br>'
                                        .$value->getDescription(). '<br>'
                                        .$value->getDate(). '<br>
                                        <a href="'.$value->getURL().'" class="col-lg-2 btn btn-secondary" role="button" aria-pressed="true">En savoir plus</a>
                                    </li>');
                            }
                        }
                    ?>
                </ul>
            </article>
            <footer class="row align-bottom">
                        <?php
                            if(isset($listeNews)){
                                ?>
                <nav class="mx-auto">
                    <ul class="pagination">
                                <?php
                                if($page > 1){
                                    $pagePrecedente = $page - 1;
                                    echo("<li class='page-item'><a class='page-link bg-dark text-white' href='index.php?page=$pagePrecedente'> << </a></li>");
                                }
                                echo("<li class='page-item'><a class='page-link bg-dark text-white'> $page </a></li>");
                                if($page < $nbPages){
                                    $pageSuivante = $page + 1;
                                    echo("<li class='page-item'><a class='page-link bg-dark text-white' href='index.php?page=$pageSuivante'> >> </a></li>");
                                }
                                ?>
                    </ul>
                </nav>
                                <?php
                            }
                            else{
                                echo('<a href="index.php?page=1" class="col-lg-2 offset-lg-5 btn btn-dark" role="button" aria-pressed="true">Retourner à l\'accueil</a>');
                            }
                        ?>
            </footer>
        </div>
    </body>
</html>