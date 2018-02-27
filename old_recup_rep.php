<?php
//Recupération des données de la table "répertoires"


session_start(); // On démarre la session AVANT toute chose
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=projet_repertoire;charset=utf8', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

$req = $bdd->prepare('SELECT pseudo, icone, titre, DATE_FORMAT(date_creation, "%d/%m/%Y") AS date_creation FROM repertoires WHERE pseudo = :pseudo');
$req->execute(array(
    'pseudo' => $_COOKIE['pseudo']));// on recupere les données associées au pseudo contenu dans le cookie
while( $donnees = $req->fetch(PDO::FETCH_ASSOC) ) {//On créée un tableau qui contient le resultat de la requete
	$result[] = $donnees;
}


/*$result = $req->fetch();//v1



$pseudo = $result['pseudo'];
$icone = $result['icone'];
$titre = $result['titre'];
$dateCreation = $result['date_creation'];*/
//echo "$pseudo, $icone, $titre, $dateCreation";
json_encode($result);
print_r($result);
print_r($result[1][pseudo]);

//))
?>