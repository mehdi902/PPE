<?php

function actionAccueil($twig){
    echo $twig->render('index.html.twig', array());
    
}
function actionMaintenance($twig) {
    echo $twig->render('maintenance.html.twig',array());

}

function actionInscription($twig,$db){
    $form=array();
    if (isset($_POST['btInscrire'])){
        $inputEmail = $_POST['inputEmail'];
        $inputPassword = $_POST['inputPassword'];
        $inputPassword2 =$_POST['inputPassword2'];
        $inputnom =$_POST['nom'];
        $inputprenom =$_POST['prenom'];
        $inputDepartement = $_POST['listeD'];
        $inputVille = $_POST['listeV'];
        $role = $_POST['role'];
        $date = date('Y-m-d H:i:s');
        $form['valide'] = true;

        $code = uniqid();
        
        $to  = $_POST['inputEmail'] ; // notez la virgule
        $adresse='http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?page=validation-email&email='.$inputEmail.'&code='.$code.'';
     // Sujet
     $subject = 'Bienvenue';

     // message
     $message = '
     <html>
      <head>
       <title>Inscription réussie</title>
      </head>
      <body>
        
        <p>Bonjour '.$inputprenom.' '.$inputnom.', Merci pour votre inscription à ProgreZio. Pour activer votre compte, veuillez utiliser le code suivant.</p>
        <p>'.$code.'</p>
        <a href="'.$adresse.'">cliquez ici</a>
        
      </body>
     </html>
     ';

     // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
     $headers[] = 'MIME-Version: 1.0';
     $headers[] = 'Content-type: text/html; charset=utf-8';

     // En-têtes additionnels
     
     $headers[] = 'From: ProgreZio';
 
     

         if ($inputPassword!=$inputPassword2){
             $form['valide'] = false;
         $form['message'] = 'Les mots de passe sont différents';}
         else{
                 $utilisateur = new Utilisateur($db);
                 $exec = $utilisateur->insert($inputEmail, password_hash($inputPassword, PASSWORD_DEFAULT), $role, $inputnom, $inputprenom, $code, $date,$inputDepartement,$inputVille);
                 mail($to, $subject, $message, implode("\r\n", $headers));
                 if (!$exec){
                     $form['valide'] = false;
                     $form['message'] = 'Problème d\'insertion dans la table utilisateur ';
                     }
             }

        $form['email'] = $inputEmail;
        $form['role'] = $role;
        
        }
        
                 
    echo $twig->render('inscription.html.twig', array('form'=>$form));
}

function actionConnexion($twig,$db){
        $form = array();
        $form['valide'] = true;
        if (isset($_POST['btConnecter'])){
            $inputEmail = $_POST['inputEmail'];
            $inputPassword = $_POST['inputPassword'];
            $utilisateur = new Utilisateur($db);
            $unUtilisateur = $utilisateur->connect($inputEmail);
            if ($unUtilisateur!=null){
                if(!password_verify($inputPassword,$unUtilisateur['mdp'])|| $unUtilisateur['idRole']== 3 ){
                    $form['valide'] = false;
                    $form['messageConnexion'] = "Login incorrect ou le compte n'est pas activé";
                    }            
                else{
                    $_SESSION['login'] = $inputEmail;
                    $_SESSION['role'] = $unUtilisateur['idRole'];
                    header("Location:index.php");
                    }                                 
                }       
            else{
                $form['valide'] = false;
                $form['message'] = 'Login ou mot de passe incorrect';
                    }
                        }
    echo $twig->render('connexion.html.twig', array('form'=>$form));
    }


function actionDeconnexion($twig){
    session_unset();
    session_destroy();
    header("Location:index.php");
    }
    
    
function actionProfil($twig, $db){
    $form = array();
    $form['messageAjout'] = false;
    $utilisateur = new Utilisateur($db);
    $liste = $utilisateur->selectProfil($_SESSION['login']);
    $langage = new Langage($db);
    $recupLangage = $langage->select();
    
    
    if(isset($_GET['id'])){
        $profilUtilisateur = new Profil($db) ;
        $exec=$profilUtilisateur->delete($_GET['id'],$_SESSION['login']);
        if (!$exec){
            $form['suppression'] = false;
            $form['messagesupression'] = 'Problème de suppression dans la table codage';
        }
    else{
        $form['supression'] = true;
        $form['messagesupression'] = 'Langage supprimé avec succès';
        }
    }
     
    if(isset($_POST['btProfil'])){
      $email = $_POST['email'];
        
      
      $photo="profilvide.png";
      
    if(isset($_FILES['photo'])){
        if(!empty($_FILES['photo']['name'])){
            $extensions_ok = array('png', 'gif', 'jpg', 'jpeg');
            $taille_max = 500000; 
            $dest_dossier = '/var/www/groupe5/situation1/web/image/';      
            if( !in_array( substr(strrchr($_FILES['photo']['name'], '.'), 1), $extensions_ok ) ){
                echo 'Veuillez sélectionner un fichier de type png, gif ou jpg !';            } 
                else{    
                    if( file_exists($_FILES['photo']['tmp_name'])&& (filesize($_FILES['photo'] ['tmp_name'])) >
                            $taille_max){                    
                        echo 'Votre fichier doit faire moins de 500Ko !';
                        }               
                        else{
                             $photo = basename($_FILES['photo']['name']);   
                             $photo=strtr($photo,'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ','AAA AAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');  
                             $photo = preg_replace('/([^.a-z0-9]+)/i', '_', $photo); 
                             move_uploaded_file($_FILES['photo']['tmp_name'], $dest_dossier.$photo);
                             }   
                             }    
                             }   
                             
                            
    }
                
                $exec = $utilisateur->updateProfil($photo, $email);
                $form['message'] = 'Rechargez la page pour afficher les modifications';
                        }
        if(isset($_POST['btAjouterLangageProfil'])){
            $id = $_POST['inputLangage'];
            $profil = new Profil($db);
            $verificationDouble = $profil->selectLangageUti($id,$_SESSION['login'] );
            if ($verificationDouble==null){
            $insertLangageUtil = $profil->insertLangage( $id ,$_SESSION['login']);
            
            }
            else{$form['messageAjout'] = true;}
        }
    $langageProfil = new Profil($db);
    $langagesUtilises = $langageProfil->select($_SESSION['login']);
    echo $twig->render('profil.html.twig', array('form'=>$form,'liste'=>$liste, 'recupLangage'=>$recupLangage, 'langagesUtilises'=>$langagesUtilises));
    
}




function actionChangermdp($twig,$db){
    $form = array();
    $form['valide'] = true;
    if(isset($_POST['btchangermdp'])){
        $ancienmdp = $_POST['ancienmdp'];
        $nouveaumdp = $_POST['nouveau'];
        $confirmernouveaumdp = $_POST['confirmernouveaumdp'];
        if ($nouveaumdp!=$confirmernouveaumdp){
             $form['valide'] = false;
            $form['message'] = 'Les mots de passe sont différents';
        
            if ($inputPassword!=$nouveaumdp){
                $form['valide'] = false;
            $form['message'] = 'Les mots de passe sont différents';}}
        else{
            $exec = $utilisateur->update( password_hash($inputPassword, PASSWORD_DEFAULT),$_SESSION['login']);
            
        }
        
        
    }
    echo $twig->render('changermdp.html.twig',array('form'=>$form));
}    
    
    
   
    
 function actionLangagesutilisateur($twig){
    echo $twig->render('ajoutlangagesutilisateur.html.twig', array());
    
}      



                                
                    
    
