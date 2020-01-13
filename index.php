<?php


require_once '../src/controleur/controleur_index.php';

$loader = new Twig_Loader_Filesystem('../src/vue/'); $twig = new Twig_Environment($loader, array());
$contenu = getPage(); 

$contenu($twig);
?>