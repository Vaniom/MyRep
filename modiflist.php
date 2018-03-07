<?php
/**
 * Copyright (c) 2018.
 * Visit me at: https://github.com/Vaniom
 */

/**
 * Created by PhpStorm.
 * User: flore
 * Date: 02/03/2018
 * Time: 19:12
 */
session_start();

try
{
	$bdd = new PDO('mysql:host=localhost;dbname=projet_repertoire;charset=utf8','root','');
}
catch(Exception $e) {
	die('Erreur : ' . $e->getMessage());
}

$item = htmlspecialchars($_POST['item']);
$idListe = $_COOKIE['listId'];
echo $item;
echo $idListe;

if(empty($item)){// Si c'est vide, on ne fait rien et on passe au suivant
} else {//sinon on insere la valeur dans la table
	$req=$bdd->prepare('INSERT INTO todolist (id_liste, contenu, coche) VALUES(:id_liste, :contenu, :coche)');
	$req->execute(array(
		'id_liste' => $idListe,//L'id du titre avait été recupérée lors de l'insertion
		'contenu' => $item,
		'coche' => '0'
	));
}


$req->closeCursor();

header("Location:index.php");