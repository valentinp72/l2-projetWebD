<div id="hierarchie">

<?php
  if(!isset($cacherHierarchie) or $cacherHierarchie == false){

?>
  <ul>
    <li><a href="<?php echo $rootURL; ?>index.php">LudoTEK</a></li>
  <?php
    $hierarchie = explode("/",$_SERVER["REQUEST_URI"]);

    foreach($hierarchie as $itemHier){

      //Si l'item ne correspond pas au spi, ni au nom du dossier projetWebD
      if(substr($itemHier, 0, 6 ) !== "~spi22" and substr($itemHier, 0, 10 ) !== "projetWebD"){
        //On replace le .php de l'item par rien
        $itemArray = explode(".php", $itemHier);
        $nomSansExt = str_replace("_", " ", $itemArray[0]);


        if($nomSansExt != "index" and $nomSansExt != "user" and $nomSansExt != "admin"){ //Sur la page index, on n'a pas besoin d'afficher l'item


          if(substr($itemHier, 0, 7 ) === "jeu.php"){ //Si nous sommes sur la page jeu.php, on affiche manuellement le lien vers le catalogue
            echo "<li class='separator'></li>";
            echo "<li><a href='catalogue.php'>Catalogue</a></li>";
            echo "<li class='separator'></li>";
            echo "<li><a href='" . $itemHier . "'>";
            echo ucfirst($nomJeu); //On écrit avec une majuscule pour la première lettre
            echo "</a></li>";
          }
          else{

            if($nomSansExt != $itemHier){ //Permet de ne pas afficher le séparateur sur le dernier item de la liste ( == sur le fichier .php)
              echo "<li class='separator'></li>";
            }

            echo "<li><a href='" . $itemHier ."'>";
            echo ucfirst($nomSansExt); //On écrit avec une majuscule pour la première lettre
            echo "</a></li>";
          }

        }
        else if($nomSansExt == 'admin'){
          echo "<li class='separator'></li>";
          echo "<li><a href='index.php'>Admin</a></li>";
        }

      }

    }

   ?>

 </ul>

<?php
 }
?>
</div>
