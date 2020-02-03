<?php

function actionLangage($twig, $db){
    $form = array();
    $langage = new Langage ($db);
    
    
    if(isset($_POST['btAjouterLangage'])){
        $inputLibelle = $_POST['inputLibelle'];
        
        $exec = $langage->insert($inputLibelle);
        $form['libelle'] = $inputLibelle;
    }       
    $liste = $langage->select();
        

    
    echo $twig->render('langage.html.twig', array('form'=>$form,'liste'=>$liste));


}