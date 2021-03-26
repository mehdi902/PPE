<?php

function actionValidation($twig, $db){
    
    $form = array();
    $bdEmail = new Mail($db);
    
    $email=$_GET['email'];
    $uniqId = $bdEmail->selectUniqid($email);
    $codeSecret=$_GET['code'];
    $form['codesecret'] = $codeSecret;
    $form['email'] = $email;
    if($uniqId[0][0] == $codeSecret){
        $validation = $bdEmail->updateUti($email);   
        
    }
    else{
        $form['message'] = "Le code fournit est faux";
    }
    
    echo $twig->render('validation_mail.html.twig', array('form'=>$form));  
    }