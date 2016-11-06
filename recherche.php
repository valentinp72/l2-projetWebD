<?php
	$titrePage = "Recherche";
	include('_header.php');
	include('_hierarchie.php');
	require '_connexionBDD.php'; // Connexion à la BDD
?>

<div id="content">

	<form method="post" class="search" action="recherche.php#resultat_recherche">
		<fieldset>
			<legend>Veuillez remplir au moins un des champs ci-dessous :</legend>
			<label for="recherche_nom">Recherche par nom du jeu :</label>
			<input type="search" name="recherche_nom" id="recherche_nom" value="<?php echo $_POST['recherche_nom']; ?>" placeholder="Monopoly"/>

			<label for="recherche_age">Recherche par âge minimum :</label>
			<input type="search" name="recherche_age" id="recherche_age" value="<?php echo $_POST['recherche_age']; ?>" placeholder="12"/>

			<label for="recherche_nb_joueurs_min">Nombre de joueurs minimum :</label>
			<input type="search" name="recherche_nb_joueurs_min" id="recherche_nb_joueurs_min" value="<?php echo $_POST['recherche_nb_joueurs_min']; ?>" placeholder="2"/>

			<label for="recherche_nb_joueurs_max">Nombre de joueurs maximum :</label>
			<input type="search" name="recherche_nb_joueurs_max" id="recherche_nb_joueurs_max" value="<?php echo $_POST['recherche_nb_joueurs_max']; ?>" placeholder="4"/>

			<label for="recherche_type_jeu">Type de jeu :</label>
			<select name="recherche_type_jeu" id="recherche_type_jeu">
				<option value="DEFAULT" selected="selected" disabled>Choissiez votre type de jeu</option>
				<?php
					// On liste tous les types de jeux différents dispo dans la base
					$requete = mysql_query("SELECT DISTINCT type_jeu FROM VR_grp14_Jeux");
					if(!$requete) {
						die('Erreur dans la requête : ' . mysql_error());
					}
					while ($valeur = mysql_fetch_array($requete)) {
						echo '<option value="' . $valeur['type_jeu'] .'" ';
						// on séléctionne l'element qui était déjà choisi lors de la derniere validation du formulaire
						if($_POST['recherche_type_jeu'] == $valeur['type_jeu']){
							echo 'selected="selected"';
						}
						echo '>'.$valeur['type_jeu'].'</option>';
					}
				?>
			</select>

			<label for="recherche_disponibilite">Disponibilité :</label>
			<select name="recherche_disponibilite">
				<option value="disponible" <?php if ($_POST['recherche_disponibilite']  == 'disponible') echo 'selected="selected"'; ?>> Disponible </option>
				<option value="indifferent" <?php if ($_POST['recherche_disponibilite']  == 'indifferent') echo 'selected="selected"'; ?>> Indifferent </option>
			</select>


			<input type="submit" id="submit" name="rechercher" value="Rechercher"/>
		</fieldset>
	</form>



<?php

// * Si le champ recherche a été rempli * //

if(isset($_POST['rechercher'])){

	// Si aucun critère n'est spécifié, on liste tous les jeux
	$rq = "SELECT * FROM VR_grp14_Jeux ";
	$nb_criteres_recherche = 0;

	if ($_POST['recherche_disponibilite'] == "disponible") {
		$rq = $rq . "WHERE nbJeuxDispo > 0 AND STR_TO_DATE('" . date (Y-m-d) . "', '%Y-%m-%d') > date_sortie ";
		$nb_criteres_recherche++;
	}

	if(!empty($_POST['recherche_nom']) or !empty($_POST['recherche_age']) or !empty($_POST['recherche_nb_joueurs_min']) or !empty($_POST['recherche_nb_joueurs_max']) or !empty($_POST['recherche_type_jeu']) ){
		if ($_POST['recherche_disponibilite'] == "indifferent") {
			$rq = $rq . "WHERE ";
		}
		// Si le critère de recherche est spécifié :
		if(!empty($_POST['recherche_nom'])){
			// On ajoute AND à la requete si il y avait déjà d'autres critères
			if($nb_criteres_recherche != 0) $rq = $rq . " AND ";
			// On ajoute le criètre
			$rq = $rq . "NomJeu = '" . $_POST['recherche_nom'] . "'";
			// On incrèmente le nombre total de recherche
			$nb_criteres_recherche++;
		}

		if(!empty($_POST['recherche_age'])){
			if($nb_criteres_recherche != 0) $rq = $rq . " AND ";
			$rq = $rq . "age_min >= '" . $_POST['recherche_age'] . "'";
			$nb_criteres_recherche++;
		}

		if(!empty($_POST['recherche_nb_joueurs_min'])){
			if($nb_criteres_recherche != 0) $rq = $rq . " AND ";
			$rq = $rq . "joueurs_min >= '" . $_POST['recherche_nb_joueurs_min'] . "'";
			$nb_criteres_recherche++;
		}

		if(!empty($_POST['recherche_nb_joueurs_max'])){
			if($nb_criteres_recherche != 0) $rq = $rq . " AND ";
			$rq = $rq . "joueurs_max <= '" . $_POST['recherche_nb_joueurs_max'] . "'";
			$nb_criteres_recherche++;
		}

		if(!empty($_POST['recherche_type_jeu'])){
			if($nb_criteres_recherche != 0) $rq = $rq . " AND ";
			$rq = $rq . "type_jeu = '" . $_POST['recherche_type_jeu'] . "'";
			$nb_criteres_recherche++;
		}

	}

	$requete = mysql_query($rq);
	if(!$requete) {
		die('Erreur dans la requête : ' . mysql_error());
	}


?>

	<h2 id="resultat_recherche">Résultat de la recherche :</h2>

	<div id="liste_jeux">

		<?php
			//Si il n'y a pas de résulats
			if (mysql_num_rows($requete) == 0) {
				echo "<p>Pas de résultats</p>";
			}
			while ($valeur = mysql_fetch_array($requete)) {

				echo "	<div class='jeuCatalogue'>\n		";

				echo "		<div class='nom_jeu'><a href='jeu.php?id=" . $valeur['ID_Jeu'] . "'>". $valeur['NomJeu'] . "</a></div>\n		";

				echo "		<div class='resume'>";
				echo substr($valeur['descriptionJeu'],0,200);

				if(strlen($valeur['descriptionJeu']) > 200)
					echo "... [<a href='jeu.php?id=".$valeur['ID_Jeu']."'>voir la suite</a>]";

				echo "</div>";

				echo "		<img src='media/images_catalogue/".$valeur['pathImageJeu']."' class='image_catalogue' alt='Illustration du jeu ".$valeur['NomJeu']."' />";
				echo "\n		</div>\n";
			}
		?>
	</div>

<?php
}

echo "</div>";
include('_footer.php');

?>
