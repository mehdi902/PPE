<?php

<<<<<<< HEAD
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
=======
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

>>>>>>> parent of 3382088... pfffffffff
