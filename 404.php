<?php
$titrePage = "404 : Page non trouvée";
$cacherHierarchie = true;

$rootURL = "/";

include('_header.php');
include('_hierarchie.php')
?>

<div id="content">

	<div id="page404">
		<img src="/media/404.png" alt="Erreur 404"/>
		<p>
			La page demandée n'a pas été trouvée ... ☹️<br/>
			<a href="index.php">Cliquez ici pour retourner à l'accueil</a><br/>
			<a href="javascript: history.back()">Cliquez ici pour retourner à la page précédente</a>
		</p>
	</div>

</div>

<?php include('_footer.php'); ?>
