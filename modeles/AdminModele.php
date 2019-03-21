<?php

class AdminModele{
    public static function deconnexion(){
        session_unset();
        session_destroy();
        $_SESSION = array();
    }

    public static function isAdmin(){
        if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){
            return true;
        }
        else
            return false;
    }

    public static function connection($identifiant, $password){
        global $base, $login, $mdp;

        $gw = new AdminGateway(new Connexion($base, $login, $mdp));
        $verif = $gw->checkAdmin($identifiant, $password);
        if($verif){
            $_SESSION['role'] = 'admin';
            $_SESSION['login'] = $identifiant;
            return new Admin($identifiant, $password);
        }
        else{
            return NULL;
        }
    }

    public function ajouterFlux(string $adresse){
        global $base, $login, $mdp;
        $gw = new FluxGateway(new Connexion($base, $login, $mdp));
        $gw->ajouterFlux($adresse);
    }

    public function afficherFlux(){
        global $base, $login, $mdp;
        $gw = new FluxGateway(new Connexion($base, $login, $mdp));
        return $gw->afficherFlux();
    }

    public function supprimerFlux(array $adresses){
        global $base, $login, $mdp;
        $gw = new FluxGateway(new Connexion($base, $login, $mdp));
        $gw->supprimerFlux($adresses);
    }
}

?>