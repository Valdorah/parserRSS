<?php
    class AdminControleur{
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
                    case 'pageAdmin':
                        $this->pagePrincipale();
                        break;
                    case 'connexion':
                        $this->pageConnexion();
                        break;
                    case 'ajouter':
                        $this->ajouterFlux();
                        break;
                    case 'deconnexion':
                        $this->deconnexion();
                        break;
                    case 'supprimer':
                        $this->supprimer();
                        break;
                    case 'changerNbNewsParPage':
                        $this->changerNbNewsParPage();
                        break;
                    default:
                        global $rep,$vues;
                        $dVueEreur[] = "Action non définit !";
                        require($rep.$vues['erreur']);
                        break;
                }
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
            $adminMod = new AdminModele();
            $listeFlux = $adminMod->afficherFlux();
            require($rep.$vues['vueAdmin']);
        }

        private function pageConnexion(){
            global $rep,$vues;
            echo('<p class="alert alert-info">wow</p>');
            require($rep.$vues['connexionAdmin']);
        }

        private function ajouterFlux(){
            global $rep,$vues;
            $adresse = Validation::nettoyerString($_POST['adresse']);
            $adresse = Validation::valideURL($adresse);
            if($adresse){
                $adminMod = new AdminModele();
                if(Validation::fluxExiste($adresse) == 0){
                    $adminMod->ajouterFlux($adresse);
                    $listeFlux = $adminMod->afficherFlux();
                    require($rep.$vues['vueAdmin']);
                }
                else{
                    $dVueEreur[] = "Le lien est est déja présent.";
                    require($rep.$vues['erreur']);
                }
            }
            else{
                $dVueEreur[] = "Format du lien invalide. <br>Exemple de format valide : <br />http://unlien.com <br /> https://unautrelien.org";
                require($rep.$vues['erreur']);
            }
        }

        private function deconnexion(){
            global $rep,$vues;
            $adminMod = new AdminModele();
            $adminMod->deconnexion();
            require($rep.$vues['connexionAdmin']);
        }

        private function supprimer(){
            global $rep,$vues;
            $adminMod = new AdminModele();
            if(!empty($_POST)){
                foreach ($_POST[0] as $key => $value) {
                    $adresses [] = $key;
                }
                $adminMod->supprimerFlux($adresses);
            }
            $listeFlux = $adminMod->afficherFlux();
            require($rep.$vues['vueAdmin']);
        }

        private function changerNbNewsParPage(){
            global $rep,$vues;
            $adminMod = new AdminModele();
            $nb = Validation::verifNombre($_POST['nbNews']);
            if($nb != false){
                $paramodel = new ParametreModele();
                $paramodel->changerNbNewsParPage($nb);
                $listeFlux = $adminMod->afficherFlux();
                require($rep.$vues['vueAdmin']);
            }
            else{
                $dVueEreur[] = "Nombre de news par page saisi incorrect.";
                require($rep.$vues['erreur']);
            }
        }
    }
?>