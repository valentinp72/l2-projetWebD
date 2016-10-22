<?php
$titrePage = "Nous contacter";
include('header.php');
include('hierarchie.php')
?>

<div id="content">

	<h1>Nous contacter</h1>

	<?php
	if(!isset($_POST["submit"]) or empty($_POST["mail"]) or empty($_POST["message"]) or !filter_var($_POST["mail"], FILTER_VALIDATE_EMAIL) ){

		if(!empty($_POST['message']) and !filter_var($_POST["mail"], FILTER_VALIDATE_EMAIL) ){
			echo "Votre adresse mail est invalide.";
		}
		else if(isset($_POST["submit"])){
			echo "Vous n'avez pas rempli tous les champs !";
		}
	?>

		<form id="contact" method="post">
			<p>
				<label for="mail">Votre adresse mail : </label>
				<input type="email" id="mail" name="mail" placeholder="Ex : bibi@exemple.com" value="<?php echo $_POST['mail']; ?>" required>
			</p>
			<p>
				<label for="message">Votre message : </label>
				<textarea name="message" id="message" placeholder="Ex: Bonjour, blablabla." rows="10" cols="50" required><?php echo $_POST['message']; ?></textarea>
			</p>
			<p>
				<input type="submit" name="submit" id="submit" value="Envoyer mon message">
			</p>
		</form>

	<?php
		}
		else{

			$destinataire = "valentinpelloin@gmail.com";
			$sujet = "Nouveau mail sur ludoTEK !";
			$headers = "From: " . $_POST["mail"];

			mail($destinataire,$sujet,$_POST["message"],$headers);

			echo "Votre mail a bien été envoyé aux administrateurs !";
		}


	?>

</div>

<?php include('footer.php'); ?>
