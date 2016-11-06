<?php
session_start();

if(!isset($_SESSION['userID'])){
  header('location: ../user/connexion.php'); //Si l'utilisateur n'est pas connecté, on le redirige vers la page de connexion
}
if($_SESSION['admin'] != 1){
  header('location: ../index.php');  //L'utilisateur doit être admin
}
?>
