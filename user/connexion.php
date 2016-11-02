<?php

$rootURL = "../";

require $rootURL . '_connexionBDD.php'; // Connexion à la BDD


session_start();

$emailPost    = mysql_real_escape_string($_POST['email']);    // On empêche quelques injections SQL
$passwordPost = mysql_real_escape_string($_POST['password']); // en utilisant une fonction d'échappement


$requete = mysql_query('SELECT motDePasse, ID FROM Clients WHERE email = "'. $emailPost .'"');
if(!$requete) {
    die('Erreur dans la requête : ' . mysql_error());
}

$valeur = mysql_fetch_array($requete);

//if(password_verify($passwordPost, $valeur['motDePasse'])){ <-- PHP 5.5.0 n'est pas installé à la Fac !
if(hash("sha256", $passwordPost) == $valeur['motDePasse']){
	$_SESSION['userID'] = $valeur['motDePasse'];
	header("Location: compte.php"); //On redirige l'utilisateur vers son compte une fois connecté
}



$titrePage = "Connexion";



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

	<h1>Connexion à votre compte</h1>


	<form method="post" id="login">
		<legend>
			<?php
			if(isset($_POST['submit'])){
				echo "<h2>Votre adresse mail et votre mot de passe ne correspondent pas.</h2>";
			}
			?>
			Vous n'avez pas de compte ? <a href="inscription.php">Inscrivez-vous</a><br/>
			<a href="mot_de_passe_oublie.php">Mot de passe oublié ?</a>
		</legend>
		<label for="email">Adresse mail : </label><input type="email" name="email" id="email" required><br/>
		<label for="password">Mot de passe : </label><input type="password" name="password" id="password" required><br/>
		<input type="submit" name="submit" id="submit" value="Connexion" />
	</form>


</div>
<?php
}
include($rootURL . '_footer.php');
?>
