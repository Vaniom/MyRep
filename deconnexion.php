<?php
session_start();
session_destroy();
setcookie("pseudo", "");
setcookie("pass", "");
setcookie("iduser", "");
setcookie("titreClick", "");
setcookie("cookiebanner-accepted", "", 0, "/", null, false, true);
header("Location:index.php");
?>