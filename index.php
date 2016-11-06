<?php
$titrePage = "Accueil";
$cacherHierarchie = true;
include('_header.php');
include('_hierarchie.php');
require '_connexionBDD.php'; // Connexion à la BDD

// Affichage de la date en Français
//setlocale(LC_TIME, "fr_FR");
setlocale(LC_TIME, 'fr','fr_FR','fr_FR@euro','fr_FR.utf8','fr-FR','fra');
?>
<div id="content">

	<div id="slideshow">

		<?php
			function str_to_noaccent($str) {
				$noaccent = $str;
				$noaccent = preg_replace('#ç#', 'c', $noaccent);
				$noaccent = preg_replace('#è|é|ê|ë#', 'e', $noaccent);
				$noaccent = preg_replace('#à|â#', 'a', $noaccent);

				return ($noaccent);
			}
			function ajouterImage ($nom) {
				$categorie = str_replace (' ', '_', $nom);
				$path = str_to_noaccent($nom);
				echo '<a href="categorie.php?categorie='.$categorie.'" >';
				echo '<img class="slide" src="media/slides/'.$path.'.jpg" alt="'.$nom.'"> </a>';
			}

			$categories = mysql_query("SELECT DISTINCT type_jeu FROM VR_grp14_Jeux");
			while ($categorie = mysql_fetch_array($categories)) {
				ajouterImage ($categorie['type_jeu']);
			}


		?>

  	<a id="slideButtonLeft" class="slideButton"  onclick="plusDivs(-1)">&#10094;</a>
  	<a id="slideButtonRight" class="slideButton" onclick="plusDivs(1)">&#10095;</a>

	</div>

	<script src="slideshow.js"></script>


	<p>
		Bonjour, bienvenue sur le site de la LudoTEK. Sur ce site, vous pourrez réserver les jeux présents dans notre ludothéque située 22 rue de nulle part au Mans, pour venir les chercher, ou y jouer directement sur place. Nous sommes ouverts du lundi au vendredi de 8h à 18h.
	</p>

	<h2>Dérnières nouveautés :</h2>

	<div class="nouveaute">
		<div class="titre_nouveaute"><a href="jeu.php?id=1">Le jeu Monopoly est dès maintenant disponnible !</a><span class="info_nouveaute">le 06/11/16</span></div>
		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
	</div>
	<div class="nouveaute">
		<div class="titre_nouveaute">Ouverture de la ludothéque !<span class="info_nouveaute">le 02/11/16</span></div>
		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
	</div>

	<?php

		$requete = mysql_query('SELECT * FROM VR_grp14_Jeux WHERE date_sortie > "' . date("Y-m-d") . '"');
		if(!$requete) {
		    die('Erreur dans la requête : ' . mysql_error());
		}
		if(mysql_num_rows($requete) > 0){

			echo "<h2>À venir prochainement :</h2>";

			while ($valeur = mysql_fetch_array($requete)) {
				echo '<div class="nouveaute">';
					echo '<div class="titre_nouveaute"><a href="jeu.php?id='. $valeur['ID_Jeu'] .'">'. $valeur['NomJeu'] .'</a><span class="info_nouveaute">disponnible le '. strftime('%e %B %Y',strtotime($valeur['date_sortie'])) .'</span></div>';
					echo "<div>";
					echo substr($valeur['descriptionJeu'],0,300);
					if(strlen($valeur['descriptionJeu']) > 300) echo "... [<a href='jeu.php?id=".$valeur['ID_Jeu']."'>voir la suite</a>]";
					echo "</div>";
					echo '<a href="jeu.php?id='. $valeur['ID_Jeu'] .'"><img src="media/images_catalogue/'. $valeur['pathImageJeu'].'" alt="'. $valeur['NomJeu'].'" class="image_a_venir"/></a>';
				echo '</div>';
			}
	?>

	<?php
	}

	?>

</div>

<?php include('_footer.php'); ?>
