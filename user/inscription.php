<?php

$titrePage = "Inscription";
$rootURL = "../";
include($rootURL . '_header.php');
include($rootURL . '_hierarchie.php');


// Si l'utilisateur est déjà connecté
if(isset($_SESSION['userID'])){
	echo '<div id="content">';
	echo '<h1>Vous êtes déjà connecté !</h1><a href="deconnexion.php">Voulez-vous vous déconnecter ?</a>';
	echo '</div>';

} else {

  if(
    isset($_POST['submit']) and
    !empty($_POST['nom']) and
    !empty($_POST['prenom']) and
    !empty($_POST['adresse']) and
    !empty($_POST['codePostal']) and
    !empty($_POST['pays']) and
    !empty($_POST['email']) and
    !empty($_POST['password']) and
    !empty($_POST['passwordRepeat']) and
    $_POST['password'] == $_POST['passwordRepeat'] and
    !filter_var($POST['email'], FILTER_VALIDATE_EMAIL) == false
  ){
    echo "Inscription validée";


  }
  else {

?>

<div id="content">

  <form method="post">

    <fieldset>
      <legend>Informations personnelles :</legend>
      <label for="nom">Nom :</label>
      <input name="nom" id="nom" placeholder="Dupont" value="<?php echo $_POST['nom']; ?>" required/>

      <label for="prenom">Prénom :</label>
      <input name="prenom" id="prenom" placeholder="Jean" value="<?php echo $_POST['prenom']; ?>" required/>

      <label for="adresse">Adresse :</label>
      <input name="adresse" id="adresse" placeholder="51 Avenue des Champs-Élysées" value="<?php echo $_POST['adresse']; ?>" required/>

      <label for="codePostal">Code Postal :</label>
      <input name="codePostal" id="codePostal" placeholder="75008" value="<?php echo $_POST['codePostal']; ?>" required/>

      <label for="pays">Pays :</label>
      <input name="pays" id="pays" placeholder="France" value="<?php echo $_POST['pays']; ?>" required/>
    </fieldset>

    <fieldset>
      <legend>Informations de connexion :</legend>
      <label for="email">Adresse mail :</label>
      <input type="email" name="email" id="email" placeholder="exemple@exemple.com" value="<?php echo $_POST['email']; ?>" required/>

      <label for="password">Mot de passe :</label>
      <input type="password" name="password" id="password" placeholder="*****************" value="<?php echo $_POST['password']; ?>" required/>

      <label for="passwordRepeat">Mot de passe (répétez-le) :</label>
      <input type="password" name="passwordRepeat" id="passwordRepeat" placeholder="*****************" value="<?php echo $_POST['passwordRepeat']; ?>" required/>
    </fieldset>

    <input type="submit" id="submit" name="submit" value="Inscription"/>

  </form>

</div>

<?php
    }
  }
include($rootURL . '_footer.php');
?>
