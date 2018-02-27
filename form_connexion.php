<?php
session_start();// initialisation de la session
ini_set("display_errors",0);error_reporting(0);// desactivation de l'affichage des erreurs (pour eviter d'afficher un "pass: is undefined")

//Si un cookie est présent

if(isset($_COOKIE['pseudo']) AND ($_COOKIE['pass'])){
	try //connexion à la bdd
	{
		$bdd = new PDO('mysql:host=localhost;dbname=projet_repertoire;charset=utf8', 'root', '');
	}
	catch(Exception $e)
	{
        die('Erreur : '.$e->getMessage());
	}
	//On recupère les données
	$pseudo = ($_COOKIE['pseudo']);
	$pass = $_COOKIE['pass'];
	$req = $bdd->prepare('SELECT * FROM membres WHERE pseudo = :pseudo/* AND pass = :pass*/');
	$req->execute(array(
    'pseudo' => $pseudo));

	$resultat = $req->fetch();
	$req->closeCursor();

	$hache = $resultat['pass'];

	if ($pass == $hache)// et on compare les mots de passe avec une simple égalité
	{
	    session_start();// Si l'egalité est vérifiée, on demarre la session
	    $_SESSION['id'] = $resultat['id'];
	    $_SESSION['pseudo'] = $pseudo;
	    $_SESSION['pass'] = password_hash($pass, PASSWORD_DEFAULT);
	    header("Location:index.php");
	}
	else //sinon on ne fait rien
	{
		
	}
}
else
{
	//On ne fait rien
}
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<title>Connexion</title>
	<style>
	body {
		background-color: #2b78e4;
		color: white;
		font-family: "segoe print";
		margin-left: 30px;
		height:100%;
		min height:100%;
	}
	</style>
</head>

<body>
	<h1>Connexion sur myRep!</h1>
	<form action="connexion.php" method="post">
		<p>
			<label for="pseudo">Pseudo : </label><br />
			<input type="text" name="pseudo" id="pseudo" value = "<?php if(ISSET($_COOKIE['pseudo'])){echo $_COOKIE['pseudo'];}?>" required /><br />
		</p>
		<p>
		<label for="pass">Mot de passe : </label><br />
		<input type="password" name="pass" id="pass" value = "<?php if(ISSET($_COOKIE['pass'])){echo $_COOKIE['pass'];}?>" required /><br />
		</p>
		<p>
		<input type="checkbox" name="remember" id="remember" value="<?php if(ISSET($_COOKIE['username'])){echo 'checked';}?>" /><label for="remember">Se souvenir de moi</label><br />
		</p>
		<p>
		<input type="submit" value="Valider" id="valid" />
		</p>
	</form>
	<p>
		<div id="home">
			<a href="index.php"><img src="img/ico/ico9w.png" width="30px"></a> Retour à l'accueil
		</div>
	</p>

<script src="js/jquery.js"></script>

</body>
</html>