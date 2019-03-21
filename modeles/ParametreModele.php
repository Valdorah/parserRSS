<?php

    class ParametreModele{
        public function nbNewsParPage(){
            global $base, $login, $mdp;
            $gw = new ParametreGateway(new Connexion($base, $login, $mdp));
            return $gw->nbNewsParPage();
        }

        public function changerNbNewsParPage(int $nbNews){
            global $base, $login, $mdp;
            $gw = new ParametreGateway(new Connexion($base, $login, $mdp));
            $gw->changerNbNewsParPage($nbNews);
        }
    }

?>