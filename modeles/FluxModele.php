<?php

    class FluxModele{
        public function afficherFlux(){
            global $base, $login, $mdp;
            $gw = new FluxGateway(new Connexion($base, $login, $mdp));
            return $gw->afficherFlux();
        }

        public function nettoyerBase(){
            global $base, $login, $mdp;
            $gw = new FluxGateway(new Connexion($base, $login, $mdp));
            $gw->nettoyerBase();
        }
    }

?>