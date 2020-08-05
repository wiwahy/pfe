<?php
define("SERVEUR", "localhost"); 
define("NOMBASE", "pfe"); 
define("USER", "root"); 
define("MDP", ""); 

$conn = mysqli_connect(SERVEUR, USER, MDP);   /* se connecter à Mysql */ 
if (!$conn) {
	die('Not connected: '.mysql_error());
}
$base = mysqli_select_db($conn, NOMBASE);       /* choisir la base de données */ 
if (!$base) {
	die('Base inaccessible: '.mysql_error());
}
?>