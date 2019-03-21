<?php

class XmlParser {
    private $path;
    private $result;
    private $depth;
    private $n;
    private $bitem;
    private $btitre;
    private $bdescription;
    private $burl;
    private $bcategorie;
    private $bdate;

    public function __construct($path)
    {
        $this -> path = $path;
        $this -> depth = 0;
    }
     
    public function getResult() {
        return $this->result;
    }

    public function parse()
    {
        ob_start();
        $xml_parser = xml_parser_create();
        xml_set_object($xml_parser, $this);
        xml_set_element_handler($xml_parser, "startElement", "endElement");
        xml_set_character_data_handler($xml_parser, 'characterData');
        if (!($fp = fopen($this -> path, "r"))) {
            die('<div class="container-fluid"><div class="row"><p class="alert alert-danger col-lg-3 offset-lg-2">could not open XML input. Please, <a href="mailto:alexis.goncalves@etu.uca.fr">contact</a> the administrators.</p></div></div>');
        }
 
        while ($data = fread($fp, 4096)) {
            if (!xml_parse($xml_parser, $data, feof($fp))) {
                die(sprintf("XML error: %s at line %d",
                            xml_error_string(xml_get_error_code($xml_parser)),
                            xml_get_current_line_number($xml_parser)));
            }
        }
         
        $this -> result = ob_get_contents();
        ob_end_clean();
        fclose($fp);
        xml_parser_free($xml_parser);
    }


    private function startElement($parser, $name, $attrs)
    {   
        $name = strtolower($name);
        // echo($name);
        // echo("<br />");
        if($name=="item"){
            // echo("<br /><strong>Début item :</strong> <br />");
            $this->bitem = True;
            $this->n=new News("","","","","",0);
        }
        if($this->bitem){
            if($name=="title"){
                // echo("<strong>Début title :</strong> <br />");
                $this->btitre=True;
            }
            if($name=="description"){
                // echo("<strong>Début description :</strong> <br />");
                $this->bdescription=True;
            }
            if($name=="link"){
                // echo("<strong>Début link :</strong> <br />");
                $this->burl=True;
            }
            if($name=="pubdate"){
                // echo("<strong>Début pubDate :</strong> <br />");
                $this->bdate=True;
            }
            if($name == "category"){
                // echo("<strong>Début category :</strong> <br />");
                $this->bcategorie=True;
            }
        }

    }
     
    private function displayAttribute($attribute, $text)
    {
        for ($i = 0; $i < $this -> depth; $i++) {
            echo "  ";
        }
         
        echo "A - $attribute = $text\n";
    }
 
    private function endElement($parser, $name)
    {
        global $base, $login, $mdp;

        $name = strtolower($name);
        if($name=="item"){
            // echo("<strong>Fin item :</strong> <br />");
			if(Validation::urlExist($this->n->getUrl()) == 0){
                $newsGateway = new NewsGateway(new Connexion($base, $login, $mdp));
                $newsGateway->AjouterNew($this->n); // Décommenter cette ligne pour insérer en base de donnée.
            }
			$this->bitem = False;
        }
        if($this->bitem){
            if($name=="title"){
                // echo("<br /><strong>Fin title :</strong> <br />");
                $this->btitre=False;
            }
            if($name=="description"){
                // echo("<br /><strong>Fin description :</strong> <br />");
                $this->bdescription=False;
            }
            if($name=="link"){
                // echo("<br /><strong>Fin link :</strong> <br />");
                $this->burl=False;
            }
            if($name=="pubdate"){
                // echo("<br /><strong>Fin pubDate :</strong> <br />");
                $this->bdate=False;
            }
            if($name == "category"){
                // echo("<br /><strong>Fin category :</strong> <br />");
                $this->bcategorie=False;
            }
        }
    }
     
    private function characterData($parser, $data)
    {
        if($this->btitre){
            // echo($data);
            $debut = $this->n->getTitre();
            $this->n->setTitre($debut. "" .$data);
            // // echo("Après : " .$data. "<br/>");
        }
        if($this->bdescription){
            // echo($data);
            $debut = $this->n->getDescription();
            $this->n->setDescription(Validation::nettoyerString($debut. "" .$data));
        }
        if($this->bdate){
            // echo($data);
            $this->n->setDate($data);
        }
        if($this->burl){
            // echo($data);
            $this->n->setUrl($data);
        }
        if($this->bcategorie){
            $debut = $this->n->getCategorie();
            $this->n->setCategorie($debut. "" .$data);
        }
        $data = trim($data);
    }

}
?>