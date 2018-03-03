<?php
/**
 * Copyright (c) 2018.
 * Visit me at: https://github.com/Vaniom
 */

/**
 * Created by PhpStorm.
 * User: flore
 * Date: 03/03/2018
 * Time: 12:39
 */
session_start();// initialisation de la session

	try //connexion à la bdd
	{
		$bdd = new PDO('mysql:host=localhost;dbname=projet_repertoire;charset=utf8', 'root', '');
	}
	catch(Exception $e)
	{
		die('Erreur : '.$e->getMessage());
	}


if(isset($_COOKIE['pseudo'])){
		$nom = $_COOKIE['pseudo'];
} else {
		$nom = "Utilisateur non enregistré";
}

$destinataire = "florent.p83@gmail.com";
$email = $_POST["email"];
$message = htmlspecialchars($_POST['mess']);
$objet = "Message du formulaire myRep";

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'From:'.$nom.' <'.$email.'>' . "\r\n" .
	'Reply-To:'.$email. "\r\n" .
	'Content-Type: text/plain; charset="utf-8"; DelSp="Yes"; format=flowed '."\r\n" .
	'Content-Disposition: inline'. "\r\n" .
	'Content-Transfer-Encoding: 7bit'." \r\n" .
	'X-Mailer:PHP/'.phpversion();

// envoyer une copie au visiteur
	$cible = $destinataire.';'.$email;

// Remplacement de certains caractères spéciaux
$message = str_replace("&#039;","'",$message);
$message = str_replace("&#8217;","'",$message);
$message = str_replace("&quot;",'"',$message);
$message = str_replace('<br>','',$message);
$message = str_replace('<br />','',$message);
$message = str_replace("&lt;","<",$message);
$message = str_replace("&gt;",">",$message);
$message = str_replace("&amp;","&",$message);

// Envoi du mail
$num_emails = 0;
$tmp = explode(';', $cible);
foreach($tmp as $email_destinataire) {
	mail($email_destinataire, $objet, $message, $headers);
	$num_emails++;
}

	if ($num_emails == 2) {
		echo '<p>message envoyé</p>';
	} else {
		echo '<p>message non envoyé</p>';
	}
/*else
	{
		// une des 3 variables (ou plus) est vide ...
		echo '<p>' . $message_formulaire_invalide . ' <a href="contact.html">Retour au formulaire</a></p>' . "\n";
	}*/
header("Location:index.php");