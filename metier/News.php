<?php

    class News{
        private $titre;
        private $description;
        private $categorie;
        private $url;
        private $date;

        public function __construct(String $url, String $titre, String $description, String $categorie, String $date){
            $this->titre=$titre;
            $this->description=$description;
            $this->categorie=$categorie;
            $this->url=$url;
            $this->date=$date;
        }

        public function getTitre():String{
            return $this->titre;
        }

        public function setTitre(String $titre){
            $this->titre = $titre;
        }

        public function getDescription():String{
            return $this->description;
        }

        public function setDescription(String $description){
            $this->description = $description;
        }

        public function getCategorie():String{
            return $this->categorie;
        }

        public function setCategorie(String $categorie){
            $this->categorie = $categorie;
        }

        public function getUrl():String{
            return $this->url;
        }

        public function setUrl(String $url){
            $this->url = $url;
        }

        public function getDate():String{
            return $this->date;
        }

        public function setDate(String $date){
            $this->date = $date;
        }

    }

?>