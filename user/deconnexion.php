<?php
session_start();
$_SESSION = array();
session_destroy();

$titrePage = "Déconnexion";
$rootURL = "../";
include($rootURL . '_header.php');
include($rootURL . '_hierarchie.php')
?>

<div id="content">

	Vous avez bien été déconnecté.

</div>

<?php include($rootURL . '_footer.php'); ?>
