<?php

try
{
	$bdd = new PDO('mysql:host=localhost;dbname=projet_repertoire;charset=utf8', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
//
$pass_hache = password_hash($_POST['pass'], PASSWORD_DEFAULT);
$pseudo = ($_POST['pseudo']);
$pass = $_POST['pass'];

// Vérification des identifiants
$req = $bdd->prepare('SELECT * FROM membres WHERE pseudo = :pseudo');
$req->execute(array(
    'pseudo' => $pseudo));

$resultat = $req->fetch();

$hache = $resultat['pass'];


if (password_verify($pass, $hache))
{
    session_start();
    $_SESSION['id'] = $resultat['id'];
    $_SESSION['pseudo'] = $pseudo;
    $_SESSION['pass'] = password_hash($pass, PASSWORD_DEFAULT);
    setcookie("pseudo", $pseudo, time() + 365 * 24 *60 *60, null, null, false, true);
    setcookie("pass", "", time() + 30 * 24 * 60 *60, null, null, false, true);
    setcookie("iduser", $resultat['id'], time() + 365 * 24 * 60 * 60, null, null, false, true);

    //gestion de l'option "remember me" en ecrivant un cookie

    			if(isset($_POST['remember'])){
				setcookie("pseudo", $pseudo, time() + 365 * 24 * 60 * 60, null, null, false, true);
				setcookie("pass", $hache, time() + 365 * 24 * 60 * 60, null, null, false, true);
			}else{
				if(ISSET($_COOKIE['pseudo'])){
					setcookie("pseudo", $pseudo, time() + 24 * 60 * 60, null, null, false, true);
				}
				if(ISSET($_COOKIE['pass'])){
					setcookie("pass", "");
				}
			}

    //echo "<br/>Bienvenue"; echo $pseudo; echo "!<br/>Retour à <a href='index.php'>l'accueil</a>";
	header("Location:index.php");
}
else
{
    echo "Le login ou le mot de passe sont incorrects :(<br/><div id='home'>
			<a href='index.php'><img src='img/ico/ico9w.png' width='30px'></a> Retour à l'accueil
		</div>";
}
$req->closeCursor();
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<title>Connexion</title>
	<style>
		body{
			background-color: #2b78e4;
			color: white;
			font-family: "segoe print";
		}
		#bienvenue {
			font-size: 20pt;
			text-align: center;
		}
	</style>
</head>
<body>	

</body>
</html>