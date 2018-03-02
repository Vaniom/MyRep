<?php
session_start();
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
	#headTitre{
		text-align: center;
		font-family: "arial";
	}
	#iconeNewEntree {
		width: 100px;
	}
	#icone{
		position: fixed;
		bottom: 300px;
		right: -100px;
		opacity: 0.9;

	}
	#icone:hover{/* definition de l'animation au survol de la souris */
		-webkit-animation-name: test;/*Safari 4.0 - 8.0*/
		-webkit-animation-duration: 3s;/* Safari 4.0 - 8.0 */
		animation-name: test;
		animation-duration: 3s;
	}
	/* Safari 4.0 - 8.0 */
	@-webkit-keyframes test {
		0%  {bottom: 300px; right: -100px; opacity: 0.9;}
		100%{bottom: 300px; right: 0px; opacity:  1;}
	}
	/*Syntaxe standard */
	@keyframes test{
		0%  {bottom: 300px; right: -100px; opacity: 0.9;}
		100%{bottom: 300px; right: 0px; opacity:  1;}
	}
	.edit{
		text-decoration: none;
		font-style: italic;		
	}
	.edit a{
		text-decoration: none;
		margin-left: 50px;
		margin-right: 100px;
		font-size: 10pt;
	}
	#search{
		height: 30px;
		width: 250px;
		border: 1px solid black;
		border-radius: 10px;
	}
	#go{
		margin-left:  10px;
		height: 30px;
		border-radius: 10px;
		box-shadow: 2px 2px 2px black;
	}
	#recherche{
		position: absolute;
		right: 60px;
		top: 200px;
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
		<h1 id="headTitre">Répertoire : <?php echo $_COOKIE['titreClick'];?></h1>
	</div>
	<form method="GET" action ="search.php">
		<div id="recherche">
			<input type="search" id="search" name="q"
				   placeholder="Rechercher">
			<input type="submit" id="go" value="GO!" />
		</div>
		<div id="resultatsRecherche">

		</div>

	</form>
	<div id="content">
		<form method="POST" action="remove.php">
		<input type="hidden" name="secret" id="secret" value="">
		</form>
	</div>
	<div id="icone">
	<a href="write.php"><img id="iconeNewEntree" src="img/New_repertoire.png" title="Ajouter une nouvelle entrée"></a><!--<span id="textBouton">Ajouter une entrée</span>-->
	</div>
<script>var arraytag = [];</script>
<?php
	try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=projet_repertoire;charset=utf8', 'root', '');
	}
	catch(Exception $e)
	{
	        die('Erreur : '.$e->getMessage());
	}

	$req = $bdd->query('
	SELECT rep_cont.id AS idcont, 
	rep_cont.titre_rep AS titrerep, 
	rep_cont.titre AS titre, 
	rep_cont.contenu AS contenu, 
	membres.pseudo AS auteur,
	DATE_FORMAT(rep_cont.date_creation, "%d/%m/%Y à %H:%i") AS date_creation 
	FROM rep_cont, membres
	WHERE rep_cont.id_pseudo = membres.id 
	AND rep_cont.titre_rep = "' . $_COOKIE['titreClick'] . '" 
	ORDER BY date_creation DESC');

	while ($donnees = $req->fetch()) {//On créée un tableau qui contient le resultat de la requete
		$result[] = $donnees;	
	}
	
$req->closeCursor();

if(!empty($result)) {
	foreach ($result as $valeur) {

		$req2 = $bdd->query('SELECT t.nom AS nom,
					l.id_repcont AS id_repcont
					FROM tags AS t, 
					liaison_cont_tag AS l
					WHERE t.id = l.id_tag
					AND l.id_repcont = "' . $valeur['idcont'] . '"');
		$result2 = array();
		while ($donnees2 = $req2->fetch()) {
			$result2[] = $donnees2;
		}

		?>
		<script>
			var temp2 = <?php echo json_encode($result2);?>;
			//console.log("temp2 = " + temp2);
			for (var i = 0; i < temp2.length; i++) {
				var obj2 =
					{// Creation d'un nouvel objet
						nom: temp2[i].nom,
						idrepcont: temp2[i].id_repcont
					};
				arraytag.push(obj2);
			}
		</script>
		<?php
	}
	$req2->closeCursor();
} else {};


?>
<script>


	var temp = <?php echo json_encode($result); ?>;


		for (var i = 0; i < temp.length; i++){
			var obj =
			{// Creation d'un nouvel objet
				id: temp[i].idcont,
				contenu: temp[i].contenu,
				titrerep: temp[i].titrerep,
				auteur: temp[i].auteur,
				titre: temp[i].titre,
				date: temp[i].date_creation
			};
			var newLigne = document.createElement("div");
			var newTitre = document.createElement("h2");
			var newTitrerep = document.createElement("span");
			var newAuteur = document.createElement("p");
			var newContenu = document.createElement("p");
			var tag = document.createElement("p");
			var newDate = document.createElement("p");
			var edition = document.createElement("p");
			var modif = document.createElement("a");
			var suppr = document.createElement("a");
			var separateur = document.createElement("hr");
			newTitre.textContent = obj.titre;
			newAuteur.textContent = "Auteur: " + obj.auteur;
			newContenu.innerHTML= obj.contenu;
			newTitrerep.textContent = " dans " + obj.titrerep;
			newDate.textContent = "Publié le " + obj.date;
			tag.textContent = "Tags : ";
			modif.textContent = "Modifier ";
			modif.href = "#";
			suppr.textContent = "Suppression";
			suppr.href = "#";
			newLigne.appendChild(newTitre);
			newLigne.appendChild(newContenu);
			newLigne.appendChild(newAuteur);
			newLigne.appendChild(tag);
			newDate.appendChild(newTitrerep);
			newLigne.appendChild(newDate);
			edition.appendChild(modif);
			edition.appendChild(suppr);
			newLigne.appendChild(edition);
			newLigne.appendChild(separateur);
			modif.className = obj.id;
			suppr.className = obj.id;
			newTitre.className = "titre";
			newContenu.className = "contenu";
			newAuteur.className = "auteur";
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


			//Gestion du clic sur le bouton "supprimer"
			suppr.addEventListener('click', function(){
				var idSuppr = this.className;
				document.getElementById("secret").val = idSuppr;
				console.log(document.getElementById("secret").val);
				document.cookie = 'idArticle='  + idSuppr;
				if (confirm('Suppimer ?')){// Popup de demande de confirmation avant suppression
					window.location = "remove.php";
				}
			});

			//Gestion du clic sur le bouton "modifier"
			modif.addEventListener('click', function(){
				var idSuppr = this.className;
				document.getElementById("secret").val = idSuppr;
				document.cookie = 'idArticle=' + idSuppr;
				window.location = "modifArticle.php";
			});
			//----------Recupération et insertion des tags---------------------
		/*	for(var i = 0; i < arraytag.length; i++){
				if (arraytag.idrepcont === obj.id) {
					obj.tag =  " ok ";
					console.log(arraytag.nom);

				} else { obj.tag = " ko "; i++};
				var newInput = document.createElement("span");
				newInput.textContent = obj.tag;
				tag.appendChild(newInput);
			};*/
		}



</script>
</body>
</html>