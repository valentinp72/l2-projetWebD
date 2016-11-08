<?php

require '_connexionRequise.php';

$rootURL = "../";

// Le panier ne doit pas être vide
if(empty($_SESSION['panier']['produit'])){
  header('location: ../panier.php');
}


$titrePage = "Réservation";
include($rootURL . '_header.php');
include($rootURL . '_hierarchie.php');
require $rootURL . '_connexionBDD.php';

$requete = mysql_query('SELECT * FROM VR_grp14_Reservation WHERE ID = "'. $_SESSION['userID'] .'"');
if(!$requete) {
    die('Erreur dans la requête : ' . mysql_error());
}
if (mysql_num_rows($requete) >= 3) {
  echo "<div id='content'>Vous avez déjà des commandes en cours !</div>";
}
else {

?>

<div id="content">

	<h2>Réservation</h2>

  <?php
    if(mysql_num_rows($requete) != 0) echo "Attention, vous avez dejà des commandes en cours.";
  ?>

  <h3>Créneau de réservation</h3>

  <?php

  $date = mktime(0, 0, 0, date("m")+1, date("d"), date("Y")); // ajouter 1 jour



  foreach ($_SESSION['panier']['id'] as $id => $libelle) {
    for($i = 1 ; $i <= $_SESSION['panier']['qteProduit'][$id] ; $i++){


      // On décremente le nombre de jeux dispo
      $requete = mysql_query("UPDATE VR_grp14_Jeux SET nbJeuxDispo = nbJeuxDispo - 1 WHERE ID_Jeu = '".$libelle."'");

	    if(!$requete) {
	      die('Erreur dans la requête : ' . mysql_error());
	    }


      // On effectue la requête pour ajouter l'item dans la table
      $requete = mysql_query("INSERT INTO VR_grp14_Reservation (ID, ID_Jeu, date_limite) VALUES ('".$_SESSION['userID']."', '".$libelle."', '".date('Y-m-d',$date)."')");

      if(!$requete) {
        die('Erreur dans la requête : ' . mysql_error());
      }

    }
  }

  //On vide le panier

  $_SESSION['panier'] = array();
  $_SESSION['panier']['produit'] = array();
  $_SESSION['panier']['id'] = array();
  $_SESSION['panier']['qteProduit'] = array();

  echo "Vous pouvez dès à présent venir chercher vos jeux, ils seront à rendre le " . date('d/m/Y',$date) . ".";


  ?>

  <h3>Vos informations</h3>

  <?php

  $requete = mysql_query('SELECT * FROM VR_grp14_Client WHERE ID = "'. $_SESSION['userID'] .'"');
	if(!$requete) {
	    die('Erreur dans la requête : ' . mysql_error());
	}
	if (mysql_num_rows($requete) == 0) {
		die("Erreur.");
	}

	$valeur = mysql_fetch_array($requete);

  echo $valeur['nom'] . " " . $valeur['prenom'] . "<br/>";
  echo $valeur['adresse'] . "<br/>";
  echo $valeur['codePostal'] . "<br/>";
  echo $valeur['ville'] . "<br/>";
  echo $valeur['pays'] . "<br/>";
  echo $valeur['mail'] . "<br/>";


  ?>

</div>

<?php

}

include($rootURL . '_footer.php');

?>
