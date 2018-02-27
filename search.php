<?php
session_start();
ini_set("display_errors",0);error_reporting(0);
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<title>Mes repertoires</title>
	<style>
		body {
			height: 100%;
			background-color: #2b78e4;
			color: white;
		}
		html {
			height: 100%;
		}
		#content{
			font-family: "arial";
			margin-top: 50px;
			padding-left: 50px;
			padding-right: 50px;
			padding-top: 30px;
		}
		.date{
			font-style: italic;
			text-align: right;
		}
		.titre{
			text-align: left;
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
		#headTitre {
			text-align: center;
			font-family: "arial";
		}
		.edit {
			text-decoration: none;
			font-style: italic;
		}
		.edit a {
			text-decoration: none;
			margin-left: 50px;
			margin-right: 100px;
			font-size: 10pt;
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
	<h1 id="headTitre"></h1>
</div>
<!--<form method="GET" action ="search.php">
	<div id="recherche">
		<input type="search" id="search" name="q"
			   placeholder="Rechercher">
		<input type="submit" id="go" value="GO!" />
	</div>
</form>-->

<div id="content">
	<form method="POST" action="remove.php">
		<input type="hidden" name="secret" id="secret" value="">
	</form>
</div>
<br />

<?php
/*
 * Created by PhpStorm.
 * User: flore
 * Date: 17/02/2018
 * Time: 18:36
 */

	try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=projet_repertoire;charset=utf8', 'root', '');
	}
	catch(Exception $e)
	{
		die('Erreur : '.$e->getMessage());
	}
	$requete = htmlspecialchars($_GET['q']);
	$req=$bdd->prepare("SELECT * FROM rep_cont WHERE titre LIKE '%$requete%' AND id_rep = :id_rep AND id_pseudo = :id_pseudo ORDER 
BY titre");
	$req->execute(array(
		'id_rep' => $_COOKIE['Id_rep'],
		'id_pseudo' => $_COOKIE['iduser']
	));
while ($donnees = $req->fetch()) {//On créée un tableau qui contient le resultat de la requete
	$result[] = $donnees;
}

$req->closeCursor();
?>
<script type="text/javascript">
	var temp = <?php echo json_encode($result); ?>;
	if (temp === null)
	{
		document.getElementById("headTitre").textContent ='Aucun résultat pour cette recherche';
	}
	else {
		for (var i = 0; i < temp.length; i++) {
			var obj =
				{// Creation d'un nouvel objet
					id: temp[i].id,
					contenu: temp[i].contenu,
					titrerep: temp[i].titre_rep,
					//auteur: temp[i].auteur,
					titre: temp[i].titre,
					date: temp[i].date_creation
				};
			//console.log(temp[0].titre);
			document.getElementById("headTitre").textContent = temp.length + ' résultat(s) pour la recherche : <?php echo
			json_encode($requete);?>';
			var newLigne = document.createElement("div");
			var newTitre = document.createElement("h2");
			var newTitrerep = document.createElement("span");
			var newAuteur = document.createElement("p");
			var newContenu = document.createElement("p");
			var newDate = document.createElement("p");
			var edition = document.createElement("p");
			var modif = document.createElement("a");
			var suppr = document.createElement("a");
			var tag = document.createElement("p");
			var separateur = document.createElement("hr");
			newTitre.textContent = obj.titre;
			//newAuteur.textContent = "Auteur: " + obj.auteur;
			newContenu.innerHTML = obj.contenu;
			newTitrerep.textContent = " dans " + obj.titrerep;
			tag.textContent = "Tags: " + obj.tag;
			newDate.textContent = "Publié le " + obj.date;
			modif.textContent = "Modifier ";
			modif.href = "#";
			suppr.textContent = "Suppression";
			suppr.href = "#";
			newLigne.appendChild(newTitre);
			newLigne.appendChild(newContenu);
			//newLigne.appendChild(newAuteur);
			newLigne.appendChild(tag);
			newDate.appendChild(newTitrerep);
			newLigne.appendChild(newDate);
			edition.appendChild(modif);
			edition.appendChild(suppr);
			newLigne.appendChild(edition);
			newLigne.appendChild(separateur);
			modif.className = obj.id;
			suppr.className = obj.id;
			//newTitre.className = obj.id;
			//newContenu.className = obj.id;
			newTitre.className = "titre";
			newContenu.className = "contenu";
			//newAuteur.className = "auteur";
			newDate.className = "date";
			edition.className = "edit";
			newContenu.style.backgroundColor = "white";
			newContenu.style.color = "black";
			newContenu.style.padding = "10px";
			newContenu.style.border = "1px solid black";
			newContenu.style.borderRadius = "5px";
			suppr.setAttribute("id", "suppr");
			modif.setAttribute("id", "modif");
			newTitre.setAttribute("id", obj.id);
			document.getElementById("content").appendChild(newLigne);

			//Gestion du click sur le bouton "supprimer"
			suppr.addEventListener('click', function () {
				var idSuppr = this.className;
				document.getElementById("secret").val = idSuppr;
				console.log(document.getElementById("secret").val);
				document.cookie = 'idArticle=' + idSuppr;
				if (confirm('Suppimer ?')) {// Popup de demande de confirmation avant suppression
					window.location = "remove.php";
				}
			});
			//Gestion du click sur le bouton "modifier"
			modif.addEventListener('click', function () {
				var idSuppr = this.className;
				document.getElementById("secret").val = idSuppr;
				document.cookie = 'idArticle=' + idSuppr;
				window.location = "modifArticle.php";
			});
			var compte = document.getElementsByClassName("titre");
			console.log(document.getElementById("headTitre").textContent.length);

		}
	}

console.log(temp.length);
</script>
</body>
</html>