<?php

function actionValidation($twig, $db){
    
    $form = array();
    $bdEmail = new Mail($db);
    
    $email=$_GET['email'];
    $codeSecret=$_GET['code'];
    $form['codesecret'] = $codeSecret;
    $form['email'] = $email;
    $validation = $bdEmail->updateUti($email);   
    
    echo $twig->render('validation_mail.html.twig', array('form'=>$form));  
    }