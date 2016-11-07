<?php
session_start();

function get_nb_produits_panier(){
	$total=0;
	for($i = 0; $i < count($_SESSION['panier']['produit']); $i++)
	{
		 $total += $_SESSION['panier']['qteProduit'][$i];
	}
	return $total;

}


if(!isset($_SESSION['panier'])){
	$_SESSION['panier'] = array();
	$_SESSION['panier']['produit'] = array();
	$_SESSION['panier']['id'] = array();
	$_SESSION['panier']['qteProduit'] = array();
}

$titrePage = "Panier";
include('_header.php');
include('_hierarchie.php');
require '_connexionBDD.php';

?>

<div id="content">

	<?php


	// Si on demande de vider le panier
	if(isset($_GET['vider'])){
		$_SESSION['panier'] = array();
		$_SESSION['panier']['produit'] = array();
		$_SESSION['panier']['id'] = array();
		$_SESSION['panier']['qteProduit'] = array();
	}

	if(isset($_GET['supprimer'])){
		$sup = $_GET['supprimer'];
		// On vérifie que l'item que l'on souhaite supprimer soit dans l'array
		if(in_array($sup, $_SESSION['panier']['id'])){

			// On cherche sa position
			$pos = array_search($sup, $_SESSION['panier']['id']);

			//On vérifie qu'il y a plus d'un item à supprimer
			if($_SESSION['panier']['qteProduit'][$pos] > 1){
				$_SESSION['panier']['qteProduit'][$pos]--;
			}
			else{
				// Sinon, on supprimer la ligne des arrays
				unset($_SESSION['panier']['qteProduit'][$pos]);
				unset($_SESSION['panier']['id'][$pos]);
				unset($_SESSION['panier']['produit'][$pos]);

			}

		}
	}

		if(isset($_GET['ajouter'])){

			// L'id du jeu à ajouter doit être un nombre
			if(is_numeric($_GET['ajouter'])){

				// Le panier ne doit pas contenir plus de 3 articles
				if(get_nb_produits_panier() >= 3){
					echo "<h3>Le produit demandé n'a pas pu être ajouter au panier : votre panier contient déjà 3 produits.</h3>";
				}
				else{

					$id = mysql_real_escape_string($_GET['ajouter']);
					//Si le produit que l'on veut ajouter est déjà dans le panier, on change sa quantité
					if(in_array($id,$_SESSION['panier']['id'])){
						$indexPanier = array_search($id, $_SESSION['panier']['id']);
						$qteProduit = $_SESSION['panier']['qteProduit'][$indexPanier];
						$requete = mysql_query('SELECT * FROM VR_grp14_Jeux
																		WHERE ID_Jeu = '.$id
																		.' AND nbJeuxDispo > '.$qteProduit);
						$valeur = mysql_fetch_array($requete);
						if (!empty($valeur)) {
							$_SESSION['panier']['qteProduit'][$indexPanier]++;
						}
						else echo "Il n'y a que ".$qteProduit." item de disponible !!";
					}
					else{
						$requete = mysql_query('SELECT * FROM VR_grp14_Jeux WHERE ID_Jeu = "' . $id . '"');
						if(!$requete) {
								die('Erreur dans la requête : ' . mysql_error());
						}

						$valeur = mysql_fetch_array($requete);

						// L'id est présent dans la liste des jeux
						if(!empty($valeur)){

							// Le jeu doit être en stock
							if($valeur["nbJeuxDispo"] > 0 and date("Y-m-d") > $valeur['date_sortie']){

								// On ajoute le jeu à l'array
								array_push($_SESSION['panier']['produit'], $valeur['NomJeu']);
								array_push($_SESSION['panier']['id'], $valeur['ID_Jeu']);
								array_push($_SESSION['panier']['qteProduit'], "1");
							}
							else{
								echo "<h3>Le jeu demandé n'est plus en stock.</h3>";
							}
						}
					}

				}

			}
		}

		if(empty($_SESSION['panier']['produit'])){
			echo "Votre panier est vide.";
		}
		else{
			echo "<p><a class='modif_panier' href='?vider'>Vider le panier</a></p>";

			echo "<table id='panier'>\n\n";
			echo "<tr><th>Produit</th><th>Quantité</th><th></th></tr>\n";
			foreach ($_SESSION['panier']['produit'] as $id => $libelle) {
				echo "\n<tr>\n";
				echo "<td>" . $_SESSION['panier']['produit'][$id] . "</td>\n";
				echo "<td>" . $_SESSION['panier']['qteProduit'][$id] . "</td>\n";
				echo "<td><a class='modif_panier' href='?supprimer=" . $_SESSION['panier']['id'][$id] . "'>-</a><a class='modif_panier' href='?ajouter=" . $_SESSION['panier']['id'][$id] . "'>+</a></td>\n";
				echo "</tr>\n";
			}
			echo "\n\n</table>";
			echo '<div id="reserver_div"><a href="reserver.php" id="reserver">Réserver</a></div>';
		}

	?>


</div>

<?php include('_footer.php'); ?>

