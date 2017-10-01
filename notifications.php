<?php session_start();

  require('inc/MySQL.php3');
  require('inc/functions.php');

  //permission

	if(empty($_SESSION['id'])){

		  header('location:index.php');

	}else{

		$id = $_SESSION['id'];

    }

?>    
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>

<!-- 

Développeur: Daniel Paiva

Nom programme: EBDL Notifications

Date modif: 16/11/2012

Version: v1.0 

-->

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>EBDL  •  Notifications</title>

<link href="tpl/style.css" rel="stylesheet" type="text/css">

<link rel="icon" type="image/png" href="tpl/favicon.png" />

<script src="inc/jquery-latest.js"></script>

<!--[if IE]><link rel="shortcut icon" type="image/x-icon" href="tpl/favicon.ico" /><![endif]-->

</head>

<body> 

<div id="barre_haut"><!-- Arc en Ciel Haut Site 8px --></div>



<div id="conteneur">

  <!-- Début du header -->
  <div id="header">

  <script type="text/javascript">

    $('#header').load('./inc/_header-dyn.php?time=<?php echo time();?>').fadeIn("slow");

    var auto_refresh = setInterval(

      function (){$('#header').load('./inc/_header-dyn.php?time=<?php echo time();?>').fadeIn("slow");}, 6000);

  </script>

  </div>

  <!-- Début contenu site -->

  <div id="contenu">

    <div id="menu_profil">

     <ul>
     <?php menu('NC');?>
     </ul>

    </div>

    <div id="sous_menu_profil">

     <ul>

    </ul>

    </div>
    <div class="titre_set">:: Notifications</div>
    <?php afficher_notifications($id);?>
    
  </div>

    

  <!-- Bas du site -->

  <?php require('inc/_footer.php'); ?>

</div>



</body>

</html>

