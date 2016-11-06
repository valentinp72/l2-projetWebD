<?php
	$categorie = $_GET['categorie'];
	$titrePage = str_replace('_', ' ', $categorie);
	include('_header.php');
	include('_hierarchie.php');
	require '_connexionBDD.php'; // Connexion à la BDD
?>

<div id="content">
	<?php
		$rq = "SELECT * FROM VR_grp14_Jeux WHERE type_jeu = '".$categorie."'";

		$requete = mysql_query($rq);
		if(!$requete) {
			die('Erreur dans la requête : ' . mysql_error());
		}
	?>

	<h2><?php echo $categorie; ?> :</h2>

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
</div>

<?php
include('_footer.php');
?>
