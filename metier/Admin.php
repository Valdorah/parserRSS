<?php

class Admin{
    private $identifiant;
    private $motDePasse;

    public function __construct(String $identifiant, String $motDePasse){
        $this->identifiant = $identifiant;
        $this->motDePasse = $motDePasse;
    }

    public function getIdentifiant(){
        return $this->identifiant;
    }

    public function setIdentifiant(String $identifiant){
        $this->identifiant = $identifiant;
    }
    
    public function getMotDePasse(){
        return $this->motDePasse;
    }

    public function setMotDePasse(String $motDePasse){
        $this->motDePasse = $motDePasse;
    }
}