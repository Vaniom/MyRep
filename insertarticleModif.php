<?php
/**
 * Created by PhpStorm.
 * User: flore
 * Date: 16/02/2018
 * Time: 18:21
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
$titre = htmlspecialchars($_POST['titre']);
$contenu = $_POST['contenu'];

//Mise à jour de la table
$req=$bdd->prepare('UPDATE rep_cont SET titre = :titre, contenu = :contenu WHERE id = :id');
$req->execute(array(
	'titre' => $titre,
	'contenu' => $contenu,
	'id' => $_COOKIE['idArticle']));
$req->closeCursor();
header("Location:edit.php");
?>