<?php
	$titrePage = "Jeu";

	require '_connexionBDD.php'; // Connexion à la BDD


	if(is_numeric($_GET['id'])){

		$id = mysql_real_escape_string($_GET['id']);

		$requete = mysql_query('SELECT * FROM Jeux WHERE ID_Jeu = "' . $id . '"');
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
			<div class="info_desc">Disponibilité : <span class="info_val">En stock</span></div>
			<div class="info_desc">Âge : <span class="info_val">à partir de 8 ans</span></div>
			<div class="info_desc"><?php echo $valeur['type_jeu']; ?></div>

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

			<a href="panier.php" id="bouton_reserver">Réserver</a>
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
