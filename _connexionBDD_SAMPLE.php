<?php

// REMPLACER CES DONNEES PAR LES IDENTIFIANTS DE CONNEXION ET RENNOMER LE FICHIER EN _connexionBDD.php

$ServeurBDD     = "host du serveur";
$UtilisateurBDD = "utilisateur de connexion à la base";
$MotDePasseBDD  = "mot de passe de connexion à la base";
$NomBaseDD      = "nom de la base à se connecter";


$lien = mysql_connect($ServeurBDD, $UtilisateurBDD, $MotDePasseBDD);
if(!$lien){
  die("Connexion impossible à la base de donnée.");
}

$base = mysql_select_db($NomBaseDD, $lien);
if(!$base){
  die("Selection impossible de la base.");
}

// Résoudre les problèmes d'encodage.
mysql_query("SET NAMES UTF8");

?>
