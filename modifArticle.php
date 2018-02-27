<?php
/**
 * Created by PhpStorm.
 * User: flore
 * Date: 16/02/2018
 * Time: 17:09
 */
session_start();
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<title>MyRep! Modifier une entrée</title>

	<link href="css/bootstrap.css" rel="stylesheet">

	<link href="plugins/summernote/dist/summernote.css" rel="stylesheet">

	<style>
		body {
			height: 100%;
			background-color: #2b78e4;
			color: white;
		}
		html {
			height: 100%;
			width: 100%;
		}
		#content{
			font-family: "arial";
			margin-top: 50px;
			padding-left: 50px;
			padding-right: 50px;
		}
		#home, #icone{
			margin-top: 20px;
			margin-left: 50px;
			margin-right: 50px;
			font-family: "segoe print";
		}
		#user{
			text-align: right;
			color: rgba(255, 255, 255, 0.7);
		}
		#titre, #tagInput{
			/*width: 400px;*/
			height: 30px;
			width: 50%;
			color: black;
			border-radius: 4px;
		}
		.editor {
			width: 75%;
			height: 400px;
		}
		#contenu{
			width: 100%;
		}
		#valid, #annul{
			color: black;
			border-radius: 4px;
			margin-top: 20px;
			box-shadow: 2px 2px 2px black;
		}
		#annul{
			margin-left: 100px;
		}
		#italic{
			font-style: italic;
			margin-left: 20px;
		}
	</style>
</head>
<body>
<div id='home'>
	<a href='index.php'><img src='img/ico/ico9w.png' width='30px'></a> Accueil
	<div id="user">Utilisateur enregistré:
		<?php echo $_COOKIE['pseudo'];?>
	</div>
	<div id="content">
		<form method="POST" action="insertarticleModif.php">
			<p>
				<label for="titre">Titre:</label><br/>
				<input type="text" name="titre" id="titre" value ="xxx" required />
			</p>
			<p>
				Contenu:<br/>
				<textarea name="contenu" id="contenu" class="editor" value ="xxx"></textarea>
			</p>
			<!--<p>
				<label for="tagInput">Tags associés : </label><br/>
				<input type="text" name="tagInput" id="tagInput"/>
				<span id="italic">Séparer les tags par des points virgules ( ; ) sans espace.</span>
			</p>-->
			<input type="submit" id="valid" value="Enregistrer les modifications" />
			<input type="button" id="annul" value="Annuler" onclick='location.href="edit.php"'>
		</form>

	</div>

	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="plugins/summernote/dist/summernote.js"></script>
	<script src="plugins/summernote/dist/lang/summernote-fr-FR.js"></script>
	<script src="js/modifArticle.js"></script>
</body>
</html>

<?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=projet_repertoire;charset=utf8','root','');
}
catch(Exception $e)
{
	die('Erreur : '.$e->getMessage());
}
$req=$bdd->prepare('SELECT titre, contenu FROM rep_cont WHERE id = :id');
$req->execute(array(
	'id'=> $_COOKIE['idArticle']));
$donnees = $req->fetch();
//echo json_encode($donnees);

$req->closeCursor();
?>
<script type="text/javascript">
	//var titreModif = "";
	//var contenuModif = "";
	var tempo = <?php echo json_encode($donnees); ?>;
	console.log(tempo.titre);
	/*for(var i = 0; i < tempo.length; i++){
		var obj=
			{
				titre: tempo[i].titre,
				contenu: tempo[i].contenu,

			}
		titreModif = obj.titre;
		contenuModif = obj.contenu;*/
		document.getElementById("titre").value = tempo.titre;
		document.getElementById("contenu").value = tempo.contenu;

</script>
