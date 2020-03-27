<?php

function actionValidation($twig, $db){
    
    $form = array();
    $utilisateur = new Mail($db);
    
           
    if(isset($_POST['btValidation'])){
       
        
        $email = $_POST['InputEmail'];
        $code = $_POST['InputCode'];
   
      $validation = $utilisateur->updateUti($email);
        
    
    $form['validemodif'] = true;}
    
    
    
    echo $twig->render('validation_mail.html.twig', array('form'=>$form));  
    }