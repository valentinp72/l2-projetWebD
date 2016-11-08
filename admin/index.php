<?php

require '_connexionAdminRequise.php';


$rootURL = "../";

$titrePage = "Administration";
include($rootURL . '_header.php');
include($rootURL . '_hierarchie.php');

require $rootURL . '_connexionBDD.php'; // Connexion à la BDD


if(isset($_GET['supprimer_resa']) and is_numeric($_GET['supprimer_resa'])){

  $requete = mysql_query("DELETE FROM VR_grp14_Reservation WHERE ID_Commande = " . $_GET['supprimer_resa'] . "");
  if(!$requete) {
      die('Erreur dans la requête : ' . mysql_error());
  }

  // On réincremente le nombre de jeux dispo
  $requete = mysql_query("UPDATE VR_grp14_Jeux SET nbJeuxDispo = nbJeuxDispo + 1 WHERE ID_Jeu = (SELECT ID_Jeu FROM VR_grp14_Reservation WHERE ID_Commande = " . $_GET['supprimer_resa'].")");

  if(!$requete) {
    die('Erreur dans la requête : ' . mysql_error());
  }

}


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


    <?php

    $requete = mysql_query('SELECT * FROM VR_grp14_Client');
    if(!$requete) {
        die('Erreur dans la requête : ' . mysql_error());
    }
    if (mysql_num_rows($requete) == 0) {
      echo "Aucun client n'est inscrit. :'(";
    }
    else{

      echo "<table class='admin_table'>";
      echo "<tr><th>ID Client</th><th>Nom du client</th><th>Adresse</th><th>Code postal</th><th>Pays</th><th>Supprimer le client ?</th></tr>";


      while($valeur = mysql_fetch_array($requete)){
        echo "<tr>";

        echo "</tr>";
      }

      echo "</table>";
    }


    ?>


  </section>


  <section id="resa">


    <?php

    $requete = mysql_query('SELECT * FROM VR_grp14_Reservation NATURAL JOIN VR_grp14_Client NATURAL JOIN VR_grp14_Jeux');
    if(!$requete) {
        die('Erreur dans la requête : ' . mysql_error());
    }
    if (mysql_num_rows($requete) == 0) {
      echo "Aucune réservation n'est en cours.";
    }
    else{

      echo "<table class='admin_table'>";
      echo "<tr><th>ID Client</th><th>Nom du client</th><th>Jeu à rendre</th><th>Date limite de rendu</th><th>Supprimer le rendu ?</th></tr>";


      while($valeur = mysql_fetch_array($requete)){
        echo "<tr>";
        echo "<td>" . $valeur['ID'] . "</td>";
        echo "<td>" . $valeur['prenom'] . " " . $valeur['nom'] . "</td>";
        echo "<td>" . $valeur['NomJeu'] . "</td>";
        echo "<td>" . date('d/m/Y', strtotime($valeur['date_limite'])) . "</td>";
        echo "<td><a href='?supprimer_resa=" . $valeur['ID_Commande'] . "'>Rendu</a>";
        echo "</tr>";
      }

      echo "</table>";


    }

    ?>


  </section>


  </section>


</div>

<?php include($rootURL . '_footer.php'); ?>
