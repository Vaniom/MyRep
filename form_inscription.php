<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<title>Inscription sur myRep!</title>
		<style>
			label, input {
				margin-top: 5px;
			}
			body {
				background-color: #2b78e4;
				color: white;
				padding-left: 30px;
				font-family: "segoe print";
			}			
		</style>
	</head>
	<body>
		<h1>Inscription sur myRep!</h1>
		<h2>Crée GRATUITEMENT des tas de répertoires</h2>

		<form action="inscription.php" method="post">
			<p>
				<label for="mail">Adresse mail : </label><br /><input type="email" name="mail" id="mail" required /><br />
			</p>
			<p>
			    <label for="pseudo">Choisis un pseudo (minimum 3 caractères): </label><br /><input type="text" name="pseudo" id="pseudo" minlength="3" maxlength="30" required /><br />
			</p>
			<p>
			    <label for="password">Mot de passe (8 caractères minimum) : </label><br /><input type="password" name="password" id="password" minlength="8" required /><br />
			</p>
			<p>
			    <label for="confirm">Confirme le mot de passe : </label><br /><input type="password" name="confirm" id="confirm" equalTo="#password" required /><br />
			</p>
		    	<input type="submit" value="Valider" id="valid"/>
			</p>
		</form>
		<div id="home">
			<a href="index.php"><img src="img/ico/ico9w.png" width="30px"></a> Retour à l'accueil
		</div>
	</body>
	<script src="js/jquery.js"></script>
	<script src="plugins/jquery-validation/dist/jquery.validate.js"></script>
	<script>
		$(function(){
			$('form').validate();
		});
	</script>
</html>