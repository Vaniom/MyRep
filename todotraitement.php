<?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=projet_repertoire;charset=utf8', 'root', '');
}
catch(Exception $e)
{
	die('Erreur : '.$e->getMessage());
}
//Recupérer les données du formulaire
$titre = htmlspecialchars($_POST['titre']);// On recupère le titre et on l'insere dans la BDD
$req=$bdd->prepare('INSERT INTO liaison_user_todo (id_pseudo, titre_todoliste, date_creation) VALUES (:id_pseudo, :titre_todoliste, NOW())');
$req->execute(array(
	'id_pseudo' => $_COOKIE['iduser'],
	'titre_todoliste' => $titre,
));
$idListe = $bdd->lastInsertId();// On recupère l'id du titre qui vient d'être inséré
$req->closeCursor();

$_GET = array_map('htmlentities', $_POST); // on applique la fonction htmlentities() sur chaque donnée du tableau $_GET
$a = array(); // on itinialise notre tableau de destination
$i = 0; // notre variable qui sera incrémentée dans la boucle
foreach($_POST as $var) { // pour chaque valeur du tableau $_GET on crée une variable $var
$a[$i] = $var; // on met la valeur dans le tableau avec la valeur de $i
$i++; // on incrémente
}
echo print_r($a); // on affiche le tableau (vérification)
echo $titre;

for($i = 1; $i < count($a); $i++){ // On boucle sur chaque valeur du tableau; on commence à 1 car 0 correspond au titre (déjà inséré)
	if(empty($a[$i])){// Si c'est vide, on ne fait rien et on passe au suivant
	} else {//sinon on insere la valeur dans la table
		$req2=$bdd->prepare('INSERT INTO todolist (id_liste, contenu, coche) VALUES(:id_liste, :contenu, :coche)');
		$req2->execute(array(
			'id_liste' => $idListe,//L'id du titre avait été recupérée lors de l'insertion
			'contenu' => $a[$i],
			'coche' => '0'
		));
	}
}

$req2->closeCursor();

header("Location:index.php");