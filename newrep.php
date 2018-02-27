<?php
session_start(); // On démarre la session AVANT toute chose
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<title>Nouveau répertoire</title>
			<style>
			label, input {
				margin-top: 5px;
			}
			body {
				background-color: #2b78e4;
				color: white;
				padding-left: 30px;
				font-family: "segoe print";
				padding-left: 50px;
				padding-right: 50px;
				padding-bottom: 20px;
			}
			#home, #icone{
				margin-top: 20px;
				/*margin-left: 50px;
				margin-right: 50px;*/
				font-family: "segoe print";
			}
			#user{
				text-align: right;
				color: rgba(255, 255, 255, 0.7);
			}
			#valid, h2 {
				margin-top: 50px;
			}
			#titreRep {
				width: 300px;
			}
			input {
				border-radius: 4px;
				height: 25px;
			}
		</style>
</head>

<body>
	<div id='home'>
		<a href='index.php'><img src='img/ico/ico9w.png' width='30px'></a> Accueil
		<div id="user">Utilisateur enregistré:
			<?php echo $_COOKIE['pseudo'];?>
		</div>
		<hr>
	</div>
	<h1>1/  Donnons un nom à ce nouveau répertoire : </h1>

		<form method="post" action="insertitre.php">
			<p>
				<input type="text" name="titreRep" id="titreRep" placeholder="Nom du répertoire" minlength="3" maxlength="30" required /><br />
			</p>
			<p>
				<label for="ico"><h2>2/ Associons lui une icone : </h2></label>
				<input type="radio" name="ico" id="ico1" value="ico1"><label for="ico1"><img src="img/ico/ico1.png" width="50px"></label>
				<input type="radio" name="ico" id="ico2" value="ico2"><label for="ico2"><img src="img/ico/ico2.png" width="50px"></label>
				<input type="radio" name="ico" id="ico3" value="ico3"><label for="ico3"><img src="img/ico/ico3.png" width="50px"></label>
				<input type="radio" name="ico" id="ico4" value="ico4"><label for="ico4"><img src="img/ico/ico4.png" width="50px"></label><br/>
				<input type="radio" name="ico" id="ico5" value="ico5"><label for="ico5"><img src="img/ico/ico5.png" width="50px"></label>
				<input type="radio" name="ico" id="ico6" value="ico6"><label for="ico6"><img src="img/ico/ico6.png" width="50px"></label>
				<input type="radio" name="ico" id="ico7" value="ico7"><label for="ico7"><img src="img/ico/ico7.png" width="50px"></label>
				<input type="radio" name="ico" id="ico8" value="ico8"><label for="ico8"><img src="img/ico/ico8.png" width="50px"></label><br/>
				<input type="radio" name="ico" id="ico9" value="ico9"><label for="ico9"><img src="img/ico/ico9.png" width="50px"></label>
				<input type="radio" name="ico" id="ico10" value="ico10"><label for="ico10"><img src="img/ico/ico10.png" width="50px"></label>
				<input type="radio" name="ico" id="ico11" value="ico11"><label for="ico11"><img src="img/ico/ico11.png" width="50px"></label>
				<input type="radio" name="ico" id="ico12" value="ico12"><label for="ico12"><img src="img/ico/ico12.png" width="50px"></label>				
			</p>3/ Valider!
			<input type="submit" id="valid" value="Créer mon nouveau répertoire !">
		</form>
		<!--<div id="home">
			<a href="index.php"><img src="img/ico/ico9w.png" width="30px"></a> Retour à l'accueil
		</div>-->


	<script src=js/jquery.js></script>
	<script src="plugins/jquery-validation/dist/jquery.validate.js"></script>
	<script>
		$(function(){
			$('form').validate();
		});
	</script>
</body>
</html>