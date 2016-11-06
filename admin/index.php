<?php

require '_connexionAdminRequise.php';


$rootURL = "../";

$titrePage = "Administration";
include($rootURL . '_header.php');
include($rootURL . '_hierarchie.php');

require $rootURL . '_connexionBDD.php'; // Connexion à la BDD


?>

<div id="content">

  <input id="tab_jeux" name="tab" type="radio" class="selecteur" checked/>
	<label for="tab_jeux" class="label_selecteur">Jeux</label>

	<input id="tab_users" name="tab" type="radio" class="selecteur"/>
	<label for="tab_users" class="label_selecteur">Utilisateurs</label>

	<input id="tab_resa" name="tab" type="radio" class="selecteur"/>
	<label for="tab_resa" class="label_selecteur">Réservations</label>

  <section id="tab_jeux_content">

    <a href="ajouter_jeu.php" class="lien_divers">Ajouter un jeu</a>
    <div id="liste_jeux">

    <?php

      $requete = mysql_query('SELECT * FROM VR_grp14_Jeux');
      if(!$requete) {
          die('Erreur dans la requête : ' . mysql_error());
      }
  		while ($valeur = mysql_fetch_array($requete)) {

  			echo "	<div class='jeuCatalogue'>\n		";

  			echo "		<div class='nom_jeu'><a href='modifier_jeu.php?id=" . $valeur['ID_Jeu'] . "'>". $valeur['NomJeu'] . "</a></div>\n		";

  			echo "		<div class='resume'>";
  				echo substr($valeur['descriptionJeu'],0,200);
  				if(strlen($valeur['descriptionJeu']) > 200) echo "... [<a href='modifier_jeu.php?id=".$valeur['ID_Jeu']."'>voir la suite</a>]";
  			echo "</div>";

  			echo "\n		</div>\n";
  		}
    ?>

  </div>

  </section>

  <section id="tab_users_content">
    Liste des utilisateurs


  </section>


  <section id="resa">
    Liste des réservations à venir et en cours


  </section>


  </section>


</div>

<?php include($rootURL . '_footer.php'); ?>
