<?php

    class Connexion extends PDO{
        private $stmt;

        public function __construct($serveur, $login, $motDePasse){
            parent::__construct("mysql:host=$serveur;dbname=news;charset=UTF8", $login, $motDePasse);
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        public function executeQuery($codeSQL, array $param = []){
            $this->stmt = parent::prepare($codeSQL);
            foreach ($param as $name => $value) {
                $this->stmt->bindValue($name, $value[0], $value[1]);
            }
            return $this->stmt->execute();
        }

        public function getResults(){
            return $this->stmt->fetchall();
        }
    }

?>