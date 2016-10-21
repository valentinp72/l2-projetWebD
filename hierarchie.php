<div id="hierarchie">
  <ul>
    <li><a href="index.php">LudoTEK</a></li>
  <?php
    $hierarchie = explode("/",$_SERVER["REQUEST_URI"]);

    foreach($hierarchie as $itemHier){

      //Si l'item ne correspond pas au spi, ni au nom du dossier projetWebD
      if(substr($itemHier, 0, 6 ) !== "~spi22" and substr($itemHier, 0, 10 ) !== "projetWebD"){
        //On replace le .php de l'item par rien
        $nomSansExt = str_replace(".php", "", $itemHier);

        if($nomSansExt != "index"){ //Sur la page index, on n'a pas besoin d'afficher l'item

          if($nomSansExt != $itemHier){ //Permet de ne pas afficher le séparateur sur le dernier item de la liste ( == sur le fichier .php)
            echo "<li class='separator'></li>";
          }

          echo "<li><a href='" . $itemHier ."'>";
          echo ucfirst($nomSansExt); //On écrit avec une majuscule pour la première lettre
          echo "</a></li>";
        }
      }

    }

   ?>

 </ul>
</div>
