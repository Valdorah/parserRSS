<?php

    class FluxGateway{
        private $con;
        
        public function __construct(Connexion $con){
            $this->con = $con;
        }
        public function ajouterFlux(string $adresse){
            try{
                $query = "INSERT INTO flux(adresse) VALUES (:addr)";
                $this->con->executeQuery($query, array( 'addr' => array($adresse, PDO::PARAM_STR)));
            }
            catch(PDOException $e){
                $this->myError($e);
            }
        }

        public function afficherFlux(){
            try{
                $codeSQL = "SELECT * FROM flux";
                $this->con->executeQuery($codeSQL, array());
                $result = $this->con->getResults();
                return $result;
            }
            catch(PDOException $e){
                $this->myError($e);
            }
        }

        public function supprimerFlux($adresses){
            try{
                foreach ($adresses as $value) {
                    $codeSQL = "DELETE FROM flux WHERE adresse=:addr";
                    $this->con->executeQuery($codeSQL, array('addr' => array($value, PDO::PARAM_STR)));
                }
            }
            catch(PDOException $e){
                $this->myError($e);
            }
        }

        public function nettoyerBase(){
            try{
                $codeSQL = "DELETE FROM news WHERE date_pub < NOW() - INTERVAL 1 WEEK";
                $this->con->executeQuery($codeSQL, array());
            }
            catch(PDOException $e){
                $this->myError($e);
            }
        }

        private function myError(PDOException $e){
            global $rep,$vues;
            $dVueEreur[] =	$e->getMessage();
           throw new Exception("Erreur de base de donnée" .$e->getMessage());
        }
    }

?>