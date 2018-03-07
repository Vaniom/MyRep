<?php
/**
 * Copyright (c) 2018.
 * Visit me at: https://github.com/Vaniom
 */

/**
 * Created by PhpStorm.
 * User: flore
 * Date: 07/03/2018
 * Time: 16:21
 */

try
{
	$bdd = new PDO('mysql:host=localhost;dbname=projet_repertoire;charset=utf8', 'root', '');
}
catch(Exception $e)
{
	die('Erreur : '.$e->getMessage());
}

$variable1 = (isset($_GET["variable1"])) ? $_GET["variable1"] : NULL;
$variable2 = (isset($_GET["variable2"])) ? $_GET["variable2"] : NULL;


if ($variable1) {
	// Faire quelque chose...
	$req=$bdd->query('UPDATE todolist SET coche="'.$variable2.'" WHERE id="'.$variable1.'"');
	echo $variable1."  => OK";
} else {
	echo "FAIL";
}

?>