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


<div id="titre"><?php echo $nomJeu ?> </div>

<div id="imageDeJeu">
	<img src="media/images_catalogue/<?php echo $valeur['pathImageJeu']?>" alt="illustration <?php echo $valeur['NomJeu']?>"/>
</div>

<div id="content">

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
