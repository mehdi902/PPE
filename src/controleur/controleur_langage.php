<?php

function actionLangage($twig, $db){
    $form = array();
    
    if(isset($_POST['btAjouterLangage'])){
        $inputLibelle = $_POST['inputLibelle'];
        $libelle = new Libelle ($db);

        $exec = $libelle->insert ($inputLibelle);
        $form['libelle'] = $inputLibelle;
    }        
        

    
    echo $twig->render('langage.html.twig', array('form'=>$form));


}