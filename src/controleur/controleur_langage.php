<?php

function actionLangage($twig, $db){
    $form = array();

    $langage = new Langage ($db);
    if(isset($_POST['btAjouterLangage'])){
        $inputLibelle = $_POST['inputLibelle'];

        $exec = $type->insert ($inputLibelle);
        $form['libelle'] = $inputLibelle;
    }        
        
        
    $liste = $type->select();
    
    echo $twig->render('langage.html.twig', array('form'=>$form,'liste'=>$liste));

    
    if(isset($_POST['btAjouterLangage'])){
        $inputLibelle = $_POST['inputLibelle'];
        $libelle = new Libelle ($db);

        $exec = $libelle->insert ($inputLibelle);
        $form['libelle'] = $inputLibelle;
    }        
        

    
    echo $twig->render('langage.html.twig', array('form'=>$form));


}