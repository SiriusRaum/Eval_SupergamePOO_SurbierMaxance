<?php


require_once  'Model/ModelPlayer.php';
require_once  'View/ViewHome.php';
require_once  'Controller/ControllerHome.php';

// Création du modèle
$model = new ModelPlayer(0, "", 0, "", 1);

// Création de la vue
$view = new ViewHome("", []);

// Création du contrôleur
$controllerHome = new ControllerHome($model, $view);

// Traitement du formulaire
$controllerHome->registerPlayer();

// Récupération des joueurs
$controllerHome->displayPlayers();

// Affichage de la page
$controllerHome->render();