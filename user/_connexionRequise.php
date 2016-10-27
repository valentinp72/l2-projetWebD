<?php

//Pour éviter re re-start la session si elle est déjà ouverte
if(!isset($_SESSION)) session_start();

if(!isset($_SESSION['userID'])){
  header('location: connexion.php'); //Si l'utilisateur n'est pas connecté, on le redirige vers la page de connexion
}

?>
