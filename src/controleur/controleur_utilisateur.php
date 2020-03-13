<?php

function actionUtilisateur($twig, $db){
    $form = array();
    $utilisateur = new Utilisateur($db);

    

    if(isset($_GET['email'])){
        $exec=$utilisateur->delete($_GET['email']);
        if (!$exec){
            $form['suppressionuser'] = false;
            $form['messagesupressionutilisateur'] = 'Problème de suppression dans la table utilisateur';
        }
    else{
        $form['supressionuser'] = true;
        $form['messagesupressionutilisateur'] = 'Utilisateur supprimé avec succès';
        } 
        

}
    $liste = $utilisateur->select();
    echo $twig->render('utilisateur.html.twig', array('form'=>$form,'liste'=>$liste)); 
}

function actionUtilisateurModif($twig, $db){     
    $form = array();
    if(isset($_GET['email'])){
        $email = $_GET['email'];
        $utilisateur = new Utilisateur($db);
        $unUtilisateur = $utilisateur->selectByEmail($_GET['email']);
        if ($unUtilisateur!=null){
             $form['utilisateur'] = $unUtilisateur;
        }
         
            else{      
                $form['messageutili'] = 'Email incorrect';
                } 
          }
    if(isset($_POST['btModifier'])){
        $utilisateur = new Utilisateur($db);
        $nom = $_POST['inputNom'];
        $prenom = $_POST['inputPrenom'];
        $email = $_POST['email'];
        $form['validemodif'] = true;
    
    
        $exec=$utilisateur->updateUtilisateur($nom,$prenom, $email);
        if (!$exec){
          
             
             $form['messageutili'] = 'Utilisateur incorrect'; 
        }
            else{         
                $mdp = $_POST['inputNewMdp'];
                $mdp2 = $_POST['inputOldMdp'];
                

                if(!empty($mdp) and !empty($mdp2)){
                    if($mdp==$mdp2){
                    $exec2=$utilisateur->updateMdp($email, password_hash($mdp, PASSWORD_DEFAULT));


                
                $form['messageutili'] = 'Modification réussie';
                
                    }
                    else{
                      
                        $form['messageutili'] = 'Mot de passe différents';
                    }
                }
                else{
                  
                    $form['messageutili'] = 'Pas de mot de passe saisi';}
                }
                }
                else{
              
                $form['messageutili'] = 'Utilisateur non précisé';
                }
                 

echo $twig->render('utilisateur-modif.html.twig', array('form'=>$form)); 
    }
  