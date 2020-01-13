<?php
function getpage(){
    $lespages['accueil'] = "actionaccueil";
    
    $contenu = $lesPages[$page];
    
    return $contenu;
}
