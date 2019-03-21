<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Quoi de "News" ? - Connexion</title>
        <?php require(__DIR__."/../pages/head.php") ?>
    </head>
    <body>
        <div class="container-fluid">
            <header class="row">
                <h1 class="col-lg-8 offset-lg-2 text-white">Connexion Admin</h1>
                <a href="index.php" class="col-lg-2 btn btn-dark btn-lg" role="button" aria-pressed="true">Accueil</a>
            </header>
            <article class="row card col-lg-8 offset-lg-2 bg-dark text-white">
                <form method="post" action="index.php?action=connexion">
                    <div class="form-group">
                        <label>Identifiant</label>
                        <input type="text" name="identifiant" class="form-control bg-dark text-white" required>
                    </div>
                    <div class="form-group">
                        <label>Mot de passe</label>
                        <input type="password" name="mdp" class="form-control bg-dark text-white" required>
                    </div>
                    <input type="submit" class="btn btn-dark" value='Submit'>
                </form>
            </article>
        </div>
    </body>
</html>