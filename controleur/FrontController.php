<?php
    class FrontController{
        function __construct(){
            session_start();
            $listeAction_Admin = array('deconnexion', 'supprimer', 'ajouter', 'pageAdmin', 'changerNbNewsParPage');

            $dVueEreur = array ();

            try{
                $a = AdminModele::isAdmin();
                if(isset($_REQUEST['action'])){
                    $action = $_REQUEST['action'];
                }
                else{
                    $action = NULL;
                }

                if(in_array($action, $listeAction_Admin)){
                    if($a == false){
                        global $rep,$vues;
                            require($rep.$vues['connexionAdmin']);
                    }
                    else{
                        $controleur = new AdminControleur();
                    }
                }
                else{
                    $controleur = new VisiteurControleur();
                }
            }
            catch (Exception $e){
                global $rep,$vues;
                $dVueEreur[] =	$e->getMessage();
                require($rep.$vues['erreur']);
            }
            exit(0);
        }
    }
?>