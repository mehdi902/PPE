<?php

session_start();

require_once '../src/config/routing.php';
require_once '../src/controleur/controleur_index.php';
require_once '../src/config/parametres.php';




$loader = new Twig_Loader_Filesystem('../src/vue/');
$twig = new Twig_Environment($loader, array());
$twig->addGlobal('session', $_SESSION);

$contenu = getPage($db);

$contenu($twig,$db);

