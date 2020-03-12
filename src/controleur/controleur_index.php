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
        
        <p>Bonjour '.$inputprenom.' '.$inputnom.', Merci pour votre inscription à Nomdusite. Pour activer votre compte, veuillez utiliser le code suivant.</p>
        <p>'.$code.'</p>
        <a href="'.$adresse.'">cliquez ici</a>
        
      </body>
     </html>
     ';

     // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
     $headers[] = 'MIME-Version: 1.0';
     $headers[] = 'Content-type: text/html; charset=utf-8';

     // En-têtes additionnels
     
     $headers[] = 'From: Nom du site';
 
     mail($to, $subject, $message, implode("\r\n", $headers));

         if ($inputPassword!=$inputPassword2){
             $form['valide'] = false;
         $form['message'] = 'Les mots de passe sont différents';}
         else{
                 $utilisateur = new Utilisateur($db);
                 $exec = $utilisateur->insert($inputEmail, password_hash($inputPassword, PASSWORD_DEFAULT), $role, $inputnom, $inputprenom, $code, $date);
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

function actionConnexion($twig){
    $form = array();
    $form['valide'] = true;
    if (isset($_POST['btConnecter'])){
        $inputEmail = $_POST['inputEmail'];
        $inputPassword = $_POST['inputPassword'];
        $_SESSION['login'] = $inputEmail;
        $_SESSION['role'] = 1;
        header("Location:index.php");
        }
    echo $twig->render('connexion.html.twig', array());
}
function actionDeconnexion($twig){
    session_unset();
    session_destroy();
    header("Location:index.php");
    }
    
    
function actionProfil($twig, $db){
    $form = array();
    $utilisateur = new Utilisateur($db);
    $liste = $utilisateur->selectProfil($_SESSION['login']);
    echo $twig->render('profil.html.twig', array('form'=>$form,'liste'=>$liste));
    
}



function actionDeveloppeur($twig) {
    echo $twig->render('developpeur.html.twig',array());

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
