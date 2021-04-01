<?php

function actionUtilisateur($twig, $db)
{
    $form = array();
    $utilisateur = new Utilisateur($db);
    $liste = $utilisateur->select();
    

    if (isset($_GET['email'])) {
        $exec=$utilisateur->delete($_GET['email']);
        if (!$exec) {
            $form['suppressionuser'] = false;
            $form['messagesupressionutilisateur'] = 'Problème de suppression dans la table utilisateur';
        } else {
            $form['supressionuser'] = true;
            $form['messagesupressionutilisateur'] = 'Utilisateur supprimé avec succès';
        }
    }
    $limite=3;
    if (!isset($_GET['nopage'])) {
        $inf=0;
        $nopage=0;
    } else {
        $nopage=$_GET['nopage'];
        $inf=$nopage * $limite;
    }
    $r = $utilisateur->selectCount();
    $nb = $r['nb'];
    $liste = $utilisateur->selectLimit($inf, $limite);
    $form['nbpages'] = ceil($nb/$limite);
    
    echo $twig->render('utilisateur.html.twig', array('form'=>$form,'liste'=>$liste));
}

function actionUtilisateurModif($twig, $db)
{
    $form = array();
    if (isset($_GET['email'])) {
        $email = $_GET['email'];
        $utilisateur = new Utilisateur($db);
        $unUtilisateur = $utilisateur->selectByEmail($_GET['email']);
        if ($unUtilisateur!=null) {
            $form['utilisateur'] = $unUtilisateur;
        } else {
            $form['messageutili'] = 'Email incorrect';
        }
    }
    if (isset($_POST['btModifier'])) {
        $utilisateur = new Utilisateur($db);
        $nom = $_POST['inputNom'];
        $prenom = $_POST['inputPrenom'];
        $email = $_POST['email'];
        $departement = $_POST['listeD'];
        $ville = $_POST['listeV'];
        $villeUtil= $_POST['ville'];
        $departementUtil= $_POST['departement'];
        $form['validemodif'] = true;
    
        if($ville == "" || $departement == ""){
            $exec=$utilisateur->updateUtilisateur($nom, $prenom, $email, $departementUtil, $villeUtil);
        }
        else{
            $exec=$utilisateur->updateUtilisateur($nom, $prenom, $email, $departement, $ville);}
        
        if (!$exec) {
            $form['messageutili'] = 'Utilisateur incorrect';
        } else {
            $mdp = $_POST['inputNewMdp'];
            $mdp2 = $_POST['inputOldMdp'];
                

            if (!empty($mdp) and !empty($mdp2)) {
                if ($mdp==$mdp2) {
                    $exec2=$utilisateur->updateMdp($email, password_hash($mdp, PASSWORD_DEFAULT));
                    $form['messageutili'] = 'Modification réussie';
                } else {
                    $form['messageutili'] = 'Mot de passe différents';
                }
            } else {
                $form['messageutili'] = 'Pas de mot de passe saisi';
            }
        }
    } else {
        $form['messageutili'] = 'Utilisateur non précisé';
    }
                 
                
    echo $twig->render('utilisateur-modif.html.twig', array('form'=>$form));
}
