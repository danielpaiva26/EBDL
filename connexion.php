<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>

<!-- 

Développeur: Daniel Paiva

Nom programme: EBDL Connexion

Date création: 16/10/2012 13:40

Date modif: 16/10/2012 13:40

Version: v1.0 

-->

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>EBDL  &#8226;  Connexion</title>

<link href="tpl/style.css" rel="stylesheet" type="text/css">

<link rel="icon" type="image/png" href="tpl/favicon.png" />

<!--[if IE]><link rel="shortcut icon" type="image/x-icon" href="tpl/favicon.ico" /><![endif]-->

</head>

<body>

<div id="barre_haut"><!-- Arc en Ciel Haut Site 8px --></div>



<div id="conteneur">

  <!-- Début du header -->

  <?php

  session_start();

  require('inc/_header-simple.php');

  require('inc/MySQL.php3');

  require('inc/functions.php');

  ?>    

  <!-- Début contenu site -->

  <div id="contenu">

      <?php 

	   if(!empty($_POST['identifiant']) && !empty($_POST['password']) && $_POST['identifiant'] != "Pseudo ou Email"){

		   extract($_POST);

		   login(addslashes($identifiant),addslashes($password));

	   }

	  ?>

    <div id="mod_login">

      <form action="#" method="post" enctype="multipart/form-data" name="login">

      <table width="750" height="140" border="0" align="center" cellpadding="0" cellspacing="0">

        <tr>

          <td>&nbsp;</td>

          <td>Connexion</td>

          <td>&nbsp;</td>

          <td>&nbsp;</td>

          <td>&nbsp;</td>

        </tr>

        <tr>

          <td width="15">&nbsp;</td>

          <td align="right"><input name="identifiant" type="text" id="identifiant" value="Pseudo ou Email" onfocus="if (this.value == 'Pseudo ou Email') { this.value = ''; }" onblur="if (this.value == '') { this.value = 'Pseudo ou Email'; }" /></td>

          <td width="60" align="center"><img src="tpl/img/bulles.png" width="40" height="9" alt="bulles" /></td>

          <td align="left"><input name="password" type="password" id="password" value="Mot de passe"  onfocus="if (this.value == 'Mot de passe') { this.value = ''; }" onblur="if (this.value == '') { this.value = 'Mot de passe'; }" /></td>

          <td width="15">&nbsp;</td>

        </tr>

        <tr>

          <td>&nbsp;</td>

          <td>&nbsp;</td>

          <td>&nbsp;</td>

          <td align="right"><input name="login2" type="submit" class="btn" id="login" value=" " /></td>

          <td>&nbsp;</td>

        </tr>

      </table>

      </form>

    </div>

    <div class="clear"></div>

    

    

  </div>

  

  <!-- Bas du site -->

  <?php require('inc/_footer.php'); ?>

</div>



</body>

</html>

