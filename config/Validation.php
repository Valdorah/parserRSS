<?php

    class Validation{

        public static function nettoyerString(string $chaine){
            if(!isset($chaine)) return false;
            $donnees = strip_tags($chaine);
            $donnees = trim($donnees);
            $donnees = stripslashes($donnees);
            return $donnees;
        }

        public static function valideURL(string $chaine){
            if(!isset($chaine)) return false;
            
            $chaine = filter_var($chaine, FILTER_SANITIZE_URL);
            if(filter_var($chaine, FILTER_VALIDATE_URL)){
                return $chaine;
            }
            
            return false;
        }

        public static function valideEmail(string $email):bool{
            if(!isset($email)) return false;

            return filter_var($email, FILTER_VALIDATE_EMAIL);
        }

        public static function urlExist(string $url):int{
            return ValidationModele::urlExist($url);
        }

        public static function fluxExiste(string $adresse):bool{
            return ValidationModele::fluxExiste($adresse);
        }

        public static function nbPage(int $nbTotalDeNews, int $nbDeNewsParPage){
            return ceil($nbTotalDeNews / $nbDeNewsParPage);
        }

        public static function pagination(int $nbDeNewsParPage, int $nbTotalDeNews){
            $page = (isset($_GET['page'])) ? abs(intval($_GET['page'])) : 1;
            $page = ($page == 0) ? 1 : $page;
            return $page;
        }

        public static function verifNombre(int $nb){
            $nb = filter_var($nb, FILTER_SANITIZE_NUMBER_INT);
            return filter_var($nb, FILTER_VALIDATE_INT);
        }
    }

?>