<?php

function getPage($db){
    $lesPages['accueil'] = "actionAccueil";
    $lesPages['inscription'] = "actionInscription";
    $lesPages['maintenance'] = "actionMaintenance";
    

    if ($db!=null){
    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }
    else{  $page = 'accueil';
    }
    if (!isset($lesPages[$page])){
        $page = 'accueil';
        }
    $contenu = $lesPages[$page];
    }
    else{$contenu = $lesPages['maintenance'];
    }
    
return $contenu; 
} ?>


