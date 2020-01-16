<?php

function actionAccueil($twig){
    echo $twig->render('index.html.twig', array());
    
}
function actionMaintenance($twig) {
    echo $twig->render('maintenance.html.twig',array());

}

function actionInscription($twig){
    if (isset($_POST['btInscrire'])){
        $inputEmail = $_POST['inputEmail'];
        $inputPassword = $_POST['inputPassword'];
        $inputPassword2 =$_POST['inputPassword2'];
        $role = $_POST['role'];
        $form['valide'] = true;
         if ($inputPassword!=$inputPassword2){
             $form['valide'] = false;
             $form['message'] = 'Les mots de passe sont différents';      
         }
        $form['email'] = $inputEmail;
        $form['role'] = $role;
        
        } 
    echo $twig->render('inscription.html.twig', array('form=>$form'));
}
