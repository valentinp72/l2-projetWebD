<?php
echo "-2";

//Uniquement là en attendant la BDD
//Génération du mot de passe hashé avec password_hash
$tempPassword = password_hash("password", PASSWORD_DEFAULT);
echo "-1";

$tempEmail = "mail";
echo "0";

session_start();
echo "1.5";

if( $_POST['email'] == $tempEmail and password_verify($_POST['password'], $tempPassword) ){

	$_SESSION['userID'] = 1; // A REMPLACER PAR UNE REQUETE MYSQL POUR ALLER RECUPERER L'ID DE L'UTILISATEUR
	header("Location: compte.php");

}
echo "1";

$titrePage = "Connexion";
$rootURL = "../";

echo "2";
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
