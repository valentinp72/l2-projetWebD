<?php

$titrePage = "Mot de passe oublié ?";
$rootURL = "../";
include($rootURL . '_header.php');
include($rootURL . '_hierarchie.php');


// Si l'utilisateur est déjà connecté
if(isset($_SESSION['userID'])){
	echo '<div id="content">';
	echo '<h1>Vous êtes déjà connecté !</h1><a href="deconnexion.php">Voulez-vous vous déconnecter ?</a>';
	echo '</div>';

} else {

?>

<div id="content">

  <p><a href="http://giphy.com/gifs/NGV4vAghFiUOA"><img src="http://i.giphy.com/NGV4vAghFiUOA.gif" alt="well, shame on you"></a></p>


  Bah fallait pas oublier ton mot de passe.

</div>

<?php
}
include($rootURL . '_footer.php');
?>
