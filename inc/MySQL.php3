<?php

//Parametres MySQL

$serveur = "localhost";//Serveur

$login = "root";//Utilisateur

$motdepasse = "";//Mot de passe

$nom_base = "ebdl";//Base de données







//NE PAS TOUCHER

mysql_connect ($serveur,$login,$motdepasse) or die ('<link href="tpl/style.css" rel="stylesheet" type="text/css"><center><br><br><br><img src="tpl/img/logo.jpg"/><br><div class="erreur_vert" style="margin-top:20px;">Connexion au serveur MySQL impossible !</div></center>');

mysql_select_db ($nom_base) or die ('<link href="tpl/style.css" rel="stylesheet" type="text/css"><center><br><br><br><img src="tpl/img/logo.jpg"/><br><div class="erreur_vert" style="margin-top:20px;">Connexion &agrave; la base de donn&eacute;es MySQL impossible !</div></center>');



?>