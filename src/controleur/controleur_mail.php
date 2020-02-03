<?php

function actionValidation($twig, $db){
    $form = array();
    echo $twig->render('utilisateur.html.twig', array('form'=>$form,'liste'=>$liste)); 
    
}
