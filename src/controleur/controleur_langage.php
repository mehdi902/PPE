<?php

function actionLangage($twig, $db){
    $form = array();
    $langage = new Langage ($db);
    

    
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
    $liste = $langage->select();
        


    }  

    
    if(isset($_GET['id'])){
        $exec=$langage->delete($_GET['id']);
        if (!$exec){
            $form['valide'] = false;
            $form['message'] = 'Problème de suppression dans la table produit';
        }
    else{
        $form['valide'] = true;
        $form['message'] = 'Produit supprimé avec succès';
        }
    }
    
    
    $liste = $langage->select();
    echo $twig->render('langage.html.twig', array('form'=>$form,'liste'=>$liste));


