<?php
$titrePage = "Connexion";
$rootURL = "../";

include($rootURL . '_header.php');
include($rootURL . '_hierarchie.php')
?>

<div id="content">

	<h1>Connexion à votre compte</h1>

	<form method="post" id="login">
		<legend>
			Vous n'avez pas de compte ? <a href="inscription.php">Inscrivez-vous</a><br/>
			<a href="mot_de_passe_oublie.php">Mot de passe oublié ?</a>
		</legend>
		<label for="email">Adresse mail : </label><input type="email" name="email" id="email" /><br/>
		<label for="password">Mot de passe : </label><input type="password" name="paswword" id="password" /><br/>
		<input type="submit" name="submit" id="submit" value="Connexion" />
	</form>


</div>

<?php include($rootURL . '_footer.php'); ?>
