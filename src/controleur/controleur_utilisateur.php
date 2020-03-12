<?php

function actionUtilisateur($twig, $db){
    $form = array();
    $utilisateur = new Utilisateur($db);

    

    if(isset($_GET['email'])){
        $exec=$utilisateur->delete($_GET['email']);
        if (!$exec){
            $form['suppressionuser'] = false;
            $form['messagesupressionutilisateur'] = 'Problème de suppression dans la table utilisateur';
        }
    else{
        $form['supressionuser'] = true;
        $form['messagesupressionutilisateur'] = 'Utilisateur supprimé avec succès';
        } 
        

}
    $liste = $utilisateur->select();
    echo $twig->render('utilisateur.html.twig', array('form'=>$form,'liste'=>$liste)); 
}