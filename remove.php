<?php
/**
 * Created by PhpStorm.
 * User: flore
 * Date: 14/02/2018
 * Time: 21:09
 */
session_start();

try
{
	$bdd = new PDO('mysql:host=localhost;dbname=projet_repertoire;charset=utf8','root','');
}
catch(Exception $e) {
	die('Erreur : ' . $e->getMessage());
}


// Suppression des tags associés
//Attention: ne pas supprimer les tags de la table "tags" car ils peuvent etre encore associés à un autre article


$req4=$bdd->prepare('DELETE FROM liaison_cont_tag WHERE id_repcont = :id_repcont');
$req4->execute(array(
	'id_repcont' => $_COOKIE['idArticle']
));
$req4->closeCursor();

// Suppression de l'article
$req=$bdd->prepare('DELETE FROM rep_cont WHERE id = :id');
$req->execute(array(
	'id' => $_COOKIE['idArticle']
));
$req->closeCursor();

/* verification de tous les tags: ceux qui ne sont plus associés doivent être supprimés*/
$req5=$bdd->query('DELETE FROM tags USING tags LEFT JOIN liaison_cont_tag ON (liaison_cont_tag.id_tag = tags.id) WHERE liaison_cont_tag
.id_tag IS NULL');
$req5->closeCursor();
header("Location:edit.php");
