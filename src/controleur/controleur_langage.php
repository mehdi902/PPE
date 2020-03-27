<?php

function actionLangage($twig, $db){
    $form = array();
    $langage = new Langage ($db);
    $liste = $langage->select();

    
    if(isset($_POST['btAjouterLangage'])){
        $inputLibelle = $_POST['inputLibelle'];
        
        $unlangage=$langage->selectnomdulangagae($inputLibelle);
        if($unlangage == null){               
        $exec = $langage->insert($inputLibelle);
        $form['libelle'] = $inputLibelle;

        $form['valide']= true;
        }
        else{
            $form['valide']= false;
            $form['message'] = 'Langage déja dans la table';
            
        }
    }       


  

    
    if(isset($_GET['id'])){
        $exec=$langage->delete($_GET['id']);
        if (!$exec){
            $form['suppression'] = false;
            $form['messagesupression'] = 'Problème de suppression dans la table produit';
        }
    else{
        $form['supression'] = true;
        $form['messagesupression'] = 'Produit supprimé avec succès';
        }
    }
    
    $limite=3;
    if(!isset($_GET['nopage'])){
        $inf=0;
        $nopage=0;
        }
        else{
            $nopage=$_GET['nopage'];
            $inf=$nopage * $limite;
            }    
            $r = $langage->selectCount();
            $nb = $r['nb'];
            $liste = $langage->selectLimit($inf,$limite);
            $form['nbpages'] = ceil($nb/$limite);
            
    

    echo $twig->render('langage.html.twig', array('form'=>$form,'liste'=>$liste));

}


function actionLangagesdisponibles($twig,$db){
    $form = array();
    $langage = new Langage($db);

    $listepublique = $langage->select();
    echo $twig->render('langagesdisponibles.html.twig', array('form'=>$form,'listepublique'=>$listepublique));    
    
}
