<?php

require '../_connexionBDD.php';


$resultat = mysql_query('SELECT * FROM Clients');

if (!$resultat) {
    die('Requête invalide : ' . mysql_error());
}


while ($row = mysql_fetch_array($resultat)) {
    echo $row["ID"];
}



 ?>
