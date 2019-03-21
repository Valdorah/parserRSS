<?php

    class VisiteurModele{
        public function afficherLesNews(){
            global $base, $login, $mdp;
            $newsGateway = new NewsGateway(new Connexion($base, $login, $mdp));
            return $newsGateway->afficherLesNews();
        }

        public function afficherLesNewsParPage($debut, $nbNewsParPage){
            global $base, $login, $mdp;
            $newsGateway = new NewsGateway(new Connexion($base, $login, $mdp));
            return $newsGateway->afficherLesNewsParPage($debut, $nbNewsParPage);
        }

        public function nbNewsParPage(int $page, int $nbDeNewsParPage){
            global $base, $login, $mdp;
            $newsGateway = new NewsGateway(new Connexion($base, $login, $mdp));
            return $newsGateway->nbNewsParPage($page, $nbDeNewsParPage);
        }

        public function compterLesNews(){
            global $base, $login, $mdp;
            $newsGateway = new NewsGateway(new Connexion($base, $login, $mdp));
            return $newsGateway->compterLesNews();
        }
    }

?>