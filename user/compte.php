<?php
require '_connexionRequise.php';
$titrePage = "Mon Compte";
$rootURL = "../";
include($rootURL . '_header.php');
include($rootURL . '_hierarchie.php');
?>

<div id="content">

	<input id="tab_infos" name="tab" type="radio" class="selecteur" checked/>
	<label for="tab_infos" class="label_selecteur">Informations</label>

	<input id="tab_profil" name="tab" type="radio" class="selecteur"/>
	<label for="tab_profil" class="label_selecteur">Mon profil</label>

	<input id="tab_resa" name="tab" type="radio" class="selecteur"/>
	<label for="tab_resa" class="label_selecteur">Mes réservations</label>



	<section id="infos">
		<p>Bonjour, voici vos informations.lorem</p>
	</section>

	<section id="profil">
		<p>Ton profil est ici.</p>
	</section>

	<section id="resa">
		<p>Voici tes réservations.</p>
	</section>


</div>

<?php include($rootURL . '_footer.php'); ?>
