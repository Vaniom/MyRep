<?php
/**
 * Created by PhpStorm.
 * User: flore
 * Date: 21/02/2018
 * Time: 14:31
 */
session_start();
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<title>ToDo List</title>
	<style>
		body, html {
			background-color: #2b78e4;
			color: white;
			font-family: "segoe print";
			margin-left: 30px;
			height:100%;
			min height:100%;
		}
		#home{
			margin-top: 20px;
			margin-left: 50px;
			margin-right: 50px;
			font-family: "segoe print";
		}
		#user{
			text-align: right;
			color: rgba(255, 255, 255, 0.7);
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
<form method="POST" action="todotraitement.php">
	<label for="titre">Nom de la liste : </label><br/>
	<input type="text" name="titre" id="titre" placeholder="titre" autofocus required/><br/>
	<input type="text" class="compte" name="todo1" id="todo1" placeholder="Ajouter une entrée à ma liste" required /><br/>
	<div id="content">

	</div>
	<!--<input type="hidden" id="hidden" name="hidden" />-->
	<input type="button" name="add" id="add" value="Ajouter un item" /><br/>
	<input type="submit" id="valid" value="Enregistrer">
	<div id="preview">

	</div>
</form>
	<script src="js/jquery.js"></script>
	<script>
		$(function(){
			$('#add').click(function(){//Ajout d'un input à chaque clique sur le bouton
				var newItem = $('#content').append('<input type="text" class="compte" id="temp" placeholder="Ajouter une entrée à ma liste" autofocus /><br/>');
				var compte = $('.compte').length;
				$('#hidden').attr('value', compte);
				var id = "todo"+ compte;
				$('#temp').attr('name',id);// definition du "name"
			//	alert($('#hidden').val());
				$('#temp').attr('id', id);// definition de l'id
				$('#ok').attr('class', id);
				/*$('.id').click(function(){
					$('#preview').append('<input type="')
				})*/
			});

		})
	</script>
</body>
</html>
