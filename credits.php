<?php
$titrePage = "Crédits";
include('_header.php');
include('_hierarchie.php')
?>

<div id="content">

	<h2>Éléments extérieur :</h2>
	<p>
		Les differents élements provennant d'autres sites sont listés ci-dessous :
	</p>
		<ul>
			<li>Les icônes proviennent du site <a href="http://www.flaticon.com">Flaticon</a> :
				<ul>
					<li>Github : <a href="http://www.flaticon.com/free-icon/github-logo_25231">designed by Dave Gandy</a> from Flaticon.</li>
					<li>Cart, Search, House, Heart, Left Arrow, Right Arrow, Logout : <a href="http://www.flaticon.com/authors/gregor-cresnar">designed by Gregor Cresnar</a> from Flaticon.</li>
					<li>Success, Error : <a href="http://www.flaticon.com/authors/madebyoliver">designed by Madebyoliver</a> from Flaticon.</li>
				</ul>
			</li>
			<li>Police du logo : <a href="http://www.1001fonts.com/gwibble-font.html">Gwibble</a> by vin.</li>
			<li>Police du texte : <a href="https://fonts.google.com/specimen/Open+Sans">Open Sans</a> by Steve Matteson.</li>
			<li>Script javascript du slideshow de la page d'accueil : <a href="http://www.w3schools.com/w3css/w3css_slideshow.asp">w3school.com</a></li>
			<li>Images du slideshow :
				<ul>
					<li><a href="https://pixabay.com/fr/cube-jeu-cube-vitesse-instantanée-568187/">Dés par blickpixel</a></li>
					<li><a href="https://pixabay.com/fr/jouer-en-pierre-coloré-chiffres-1743645/">Jeux en bois par Alexas_Fotos</a></li>
					<li><a href="https://pixabay.com/fr/jeux-jeux-en-bois-bois-jeux-anciens-1423899/">Jeu en bois ancien par NadineDoerle</a></li>
				</ul>
			</li>
			<li>Les déscriptions des jeux proviennent de <a href="https://wikipedia.org">Wikipedia</a>.</li>
		</ul>

	<hr>

	<h2>Reste du site</h2>
	<p>
		Tous les autres élements non listés ci-dessus sont sous licence MIT :
	</p>
	<p lang="en">
		<?php
			// Un simple include du fichier LICENSE ne fonctionne pas, car il faut remplacer les retour à la ligne par des <br/> : utilisation de nl2br()
			$fileLicense = fopen("LICENSE", 'r');
			$contentLicense = fread($fileLicense, filesize("LICENSE"));
			fclose($fileLicense);

			echo nl2br($contentLicense);

		?>

	</p>

</div>

<?php include('_footer.php'); ?>
