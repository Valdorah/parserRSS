<?php
    class ValidationGateway{
        public static function urlExist(string $url):int{
            global $base, $login, $mdp;
            $con = new Connexion($base, $login, $mdp);
            $codeSQL = "SELECT COUNT(*) FROM news WHERE url=:url";
            $con->executeQuery('SELECT COUNT(*) FROM news WHERE url=:url', array('url' => array($url, PDO::PARAM_STR)));
            $resultat = $con->getResults();
            return $resultat[0][0];
        }

        public static function fluxExiste(string $adresse):bool{
            global $base, $login, $mdp;
            $con = new Connexion($base, $login, $mdp);
            $codeSQL = "SELECT COUNT(*) FROM flux WHERE adresse=:addr";
            $con->executeQuery($codeSQL, array('addr' => array($adresse, PDO::PARAM_STR)));
            $resultat = $con->getResults();
            return $resultat[0][0];
        }
    }
?>