<?php
require '_connexionRequise.php';
$titrePage = "Mon Compte";
$rootURL = "../";
include($rootURL . '_header.php');
include($rootURL . '_hierarchie.php');

require $rootURL . '_connexionBDD.php';

?>

<div id="content">

	<input id="tab_infos" name="tab" type="radio" class="selecteur" checked/>
	<label for="tab_infos" class="label_selecteur">Informations</label>

	<input id="tab_profil" name="tab" type="radio" class="selecteur"/>
	<label for="tab_profil" class="label_selecteur">Mon profil</label>

	<input id="tab_resa" name="tab" type="radio" class="selecteur"/>
	<label for="tab_resa" class="label_selecteur">Mes réservations</label>

	<?php


	if(isset($_POST['coords'])){

		if(!empty($_POST['nom']) and !empty($_POST['prenom']) and !empty($_POST['adresse']) and !empty($_POST['codePostal']) and !empty($_POST['ville']) and !empty($_POST['pays']) and !empty($_POST['email']) and filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){

			// On se protège de quelques injections SQL
	    $nomPost = mysql_real_escape_string($_POST['nom']);
	    $prenomPost = mysql_real_escape_string($_POST['prenom']);
	    $adressePost = mysql_real_escape_string($_POST['adresse']);
	    $codePostalPost = mysql_real_escape_string($_POST['codePostal']);
	    $villePost = mysql_real_escape_string($_POST['ville']);
	    $paysPost = mysql_real_escape_string($_POST['pays']);
			$emailPost = mysql_real_escape_string($_POST['email']);

			$requete = mysql_query("UPDATE VR_grp14_Client SET
										nom = '".$nomPost."',
										prenom = '".$prenomPost."',
										adresse = '".$adressePost."',
										codePostal = '".$codePostalPost."',
										ville = '".$villePost."',
										pays = '".$paysPost."',
										email = '".$emailPost."'

										WHERE ID = '".$_SESSION['userID']."'");

	    if(!$requete) {
	      die('Erreur dans la requête : ' . mysql_error());
	    }

		}

	}

	if(isset($_POST['pwd_submit'])){

		if(!empty($_POST['pwd']) and $_POST['pwd'] == $_POST['pwd2']){

			$password = hash("sha256", $_POST['pwd']);
			$requete = mysql_query("UPDATE VR_grp14_Client SET
										motDePasse = '".$password."'
										WHERE ID = '".$_SESSION['userID']."'");

	    if(!$requete) {
	      die('Erreur dans la requête : ' . mysql_error());
	    }
		}

	}



	$requete = mysql_query('SELECT * FROM VR_grp14_Client WHERE ID = "'. $_SESSION['userID'] .'"');
	if(!$requete) {
	    die('Erreur dans la requête : ' . mysql_error());
	}
	if (mysql_num_rows($requete) == 0) {
		die("Erreur.");
	}

	$valeur = mysql_fetch_array($requete);

	?>

	<section id="infos">
		<p>Bonjour, <?php echo $valeur['prenom'] . " " . $valeur['nom']; ?>.</p>
	</section>

	<section id="profil">
		<p>

			<?php

				echo "<h3>Mes coordonnées</h3>";
				echo $valeur['nom'] . " " . $valeur['prenom'] . "<br/>";
				echo $valeur['adresse'] . "<br/>";
				echo $valeur['codePostal'] . "<br/>";
				echo $valeur['ville'] . "<br/>";
				echo $valeur['pays'] . "<br/>";
				echo $valeur['mail'] . "<br/>";

				echo "<h3>Modifier mes coordonnées</h3>";

				if(isset($_POST['coords'])){

					if(!empty($_POST['nom']) and !empty($_POST['prenom']) and !empty($_POST['adresse']) and !empty($_POST['codePostal']) and !empty($_POST['ville']) and !empty($_POST['pays']) and !empty($_POST['email']) and filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
						echo "<h2>Vos coordonnées ont bien été mises à jour</h2>";
					}
					else{
						echo "<h2>Vous n'avez pas rempli correctement tous les champs</h2>";
					}

				}


			?>

			<form method="post">
				<fieldset>
					<label for="nom">Nom :</label>
					<input name="nom" id="nom" value="<?php echo $valeur['nom'] ?>" required/>

					<label for="prenom">Prénom :</label>
					<input name="prenom" id="prenom" value="<?php echo $valeur['prenom'] ?>" required/>

					<label for="adresse">Adresse :</label>
					<input name="adresse" id="adresse" value="<?php echo $valeur['adresse'] ?>" required/>

					<label for="codePostal">Code postal :</label>
					<input name="codePostal" id="codePostal" value="<?php echo $valeur['codePostal'] ?>" required/>

					<label for="ville">Ville :</label>
					<input name="ville" id="ville" value="<?php echo $valeur['ville'] ?>" required/>

					<label for="pays">Pays :</label>
					<input name="pays" id="pays" value="<?php echo $valeur['pays'] ?>" required/>

					<label for="email">Adresse mail :</label>
					<input name="email" id="email" type="email" value="<?php echo $valeur['email'] ?>" required/>

					<input type="submit" class="submit" name="coords" value="Modifier mes coordonnées"/>
				</fieldset>
			</form>

			<h3>Modifier mon mot de passe</h3>


			<?php

				if(isset($_POST['pwd_submit'])){

					if(!empty($_POST['pwd']) and $_POST['pwd'] == $_POST['pwd2']){
						echo "<h2>Votre mot de passe a bien été modifié</h2>";
					}
					else{
						echo "<h2>Votre mot de passe n'est pas valide</h2>";
					}

				}

			?>
			<form method="post">
				<fieldset>
					<label for="pwd">Mot de passe :</label>
					<input type="password" name="pwd" id="pwd" placeholder="**********" required/>

					<label for="pwd2">Mot de passe (répétez-le) :</label>
					<input type="password" name="pwd2" id="pwd2" placeholder="**********" required/>

					<input type="submit" class="submit" name="pwd_submit" value="Modifier mon mot de passe"/>
				</fieldset>
			</form>


		</p>
	</section>

	<section id="resa">
		<p>Voici tes réservations.</p>
	</section>


</div>

<?php include($rootURL . '_footer.php'); ?>
