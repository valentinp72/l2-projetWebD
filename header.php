<!-- HEADER.PHP, page à appeler par chaque page du site. La variable $title doit être déclarée auparavant -->
<!DOCTYPE html>
<html lang="fr">

	<head>
		<title>Ludothèque | <?php echo $titrePage; if(isset($nomJeu)) echo " : " . $nomJeu ?></title>
		<meta charset="UTF-8">
		<link rel="icon" type="image/x-icon" href="media/favicon.ico" />
		<link rel="stylesheet" type="text/css" href="style.css" media="all" />
		<link rel="stylesheet" type="text/css" href="style_jeu.css" media="all" />

		<!-- Corrige le zoom sur les mobiles -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

		<!-- Jquery pour le menu et le slideshow -->
		<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    	<script src="https://code.jquery.com/ui/1.11.1/jquery-ui.min.js"></script>

    	<script src="menu.js"></script>
	</head>

	<body>

		<div id="menu-hamburger">
			<div id="titreHamburger"><a href="index.html">LudoTEK</a></div>
			<ul>
				<li><a href="catalogue.php">Catalogue</a></li>
				<li class="active"><a href="compte.php">Mon compte</a></li>
				<li><a href="recherche.php">Recherhe</a></li>
				<li><a href="panier.php">Panier</a></li>
			</ul>
		</div>

		<!-- Div qui sera affiché une fois le menu ouvert pour qu'il ne soit plus clickable -->
    	<div id="contentLayer"></div>

    	<!-- Conteneur global de la page, utile pour le menu hamburger -->
    	<div id="pageContent">

			<div id="header">

				<div id="titreMenu">
					<a href="index.html">LudoTEK</a>
				</div>

				<ul>
					<li><a href="catalogue.php">Catalogue</a></li>
					<li class="separator">|</li>
					<li class="actif"><a href="compte.php">Mon compte</a></li>
					<li class="separator">|</li>
					<li><a href="recherche.php"><span class="flaticon-magnifying-glass"></span></a></li>
					<li><a href="panier.php"><span class="flaticon-shopping-cart"></span></a></li>

				</ul>

			    <div id="hamburger">
			    	<!-- Permet de générer les trois barres de l'hamburger -->
	        		<div></div>
	        		<div></div>
	        		<div></div>
	        	</div>
			</div>



			<div id="main">
