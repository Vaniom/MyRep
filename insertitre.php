<?php
session_start(); // On démarre la session AVANT toute chose
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=projet_repertoire;charset=utf8', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
//Recuperation de l'ID du membre
$req = $bdd->prepare('SELECT id FROM membres WHERE pseudo = :pseudo');
$req->execute(array(
    'pseudo' => $_COOKIE['pseudo']));

$result = $req->fetch();
//echo $result['id'];

//definition des données
$idMembre = $result['id'];
$pseudo = $_COOKIE['pseudo'];
$titreRep = htmlspecialchars($_POST['titreRep']);
$ico = $_POST['ico'];

$req->closeCursor();

//insertion dans la bdd "repertoires"
$req2 = $bdd->prepare('INSERT INTO repertoires(id_membre, pseudo, icone, titre, date_creation) VALUES(:id_membre, :pseudo, :icone, :titre, CURDATE())');
$req2->execute(array(
	'id_membre' => $idMembre,
    'pseudo' => $pseudo,
    'icone' => $ico,
    'titre' => $titreRep));

$req2->closeCursor();
header("Location:index.php");

?>