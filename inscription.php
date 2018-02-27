<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<title>Inscription</title>
	<style>
		body{
			background-color: #2b78e4;
			color: white;
			font-family: "segoe print";
		}
		#felicitation {
			font-size: 20pt;
			text-align: center;
		}
	</style>
</head>
<body>	

<?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=projet_repertoire;charset=utf8', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}


$req = $bdd->query('SELECT pseudo FROM membres WHERE pseudo = "' . $_POST['pseudo'] . '"');
$chkPseudo = $req->fetch();

$req->closeCursor();

$req2 = $bdd->query('SELECT email FROM membres WHERE email = "' . $_POST['mail'] . '"');
$chkMail = $req2->fetch();

$req2->closeCursor();

if(strtolower($_POST['pseudo']) == strtolower($chkPseudo['pseudo']))
{
   echo "Ce nom d'utlisateur est déjà utilisé.<br/><p><a href='form_inscription.php'>Retour au formulaire</a></p>";   
}
elseif (strtolower($_POST['mail']) == strtolower($chkMail['email'])) 
{
	echo "Cette adresse email est déjà utilisée.<br/><p><a href='form_inscription.php'>Retour au formulaire</a></p>";
}
else
{
   // on enregistre
	$req = $bdd->prepare('INSERT INTO membres(pseudo, pass, email, date_inscription) VALUES(:pseudo, :pass, :email, CURDATE())');
$req->execute(array(
    'pseudo' => htmlspecialchars($_POST['pseudo']),
    'pass' => password_hash($_POST['password'], PASSWORD_DEFAULT),
    'email' => htmlspecialchars($_POST['mail'])));
echo "<div id='felicitation'><p>Felicitation!</p><p>Votre inscription a bien été enregistrée!</p><p>Retournez à la <a href='index.php'>page d'accueil</a> pour vous connecter et commencer à utliser myRep!</a></p></div>";
}

$req->closeCursor();

?>
</body>
</html>