<?php
/**
 * Created by PhpStorm.
 * User: flore
 * Date: 13/02/2018
 * Time: 17:50
 */
session_start();

try
{
	$bdd = new PDO('mysql:host=localhost;dbname=projet_repertoire;charset=utf8','root','');
}
catch(Exception $e)
{
	die('Erreur : '.$e->getMessage());
}
//Definition des donnees à inserer
$id_pseudo = $_COOKIE['iduser'];
$id_rep = $_COOKIE['Id_rep'];
$titre_rep = $_COOKIE['titreClick'];
$titre = htmlspecialchars($_POST['titre']);
$contenu = $_POST['contenu'];

// Insertion des données dans la BDD

$req= $bdd->prepare('INSERT INTO rep_cont (id_pseudo, id_rep, titre_rep, titre, contenu, date_creation) VALUES(:id_pseudo, :id_rep, 
:titre_rep, :titre, :contenu, NOW())');
$req->execute(array(
	'id_pseudo' => $id_pseudo,
	'id_rep' =>  $id_rep,
	'titre_rep' => $titre_rep,
	'titre' => $titre,
	'contenu'  => $contenu));
$idRepCont = $bdd->lastInsertId();
$req->closeCursor();

# Gestion des tags

$post_tags = explode(";", htmlspecialchars($_POST['tagInput']));// on sectionne les différents éléments saisis séparés par des ";" // Mon champ s'appelle "tagInput"

foreach($post_tags as $tag) { // pour chaque element tag saisi par l'utilisateur
	if (empty($tag)) { // Si le tag est vide on passe au suivant
		continue;
	}
	$result=array();
	//on recupère les elements de la table "tags" qui correspondent à celui saisi par l'utilisateur
	$req2 = $bdd->query('SELECT * FROM tags WHERE tags.nom = "'. $tag.'"');
	while ($data = $req2->fetch()) {
		$result[] = $data;
	}
	echo json_encode($result);
	$req2->closeCursor();



	if (empty($result)) { // s'il est absent; on l'insere dans la bdd "tags"
		$req3 = $bdd->prepare('INSERT INTO tags(nom) VALUES (:nom)');
		$req3->execute(array(
			'nom' => $tag
		));
		$id_tag = $bdd->lastInsertId();// on stocke la valeur de l'id de la derniere insertion
		$req3->closeCursor();

		// et on insere la correspondance dans la table de liaison
		$req4 = $bdd->prepare('INSERT INTO liaison_cont_tag(id_tag, id_repcont, id_pseudo) VALUES (:id_tag, :id_repcont, :id_pseudo)');
		$req4->execute(array(
			'id_tag' => $id_tag,
			'id_repcont' => $idRepCont,
			'id_pseudo' => $_COOKIE['iduser']
		));
		$req4->closeCursor();


	} else { // si une correspondance est trouvée
		//On recupère l'id du tag correspondant
		$req5=$bdd->query('SELECT id FROM tags WHERE nom = "'.$tag.'"');
		$data2=$req5->fetch();
		var_dump($data2);
		$id = $data2['id'];
		echo $id;
		// et on insere les correspondances dans la table de liaison.
		$req6 = $bdd->prepare('INSERT INTO liaison_cont_tag(id_tag, id_repcont, id_pseudo) VALUES (:id_tag, :id_repcont, :id_pseudo)');
		$req6->execute(array(// on insere juste la correspondance dans la table de liaison
			'id_tag' => $id,
			'id_repcont' => $idRepCont,
			'id_pseudo' =>$_COOKIE['iduser']
		));
		$req6->closeCursor();

	}
	
}

header("Location:edit.php");

