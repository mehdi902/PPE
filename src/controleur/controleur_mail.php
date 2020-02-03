<?php

function actionValidation($twig, $db){
    $form = array();
    echo $twig->render('validation_mail.html.twig', array('form'=>$form)); 
    
}
