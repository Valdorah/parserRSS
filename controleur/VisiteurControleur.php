<?php
    class VisiteurControleur{
        function __construct(){
            $dVueEreur = array ();

            try{
                if(isset($_REQUEST['action'])){
                    $action = $_REQUEST['action'];
                }
                else{
                    $action = NULL;
                }

                switch($action) {
                    case NULL:
                        $this->pagePrincipale();
                        break;
                    case "connexion":
                        $this->connexion();
                        break;
                    default:
                        global $rep,$vues;
                        $dVueEreur[] = "Action non définit !";
                        require($rep.$vues['erreur']);
                        break;
                }

                $fluxMod = new FluxModele();
                //$fluxMod->nettoyerBase();
                $tab = $fluxMod->afficherFlux();
                foreach ($tab as $value) {
                    $parser = new XmlParser($value['adresse']);
                    $parser ->parse();
                }
                $fluxMod->nettoyerBase();
            }
            catch (Exception $e){
                global $rep,$vues;
                $dVueEreur[] =	$e->getMessage();
                require($rep.$vues['erreur']);
            }
            exit(0);
        }

        private function pagePrincipale(){
            global $rep,$vues;
            $m = new VisiteurModele();
            $paramode = new ParametreModele();

            $nbDeNewsParPage = $paramode->nbNewsParPage();
            $nbTotalDeNews = $m->compterLesNews();

            $nbPages = Validation::nbPage($nbTotalDeNews, $nbDeNewsParPage);
            $page = Validation::pagination($nbDeNewsParPage, $nbTotalDeNews);
            
            $premiereNews = $m->nbNewsParPage($page, $nbDeNewsParPage);

            $listeNews = $m->afficherLesNewsParPage($premiereNews, $nbDeNewsParPage);
            require($rep.$vues['vueVisiteur']);
        }

        private function connexion(){
            global $rep,$vues;
            if(isset($_POST['identifiant']) && isset($_POST['mdp'])){
                $identifiant = Validation::nettoyerString($_POST['identifiant']);
                $password = Validation::nettoyerString($_POST['mdp']);
                $adm = AdminModele::connection($identifiant, $password);
                if($adm == NULL){
                    require($rep.$vues['connexionAdmin']);
                }
                else{
                    $adminMod = new AdminModele();
                    $listeFlux = $adminMod->afficherFlux();
                    require($rep.$vues['vueAdmin']);
                }
            }
            else{
                require($rep.$vues['connexionAdmin']);
            }
        }
    }
?>