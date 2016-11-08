<?php
session_start();
$rootURL = "../";
require $rootURL . '_connexionBDD.php';

$n = count($_SESSION['panier']['produit']);
if ($n > 0) {
	for ($i = 0; $i < $n; $i++) {
		$requete = mysql_query("INSERT INTO VR_grp14_Paniers (ID_Jeu, ID_Client) VALUES ('".$_SESSION['panier']['id'][$i]."', '".$_SESSION['userID']."')");

		if(!$requete) {
			die('Erreur dans la requête : ' . mysql_error());
		}
	}
}
$_SESSION = array();
session_destroy();

$titrePage = "Déconnexion";
include($rootURL . '_header.php');
include($rootURL . '_hierarchie.php')
?>

<div id="content">

	Vous avez bien été déconnecté.

</div>

<?php include($rootURL . '_footer.php'); ?>
