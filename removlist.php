<?php
/**
 * Copyright (c) 2018.
 * Visit me at: https://github.com/Vaniom
 */

/**
 * Created by PhpStorm.
 * User: flore
 * Date: 02/03/2018
 * Time: 13:45
 */

session_start();

try
{
	$bdd = new PDO('mysql:host=localhost;dbname=projet_repertoire;charset=utf8','root','');
}
catch(Exception $e) {
	die('Erreur : ' . $e->getMessage());
}

//recupération de l'id de la liste à supprimer (contenue dans le cookie)
$idListe = $_COOKIE['listId'];

$req=$bdd->query('DELETE FROM todolist WHERE todolist.id_liste = "'.$idListe.'"');
$req->closeCursor();

$req2=$bdd->query('DELETE FROM liaison_user_todo WHERE id = "'.$idListe.'"');
$req2->closeCursor();
header("Location:index.php");