<?php

function actionValidation($twig, $db){
    
    $form = array();
    $utilisateur = new Mail($db);
    
    $unUtilisateur = $utilisateur->select($_GET['email'],$_GET['code']);
    $form['utilisateur'] = $unUtilisateur;
           
    echo $twig->render('validation_mail.html.twig', array('form'=>$form));  
    }