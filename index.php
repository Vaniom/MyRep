<?php
session_start(); // On démarre la session AVANT toute chose
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<title>myRep!</title>
		<link href="css/bootstrap.css" rel="stylesheet">
		<link href="css/mdb.min.css" rel="stylesheet">
		<link href="css/index.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="plugins/tooltipster/dist/css/tooltipster.bundle.min.css" />
	</head>

	<body>
	<div id="main">
		<nav class="navbar navbar-expand-lg navbar-default navbar-inverse container-fluid">
			<a class="navbar-brand" href="#">myRep!</a>
		    <!--<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
		    aria-label="Toggle navigation">
		    	<span class="navbar-toggler-icon"></span>
		    </button>-->
		    <div class="nav navbar-nav session">
		    	<span id="bienvenue">
		    	<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Bienvenue <span id="cookContent"><?php echo $_COOKIE['pseudo']; ?></span>
		    	</span>
			</div>
		    <div class="collapse navbar-collapse" id="navbarSupportedContent">		    		
				<ul class="nav navbar-nav navbar-right navbarNav">
					
					<li class="anonyme"><a href="form_connexion.php"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Connexion </a></li>
					
					
					<!-- <li class="membre"><a href="#"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Préférences </a></li> /*Bouton desactivé car non utilisé -->
					
					
					<li class="membre"><a href="deconnexion.php"><span class="glyphicon glyphicon-off" aria-hidden="true"></span> Déconnexion </a></li>
								
				</ul>	
			</div>								
		</nav>
		<div class="container">
			<section class="row">
				<div class="col-lg-6 col-sm-12">
					<h1><span id="titre1">Mes répertoires</span></h1>
				</div>
			</section>
			<section id="cont1" class="row">			
				<div class="col-lg-6 col-sm-12">
					<div id="cont">
						
					</div>
					<div class="row">
						<div id="wordCloud" class="col-lg-6 col-sm-12">
						</div>
					</div>

				</div>
			
			
				<div id="cont2" class="col-lg-6 col-sm-12">
					<div id="rep">
						<span id="inscription">
						
						</span>
					</div>
				</div>

			</section>			
		</div>
	</div>

	<div id="test" class="test transform">
		<img id="iconeDivCoul" class="iconeDiv infobulle" src="img/divcoul.png" title="Afficher / Masquer mes listes">
		<div id="testContent">
			<a href = "todo.php"><img src = "img/todo.png" /></a>
			<!--<p>
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi. Proin porttitor, orci nec nonummy molestie, enim est eleifend mi, non fermentum diam nisl sit amet erat. Duis semper. Duis arcu massa, scelerisque vitae, consequat in, pretium a, enim. Pellentesque congue. Ut in risus volutpat libero pharetra tempor. Cras vestibulum bibendum augue. Praesent egestas leo in pede. Praesent blandit odio eu enim. Pellentesque sed dui ut augue blandit sodales. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aliquam nibh. Mauris ac mauris sed pede pellentesque fermentum. Maecenas adipiscing ante non diam sodales hendrerit.
				Ut velit mauris, egestas sed, gravida nec, ornare ut, mi. Aenean ut orci vel massa suscipit pulvinar. Nulla sollicitudin. Fusce varius, ligula non tempus aliquam, nunc turpis ullamcorper nibh, in tempus sapien eros vitae ligula. Pellentesque rhoncus nunc et augue. Integer id felis. Curabitur aliquet pellentesque diam. Integer quis metus vitae elit lobortis egestas. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Morbi vel erat non mauris convallis vehicula. Nulla et sapien. Integer tortor tellus, aliquam faucibus, convallis id, congue eu, quam. Mauris ullamcorper felis vitae erat. Proin feugiat, augue non elementum posuere, metus purus iaculis lectus, et tristique ligula justo vitae magna.
				Aliquam convallis sollicitudin purus. Praesent aliquam, enim at fermentum mollis, ligula massa adipiscing nisl, ac euismod nibh nisl eu lectus. Fusce vulputate sem at sapien. Vivamus leo. Aliquam euismod libero eu enim. Nulla nec felis sed leo placerat imperdiet. Aenean suscipit nulla in justo. Suspendisse cursus rutrum augue. Nulla tincidunt tincidunt mi. Curabitur iaculis, lorem vel rhoncus faucibus, felis magna fermentum augue, et ultricies lacus lorem varius purus. Curabitur eu amet.
			</p>
			<p>
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi. Proin porttitor, orci nec nonummy molestie, enim est eleifend mi, non fermentum diam nisl sit amet erat. Duis semper. Duis arcu massa, scelerisque vitae, consequat in, pretium a, enim. Pellentesque congue. Ut in risus volutpat libero pharetra tempor. Cras vestibulum bibendum augue. Praesent egestas leo in pede. Praesent blandit odio eu enim. Pellentesque sed dui ut augue blandit sodales. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aliquam nibh. Mauris ac mauris sed pede pellentesque fermentum. Maecenas adipiscing ante non diam sodales hendrerit.
				Ut velit mauris, egestas sed, gravida nec, ornare ut, mi. Aenean ut orci vel massa suscipit pulvinar. Nulla sollicitudin. Fusce varius, ligula non tempus aliquam, nunc turpis ullamcorper nibh, in tempus sapien eros vitae ligula. Pellentesque rhoncus nunc et augue. Integer id felis. Curabitur aliquet pellentesque diam. Integer quis metus vitae elit lobortis egestas. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Morbi vel erat non mauris convallis vehicula. Nulla et sapien. Integer tortor tellus, aliquam faucibus, convallis id, congue eu, quam. Mauris ullamcorper felis vitae erat. Proin feugiat, augue non elementum posuere, metus purus iaculis lectus, et tristique ligula justo vitae magna.
				Aliquam convallis sollicitudin purus. Praesent aliquam, enim at fermentum mollis, ligula massa adipiscing nisl, ac euismod nibh nisl eu lectus. Fusce vulputate sem at sapien. Vivamus leo. Aliquam euismod libero eu enim. Nulla nec felis sed leo placerat imperdiet. Aenean suscipit nulla in justo. Suspendisse cursus rutrum augue. Nulla tincidunt tincidunt mi. Curabitur iaculis, lorem vel rhoncus faucibus, felis magna fermentum augue, et ultricies lacus lorem varius purus. Curabitur eu amet.
			</p>-->

		</div>
	</div>
	
		<footer class="footer">
			<div class="container">
        		<div class="row">
            		<div class="col-lg-12">
                	<span id="foot">©2018-Florent Pianet</span>
            		</div>
        		</div>
   			</div>
		</footer>
		
<!-- !!!!!!!!!!!!!!! Recupération des données de la table "répertoires"!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->
		<?php

		if(isset($_COOKIE['pseudo'])){ // si un cookie est présent
	try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=projet_repertoire;charset=utf8', 'root', '');
	}
	catch(Exception $e)
	{
	        die('Erreur : '.$e->getMessage());
	}

	$req = $bdd->prepare('SELECT ID, pseudo, icone, titre, DATE_FORMAT(date_creation, "%d/%m/%Y") AS date_creation FROM repertoires WHERE pseudo
 = :pseudo');
	$req->execute(array(
	    'pseudo' => $_COOKIE['pseudo']));// on recupere les données associées au pseudo contenu dans le cookie
	while( $donnees = $req->fetch(PDO::FETCH_ASSOC) ) {//On créée un tableau qui contient le resultat de la requete
		$result[] = $donnees;	
	}

$req->closeCursor();
?>

<script type="text/javascript">
	// ------------Afficher la liste des repertoires de l'utilisateur----------------

	var tab=<?php echo json_encode($result); ?> ; // Astuce pour recupérer les données du tableau php (!)	
	for (var i = 0; i < tab.length; i++){
		//console.log(tab);
		//document.getElementById("tab").textContent = tab;
		var obj = 
		{// Creation d'un nouvel objet
			id: tab[i].ID,
			auteur: tab[i].pseudo,
			icone: tab[i].icone,
			titre: tab[i].titre,
			date: tab[i].date_creation
		};

		//Mise en forme et insertion dans la page
		var newLigne = document.createElement("p");
		var newIcone = document.createElement("img");
		var newTitre = document.createElement("a");
		var newDate = document.createElement("span");
		newTitre.textContent = obj.titre;
		newTitre.href = "#" + obj.titre;
		newTitre.setAttribute("id", obj.id);
		newTitre.className = "repTitre";
		newDate.textContent = "créé le " + obj.date;
		newDate.className = "repDate";
		newIcone.src = "img/ico/" + obj.icone + ".png";
		newIcone.className = "repIcone";
		newLigne.appendChild(newIcone);
		newLigne.appendChild(newTitre);
		newLigne.appendChild(newDate);
		newLigne.className = "repLigne";
		document.getElementById("rep").appendChild(newLigne);
	};

</script>
		<?php
		//------------Recupération des Tags---------------

		$req2=$bdd->prepare('
			SELECT DISTINCT t.nom AS nom					
			FROM tags AS t, liaison_cont_tag AS l
			WHERE t.id = l.id_tag
			AND l.id_pseudo = :id_pseudo');
		$req2->execute(array(
			'id_pseudo' => $_COOKIE['iduser']
		));
		$res=array();
		while ($data = $req2->fetch()) {
			$res[] = $data;
		}
		//var_dump($res);

		?>
			<script type="text/javascript">
				// ------------Mise en forme des tags----------------

				var tabl=<?php echo json_encode($res); ?> ;
				console.log('var tabl = ' + tabl.length);
				var newArray = [];

				if(tabl.length > 0) {

					for (var i = 0; i < tabl.length; i++) {
						var objet =
							{// Creation d'un nouvel objet
								word: tabl[i].nom,
								weight: Math.round(Math.random() * (71 - 0.5) + 10)
							};
						newArray.push(objet);
					}
				} else {
					var objet =
						{
							word: "NoTag",
							weight: "80"
						};
					newArray.push(objet);
				}
					//console.log(objet);
					localStorage.setItem('objet', JSON.stringify(newArray));



			</script>
<?php
}
else{};// si pas de cookie => on ne fait rien !

		//------------------------traitement des listes todolist--------------------------------------------------
		$req3=$bdd->query('SELECT t.id_liste AS idliste,
										l.titre_todoliste as titreliste,
										t.contenu AS contenu,
										DATE_FORMAT(l.date_creation, "%d/%m/%Y") AS date_creation 
										FROM todolist AS t,
										liaison_user_todo AS l									
										WHERE l.id_pseudo = "'.$_COOKIE['iduser'].'"
										AND t.id_liste = l.id																								
										');
		$res3 = array();
		while ($donnees3 = $req3->fetch()){
			$res3[] = $donnees3;
		}
		var_dump($res3);
?>
	<script>
		var tabl3 = <?php echo json_encode($res3);?>;

		console.log(tabl3);

		for (var i = 0; i < tabl3.length; i++) {
		 	var obj = {
		 		id: tabl3[i].idliste,
				titre: tabl3[i].titreliste,
				contenu: tabl3[i].contenuliste,
				date: tabl3[i].date_creation
			};
		 	//alert(obj.titre);
			var liste = document.createElement('div');
			var titre = document.createElement('h1');
			var balise = document.createElement('ul');
			var contenu = document.createElement('li');
			var date = document.createElement('p');
			var cond = titre.textContent;
			console.log(cond);

			//if (document.getElementById(obj.id) == null) {

			 titre.textContent = obj.titre;
			 contenu.textContent = obj.contenu;
			 date.textContent = obj.date;
			 liste.setAttribute('id', "b"+ obj.id);
			 liste.appendChild(titre);
			 balise.appendChild(contenu)
			 liste.appendChild(balise);
			 liste.appendChild(date);
			 liste.appendChild(document.createElement('hr'));
			 document.getElementById('testContent').appendChild(liste);
			 //} else {
				contenu = document.createElement('li');
				contenu.textContent = obj.contenu;
				balise.appendChild(contenu);
			//}
			var cond = document.getElementById("b" + obj.id);
			console.log(cond.html);
		 }

	</script>



		<script src="js/jquery.js"></script>	
		<script src="js/popper.min.js"></script>
		<script src="js/mdb.js"></script>		 
		<script src="js/bootstrap.js"></script>
		<script src="js/index.js"></script>
		<script src="plugins/js.cookie.js"></script>
		<script type="text/javascript" id="cookiebanner" src="plugins/cookiebanner.min.js"></script>
		<script type="text/javascript" src="plugins/tooltipster/dist/js/tooltipster.bundle.min.js"></script>
		<script src="plugins/Word Cloud/js/lib/jQWCloudv3.1.js"></script>
	</body>
</html>