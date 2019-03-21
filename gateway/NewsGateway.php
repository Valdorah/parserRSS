<?php

    class NewsGateway{
        private $con;
        
        public function __construct(Connexion $con){
            $this->con = $con;
        }

        public function afficherLesNews(){
            try{
				
                $query='Select * From News';
                $this->con->executeQuery($query, array());
                $res=$this->con->getResults();
                foreach ($res as $line) {
                    $news[] = new News($line['url'], $line['titre'], $line['description'], $line['categorie'], $line['date'], $line['note']);
                }
                return $news;
            }
            catch(PDOException $e){
                $this->myError($e);
            }
        }

        public function AjouterNew(News $news){
            try{
                    if($news->getCategorie() == ''){
                        $news->setCategorie("Aucune catégorie");
                    }
					$query="INSERT INTO News(url, titre, description, date_pub, categorie) VALUES (:url,:titre,:description,FROM_UNIXTIME(:date),:categorie)";
                    $this->con->executeQuery($query, array( ':url' => array($news->getUrl(), PDO::PARAM_STR),
                        ':titre'=>array($news->getTitre(),PDO::PARAM_STR),
                        ':description'=>array($news->getDescription(),PDO::PARAM_STR),
                        ':date'=>array(strtotime($news->getDate()),PDO::PARAM_STR),
                        ':categorie'=>array($news->getCategorie(),PDO::PARAM_STR)));
            }
            catch(PDOException $e){
                $this->myError($e);
            }

        }
        public function afficherLesNewsParPage($debut, $nbNewsParPage){
            try{
                $query = "SELECT * FROM News ORDER BY date_pub DESC, titre LIMIT $debut, $nbNewsParPage";
                $this->con->executeQuery($query, array());
                $res=$this->con->getResults();
                $news = null;
                foreach ($res as $line) {
                    $news[] = new News($line['url'], $line['titre'], $line['description'], $line['categorie'], $line['date_pub']);
                }
                return $news;
            }
            catch(PDOException $e){
                $this->myError($e);
            }
        }

        public function nbNewsParPage(int $page, int $nbDeNewsParPage){
            return ($page - 1) * $nbDeNewsParPage;
        }
    
        public function compterLesNews(){
            try{
                $query='SELECT COUNT(*) FROM News';
                $this->con->executeQuery($query, array());
                $res=$this->con->getResults();
                foreach ($res as $line) {
                    $nombreDeNews = $line[0];
                }
                return $nombreDeNews;
            }
            catch(PDOException $e){
                $this->myError($e);
            }
        }
            
        pubLic function supprimerNews(String $url){
            try{
                $query="DELETE FROM `News` WHERE url=?";
                $this->con->executeQuery($query, array( '?' => array($url, PDO::PARAM_STR)));
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