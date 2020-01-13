<?php

function actionAccueil($twig){
    echo $twig->render('index.html.twig', array());
    
}

function actionInscription($twig){
    echo $twig->render('inscription.html.twig', array());
}
