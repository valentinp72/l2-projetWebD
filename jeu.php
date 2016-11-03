<?php
	$titrePage = "Jeu";

	require '_connexionBDD.php'; // Connexion à la BDD


	if(is_numeric($_GET['id'])){

		$id = mysql_real_escape_string($_GET['id']);

		$requete = mysql_query('SELECT * FROM VR_grp14_Jeux WHERE ID_Jeu = "' . $id . '"');
		if(!$requete) {
				die('Erreur dans la requête : ' . mysql_error());
		}

		$valeur = mysql_fetch_array($requete);
		if(!empty($valeur)){


			$nomJeu = $valeur['NomJeu'];

			include('_header.php');
			include('_hierarchie.php');

?>

<div id="content">

<div id="titre"><?php echo $nomJeu ?></div>

	<div id="jeuInfos">
		<div id="imageDeJeu">
			<img src="media/images_catalogue/<?php echo $valeur['pathImageJeu']?>" alt="illustration <?php echo $valeur['NomJeu']?>"/>
		</div>

		<div id="informations_jeu">
			<h1>Informations</h1>
			<div class="info_desc">Disponibilité :
				<span class="info_val">
					<?php
						if($valeur['nbJeuxDispo'] == 0) echo 'non disponnible';
						else echo 'en stock';
					?>
				</span></div>

			<div class="info_desc">Âge : <span class="info_val">à partir de <?php echo $valeur['age_min']; ?> ans</span></div>

			<div class="info_desc"><?php echo $valeur['type_jeu']; ?></div>

			<div class="info_desc"><?php

			if($valeur['joueurs_min'] == $valeur['joueurs_max']) echo $valeur['joueurs_min'] . " joueurs";
			else echo "Entre " . $valeur['joueurs_min']. " et " . $valeur['joueurs_max'] . " joueurs"; 

			?></div>

			<div id="criteres_jeu">
				<?php
					if($valeur['habilite_physique']) echo '<span class="flaticon-success"></span>';
					else 														 echo '<span class="flaticon-error"></span>';
					echo "Habileté physique<br/>";

					if($valeur['reflexion']) echo '<span class="flaticon-success"></span>';
					else 														 echo '<span class="flaticon-error"></span>';
					echo "Réflexion / décision<br/>";

					if($valeur['hasard']) echo '<span class="flaticon-success"></span>';
					else 														 echo '<span class="flaticon-error"></span>';
					echo "Générateur de hasard<br/>";

					if($valeur['info_complete_parfaite']) echo '<span class="flaticon-success"></span>';
					else 														 echo '<span class="flaticon-error"></span>';
					echo "Information complète et parfaite<br/>";

				?>
			</div>
			<?php
				if($valeur['nbJeuxDispo'] == 0) echo '<span id="bouton_plusDeStock">Non disponnible</span>';
				else echo '<a href="panier.php?ajouter='.$valeur['ID_Jeu'].'" id="bouton_reserver">Réserver</a>';
			?>

		</div>
	</div>

<?php echo $valeur['descriptionJeu']; ?>

</div>

<?php

	}
	else {
		$nomJeu = "Erreur";
		include('_header.php');
		include('_hierarchie.php');
		echo "<div id='content'>Le jeu demandé n'existe pas.</div>";
	}
}
else{
	$nomJeu = "Erreur";
	include('_header.php');
	include('_hierarchie.php');
	echo "<div id='content'>Le jeu demandé n'existe pas.</div>";
}

include('_footer.php'); ?>
