<?php
    class ParametreGateway{
        private $con;
        
        public function __construct(Connexion $con){
            $this->con = $con;
        }

        public function nbNewsParPage(){
            try{
                $query="SELECT valeur FROM parametre WHERE nom='nbNewsParPage'";
                $this->con->executeQuery($query, array());
                $res=$this->con->getResults();
                return $res[0][0];
            }
            catch(PDOException $e){
                $this->myError($e);
            }
        }

        public function changerNbNewsParPage(int $nb){
            try{
                $query="UPDATE parametre SET valeur=:nb WHERE nom='nbNewsParPage'";
                $this->con->executeQuery($query, array( 'nb' => array($nb, PDO::PARAM_STR)));
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