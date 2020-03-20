<?php

function getPage($db){

    $lesPages['accueil'] = "actionAccueil;0";
    $lesPages['inscription'] = "actionInscription;0";
    $lesPages['maintenance'] = "actionMaintenance;0";
    $lesPages['connexion'] = "actionConnexion;0";
    $lesPages['deconnexion'] = "actionDeconnexion;0";
    $lesPages['profil'] = "actionProfil;0";    
    $lesPages['langage'] = "actionLangage;0"; 
    $lesPages['utilisateur'] = "actionUtilisateur;1";
    $lesPages['developpeur'] = "actionDeveloppeur;1";
    $lesPages['validation-email'] = "actionValidation;0";
    $lesPages['changermdp'] = "actionChangermdp;0";
    $lesPages['utilisateur-modif'] = "actionUtilisateurModif;1";
    $lesPages['ajoutlangagesutilisateur'] = "actionLangagesutilisateur;0";
    $lesPages['langagesdisponibles'] = "actionLangagesdisponibles;0";
    $lesPages['utilisateursdisponibles'] = "actionUtilisateursdisponibles;0";
    $lesPages['modif-profil'] = "actionModifProfil;0";

    if ($db != null) {

        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 'accueil';
        }
        if (!isset($lesPages[$page])) {
            $page = 'accueil';
        }
        $explose = explode(";", $lesPages[$page]);
        $role = $explose[1];
        if ($role != 0) {
            if (isset($_SESSION['login'])) {
                if (isset($_SESSION['role'])) {
                    if ($role != $_SESSION['role']) {
                        $contenu = 'actionAccueil';
                    }
                        else {
                            $contenu = $explose[0];
                        }
                    } else {
                        $contenu = 'actionAccueil';
                    }
                } else {
                    $contenu = 'actionAccueil';
                }
            } else {
                $contenu = $explose[0];
            }

        }


         else {
    
        $contenu = 'actionMaintenance';
    }


    // La fonction envoie le contenu    
    return $contenu;
}



