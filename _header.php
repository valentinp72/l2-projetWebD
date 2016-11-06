<?php
session_start();
?>
<!DOCTYPE html>
<!-- HEADER.PHP, page à appeler par chaque page du site. La variable $title doit être déclarée auparavant -->
<html lang="fr">

	<head>
		<title>Ludothèque | <?php echo $titrePage; if(isset($nomJeu)) echo " : " . $nomJeu ?></title>
		<meta charset="UTF-8">
		<link rel="icon" type="image/x-icon" href="<?php echo $rootURL; ?>media/favicon.ico" />
		<!-- $rootURL represente le lien vers les fichiers header, footer, style, etc. Il n'est utile que pour les sous-répertoires (voir user/login.php par exemple)
		On ne peut pas remplacer par juste '/' car cela représente la racine du serveur info.univ-lemans.fr
		-->
		<link rel="stylesheet" type="text/css" href="<?php echo $rootURL; ?>style.css" media="all" />
		<link rel="stylesheet" type="text/css" href="<?php echo $rootURL; ?>style_jeu.css" media="all" />
		<link rel="stylesheet" type="text/css" href="<?php echo $rootURL; ?>style_catalogue.css" media="all" />
		<link rel="stylesheet" type="text/css" href="<?php echo $rootURL; ?>style_compte.css" media="all" />
		<link rel="stylesheet" type="text/css" href="<?php echo $rootURL; ?>style_panier.css" media="all" />

		<!-- Corrige le zoom sur les mobiles -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

		<!-- Jquery pour le menu et le slideshow -->
		<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.11.1/jquery-ui.min.js"></script>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <script src="<?php echo $rootURL; ?>menu.js"></script>
	</head>

	<body>

		<?php

		$hierarchie = explode("/",$_SERVER["REQUEST_URI"]);
		$nomSansExt = str_replace(".php", "", $hierarchie[count($hierarchie)-1]);

		?>
		<div id="menu-hamburger">
			<div id="titreHamburger"><a href="<?php echo $rootURL; ?>index.php">LudoTEK</a></div>
			<ul>
				<li <?php if($nomSansExt == "catalogue" or $nomSansExt == "jeu") echo "class='active'"; ?>><a href="<?php echo $rootURL; ?>catalogue.php">Catalogue</a></li>
				<?php if(isset($_SESSION['userID'])){ ?>
					<li <?php if($nomSansExt == "compte") echo "class='active'"; ?>><a href="<?php echo $rootURL; ?>user/compte.php">Mon compte</a></li>
				<?php } else { ?>
					<li <?php if($nomSansExt == "connexion") echo "class='active'"; ?>><a href="<?php echo $rootURL; ?>user/connexion.php">Connexion</a></li>
				<?php } ?>


				<li <?php if($nomSansExt == "recherche") echo "class='active'"; ?>><a href="<?php echo $rootURL; ?>recherche.php">Recherhe</a></li>
				<li <?php if($nomSansExt == "panier") echo "class='active'"; ?>><a href="<?php echo $rootURL; ?>panier.php">Panier</a></li>
			</ul>
		</div>

		<!-- Div qui sera affiché une fois le menu ouvert pour qu'il ne soit plus clickable -->
    	<div id="contentLayer"></div>

    	<!-- Conteneur global de la page, utile pour le menu hamburger -->
    	<div id="pageContent">

			<div id="header">

				<div id="titreMenu">
					<a href="<?php echo $rootURL; ?>index.php">LudoTEK</a>
				</div>

				<ul>

					<li <?php if($nomSansExt == "catalogue" or $nomSansExt == "jeu") echo "class='actif'"; ?>><a href="<?php echo $rootURL; ?>catalogue.php">Catalogue</a></li>

					<li class="separator">|</li>


					<?php if(isset($_SESSION['userID'])){ ?>
						<li <?php if($nomSansExt == "compte") echo "class='actif'"; ?>><a href="<?php echo $rootURL; ?>user/compte.php">Mon compte</a></li>
					<?php } else { ?>
						<li <?php if($nomSansExt == "connexion") echo "class='actif'"; ?>><a href="<?php echo $rootURL; ?>user/connexion.php">Connexion</a></li>
					<?php } ?>

					<li class="separator">|</li>

					<li <?php if($nomSansExt == "recherche") echo "class='actif'"; ?>><a href="<?php echo $rootURL; ?>recherche.php" title="Recherche"><span class="flaticon-magnifying-glass"></span></a></li>

					<li <?php if($nomSansExt == "panier") echo "class='actif'"; ?>><a href="<?php echo $rootURL; ?>panier.php" title="Panier"><span class="flaticon-shopping-cart"></span></a></li>

					<?php if(isset($_SESSION['userID'])) {?>
						<li <?php if($nomSansExt == "deconnexion") echo "class='actif'"; ?>><a href="<?php echo $rootURL; ?>user/deconnexion.php" title="Déconnexion"><span class="flaticon-exit"></span></a></li>
					<?php } ?>

				</ul>

			    <div id="hamburger">
			    	<!-- Permet de générer les trois barres de l'hamburger -->
	        		<div></div>
	        		<div></div>
	        		<div></div>
	        	</div>
			</div>



			<div id="main">
				<noscript>
						<h2 class="WARNING">Attention : Javascript n'est pas activé, le site ne fonctionnera pas correctement</h2>
				</noscript>
