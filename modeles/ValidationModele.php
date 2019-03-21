<?php
    class ValidationModele{
        public static function urlExist(string $url):int{
            return ValidationGateway::urlExist($url);
        }

        public static function fluxExiste(string $adresse):bool{
            return ValidationGateway::fluxExiste($adresse);
        }
    }
?>