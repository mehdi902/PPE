<?php

function actionValidation($twig, $db){
    
    $form = array();
    $utilisateur = new Mail($db);
    $emailPre=$_GET['email'];
    $codeSecretPre=$_GET['code'];
    $form['codesecretpre'] = $codeSecretPre;
    $form['emailpre'] = $emailPre;
    if(isset($_POST['btValidation'])){
       
        
        $email = $_POST['InputEmail'];
        $code = $_POST['InputCode'];
   
        $validation = $utilisateur->updateUti($email);
        header("Location:index.php");
    
    $form['validemodif'] = true;}
    
    
    
    echo $twig->render('validation_mail.html.twig', array('form'=>$form));  
    }