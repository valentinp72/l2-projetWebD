<?php

require '_connexionAdminRequise.php';


$rootURL = "../";

require $rootURL . '_connexionBDD.php'; // Connexion à la BDD

// On vérifie que l'id soit valide
if(empty($_GET['id']) or !is_numeric($_GET['id'])){
  die("ID NON VALIDE.");
}



// RECUPERER $VALEUR

if(!isset($_POST['submit'])){


  $ID = $_GET['id'];
  $requete = mysql_query('SELECT * FROM VR_grp14_Jeux WHERE ID_Jeu = "' . $ID . '"');
  if(!$requete) {
      die('Erreur dans la requête : ' . mysql_error());
  }

  $valeur = mysql_fetch_array($requete);

  $_POST['nom_jeu'] = $valeur['NomJeu'];
  $_POST['nb_jeu'] = $valeur['nbJeux'];
  $_POST['nb_jeu_stock'] = $valeur['nbJeuxDispo'];
  $_POST['description_jeu'] = $valeur['descriptionJeu'];
  $_POST['lien_image'] = $valeur['pathImageJeu'];
  $_POST['age_min'] = $valeur['age_min'];
  $_POST['joueurs_min'] = $valeur['joueurs_min'];
  $_POST['joueurs_max'] = $valeur['joueurs_max'];
  $_POST['type_jeu'] = $valeur['type_jeu'];
  $_POST['date_sortie'] = $valeur['date_sortie'];
  $_POST['habilite_physique'] = $valeur['habilite_physique'];
  $_POST['reflexion'] = $valeur['reflexion'];
  $_POST['hasard'] = $valeur['hasard'];
  $_POST['info_c_p'] = $valeur['info_complete_parfaite'];

}
else{

  if( !empty($_POST['nom_jeu']) and
      !empty($_POST['nb_jeu']) and
      !empty($_POST['nb_jeu_stock']) and
      !empty($_POST['description_jeu']) and
      !empty($_POST['lien_image']) and
      !empty($_POST['age_min']) and
      !empty($_POST['joueurs_min']) and
      !empty($_POST['joueurs_max']) and
      !empty($_POST['type_jeu']) and
      !empty($_POST['date_sortie'])){


      $requete = mysql_query("UPDATE VR_grp14_Jeux SET
                                              NomJeu = '" . $_POST['nom_jeu'] . "',
                                              nbJeux = '" . $_POST['nb_jeu'] . "',
                                              nbJeuxDispo = '" . $_POST['nb_jeu_stock'] . "',
                                              descriptionJeu = '" . mysql_real_escape_string($_POST['description_jeu']) . "',
                                              pathImageJeu = '" . $_POST['lien_image'] . "',
                                              age_min = '" . $_POST['age_min'] . "',
                                              joueurs_min = '" . $_POST['joueurs_min'] . "',
                                              joueurs_max = '" . $_POST['joueurs_max'] . "',
                                              type_jeu = '" . $_POST['type_jeu'] . "',
                                              date_sortie = '" . $_POST['date_sortie'] . "',
                                              habilite_physique = '" . $_POST['habilite_physique'] . "',
                                              hasard = '" . $_POST['hasard'] . "',
                                              reflexion = '" . $_POST['reflexion'] . "',
                                              info_complete_parfaite = '" . $_POST['info_c_p'] . "'
                                WHERE ID_Jeu = '" . $ID . "'");

        if(!$requete) {
          die('Erreur dans la requête : ' . mysql_error());
        }
        else{

          header("location: index.php");

        }

  }


}

$titrePage = "Modifier un jeu";
include($rootURL . '_header.php');
include($rootURL . '_hierarchie.php');

?>

<div id="content">


<?php if(isset($_POST['submit'])) echo "Tous les champs n'ont pas été remplis correctement."; ?>
<form method="post">

  <fieldset>
    <label for="nom_jeu">Nom du jeu :</label>
    <input id="nom_jeu" name="nom_jeu" value="<?php echo $_POST['nom_jeu']; ?>" placeholder="Monopoly" />

    <label for="nb_jeu">Nombre de jeux :</label>
    <input id="nb_jeu" type="number" name="nb_jeu" value="<?php echo $_POST['nb_jeu']; ?>" placeholder="4" />

    <label for="nb_jeu_stock">Nombre de jeux en stock :</label>
    <input id="nb_jeu_stock" type="number" name="nb_jeu_stock" value="<?php echo $_POST['nb_jeu_stock']; ?>" placeholder="1" />

    <label for="description_jeu">Description du jeu :</label>
    <textarea id="description_jeu" name="description_jeu" placeholder="Blablabla"><?php echo $_POST['description_jeu']; ?></textarea>

    <label for="lien_image">Nom de l'image correspondant au jeu :</label>
    <input id="lien_image" name="lien_image" value="<?php echo $_POST['lien_image']; ?>" placeholder="patate.png" />

    <label for="age_min">Âge minimal :</label>
    <input id="age_min" type="number" name="age_min" value="<?php echo $_POST['age_min']; ?>" placeholder="5" />

    <label for="joueurs_min">Nombre de joueurs minimal :</label>
    <input id="joueurs_min" type="number" name="joueurs_min" value="<?php echo $_POST['joueurs_min']; ?>" placeholder="1" />

    <label for="joueurs_max">Nombre de joueurs maximal :</label>
    <input id="joueurs_max" type="number" name="joueurs_max" value="<?php echo $_POST['joueurs_max']; ?>" placeholder="4" />

    <label for="type_jeu">Type du jeu :</label>
    <input id="type_jeu" name="type_jeu" value="<?php echo $_POST['type_jeu']; ?>" placeholder="Jeu de société" />

    <label for="datepicker">Date de sortie :</label>
    <input id="datepicker" name="date_sortie" value="<?php echo $_POST['date_sortie']; ?>" placeholder="23/12/2016" />
  </fieldset>

  <fieldset id="check_infos_jeux">

    Habilité physique ?
    <input type="checkbox" name="habilite_physique" value="habilite_physique" <?php if($_POST['habilite_physique'] == 1) echo 'checked="checked"'; ?>><br/>

    Réfléxion ?
    <input type="checkbox" name="reflexion" value="reflexion" <?php if($_POST['reflexion']) echo 'checked="checked"';?>><br/>

    Hasard ?
    <input type="checkbox" name="hasard" value="hasard" <?php if($_POST['hasard']) echo 'checked="checked"';?>><br/>

    Information complete et parfaite ?
    <input type="checkbox" name="info_c_p" value="info_c_p" <?php if($_POST['info_c_p']) echo 'checked="checked"';?>><br/>

  </fieldset>

  <input type="submit" name="submit" id="submit" value="Modifier le jeu"/>
</form>

</div>

<?php include($rootURL . '_footer.php'); ?>
