<?php

class AdminGateway{
    private $con;

    public function __construct(Connexion $con){
        $this->con = $con;
    }

    public function IdMdpCheck(String $id,String $mdp){
        try {
            $query="Select Count(*) where Identifiant=:id AND Mdp =:mdp ";
            $this->con->executeQuery($query, array( 'id' => array($id, PDO::PARAM_STR),
                'mdp'=>array($mdp,PDO::PARAM_STR)));
            $res=$this->con->getResults();
            return $res;
            if($res != 1)
                return true;
            return false;
        }
        catch (PDOException $e) {
            $this->myError($e);
        }
    }

    public function AdminCheck(Admin $ad){
        try{
            $query="Select Count(*) where Identifiant=:id AND Mdp =:mdp ";
            $this->con->executeQuery($query, array( ':id' => array($ad->getIdentifiant(), PDO::PARAM_STR),
                ':mdp'=>array($ad->getMdp(),PDO::PARAM_STR)));
            $res=$this->con->getResults();
            if($res != 1)
                return true;
            return false;
        }
        catch (PDOException $e) {
            $this->myError($e);
        }
    }

    public function checkAdmin(String $identifiant, String $password){
        try{
            $query="SELECT * FROM Tadmin WHERE identifiant=:id";
            $this->con->executeQuery($query, array( ':id' => array($identifiant, PDO::PARAM_STR)));
            $res=$this->con->getResults();
            
            if(!empty($res)){
                if(isset($res) && password_verify($password, $res[0]['motDePasse'])){
                    return true;
                }
                else{
                    return false;
                }
            }
            else{
                return false;
            }
        }
        catch (PDOException $e) {
            $this->myError($e);
        }
    }

    private function myError(PDOException $e){
        global $rep,$vues;
        $dVueEreur[] =	$e->getMessage();
        throw new Exception("Erreur de base de donnée");
    }
}

?>