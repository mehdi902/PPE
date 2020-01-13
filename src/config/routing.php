<?php

function getPage(){
    $lesPages['accueil'] = "actionAccueil";
    $lesPages['inscription'] = "actionInscription";
    
    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }
    else{  $page = 'accueil';
    }
    if (!isset($lesPages[$page])){
        $page = 'accueil';
        }

    
$contenu = $lesPages[$page];
    
return $contenu; 
} ?>


