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

  require $rootURL . '_connexionBDD.php'; // Connexion à la BDD


  // Requête pour vérifier que l'adresse mail n'est pas déjà prise dans la BBD

  $emailPost = mysql_real_escape_string($_POST['email']);    // On empêche quelques injections SQL
  $requete = mysql_query('SELECT ID FROM Clients WHERE email = "'. $emailPost .'"');
  if(!$requete) die('Erreur dans la requête : ' . mysql_error());
  $requeteID = mysql_fetch_array($requete);

  // On vérifie que tous les champs sont remplis, corrects et cohérents
  if(
    // TOUS LES CHAMPS SONT REMPLIS
    isset($_POST['submit']) and
    !empty($_POST['nom']) and
    !empty($_POST['prenom']) and
    !empty($_POST['adresse']) and
    !empty($_POST['codePostal']) and
    !empty($_POST['ville']) and
    !empty($_POST['pays']) and
    !empty($_POST['email']) and
    !empty($_POST['password']) and
    !empty($_POST['passwordRepeat']) and

    $_POST['password'] == $_POST['passwordRepeat'] and     // Les deux mots de passe sont indentiques
    filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) and // L'adresse mail est valide
    empty($requeteID) and                                  // L'adresse mail n'est pas déjà utilisée
    is_numeric($_POST['codePostal'])                       // Le code postal est composé de chiffres uniquement
  ){


    // Si toutes les informations entrées sont correctes, on procède à l'inscription de l'utilisateur

    // On se protège de quelques injections SQL
    $nomPost = mysql_real_escape_string($_POST['nom']);
    $prenomPost = mysql_real_escape_string($_POST['prenom']);
    $adressePost = mysql_real_escape_string($_POST['adresse']);
    $codePostalPost = mysql_real_escape_string($_POST['codePostal']);
    $villePost = mysql_real_escape_string($_POST['ville']);
    $paysPost = mysql_real_escape_string($_POST['pays']);

    // On hash le mot de passe pour ne pas l'enregistrer en clair dans la BDD
    $passwordPost = password_hash($_POST['password'], PASSWORD_DEFAULT);


    // On effectue la requête
    $requete = mysql_query("INSERT INTO Clients (nom,
                                                 prenom,
                                                 email,
                                                 motDePasse,
                                                 adresse,
                                                 codePostal,
                                                 ville,
                                                 pays)
                                         VALUES ('".$nomPost."',
                                                '".$prenomPost."',
                                                '".$emailPost."',
                                                '".$passwordPost."',
                                                '".$adressePost."',
                                                '".$codePostalPost."',
                                                '".$villePost."',
                                                '".$paysPost."')");

    if(!$requete) {
      die('Erreur dans la requête : ' . mysql_error());
    }
    else{
      echo "<div id='content'>";
      echo "Votre inscription a bien été finalisée. Vous pouvez maintenant vous <a href='connexion.php'>connecter</a>.";
      echo "</div>";
    }

  }
  else {

?>

<div id="content">

  <form method="post">
    <?php

      if(isset($_POST['submit'])){
        echo "<legend><h2>Vous n'avez pas rempli tous les champs correctement.</h2></legend>\n";
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
          echo "<legend><h2>Votre adresse mail n'est pas valide.</h2></legend>\n";
        }
        if($_POST['password'] != $_POST['passwordRepeat']){
          echo "<legend><h2>Les mots de passe ne correspondent pas.</h2></legend>\n";
        }
        if(!empty($requeteID)){
          echo "<legend><h2>Cette adresse mail est déjà utilisée.</h2></legend>";
        }
        if(!is_numeric($_POST['codePostal'])){
          echo "<legend><h2>Le code postal entré n'est pas valide (uniquement des chiffres).</h2></legend>";
        }
      }

    ?>
    <fieldset>
      <legend>Informations personnelles :</legend>
      <label for="nom">Nom :</label>
      <input name="nom" id="nom" placeholder="Dupont" value="<?php echo $_POST['nom']; ?>" required/>

      <label for="prenom">Prénom :</label>
      <input name="prenom" id="prenom" placeholder="Jean" value="<?php echo $_POST['prenom']; ?>" required/>

      <label for="adresse">Adresse :</label>
      <input name="adresse" id="adresse" placeholder="51 Avenue des Champs-Élysées" value="<?php echo $_POST['adresse']; ?>" required/>

      <label for="ville">Ville :</label>
      <input name="ville" id="ville" placeholder="Paris" value="<?php echo $_POST['ville']; ?>" required/>

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
