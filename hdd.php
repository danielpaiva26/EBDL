<?php session_start();



  require('inc/MySQL.php3');

  require('inc/functions.php');



  //permission



	if(empty($_SESSION['id'])){



		  header('location:index.php');



	}else{



		$id = $_SESSION['id'];



    }

	  

	  //definir la promo

	  if(!empty($_SESSION['id'])){

		  $sql = mysql_query('SELECT id_promo FROM utilisateur WHERE id_user="'.$_SESSION['id'].'"');

		  $data = mysql_fetch_array($sql);

		  if(empty($data['id_promo'])){

			  header('location:settings.php');

		  }

	  }

?>    

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>

<!-- 

Développeur: Daniel Paiva

Nom programme: EBDL HDD

Date modif: 16/11/2012

Version: v1.0 

-->

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>EBDL  •  Stockage en ligne</title>

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

     <?php menu('Cloud');?>

     </ul>

    </div>

    <div id="sous_menu_profil">

     <ul>

      <a href="hdd.php"><li>Mes fichiers</li></a>

      <a href="?files=shared_files"><li>Fichiers partagés avec moi</li></a>

      <a href="?files=shared"><li>Fichiers que je partage</li></a>

      <a href="?action=upload"><li>Charger un fichier</li></a>

    </ul>

    </div>

  <?php 
  //delete fichier
  del_fichier($id,$_GET['file'],$_GET['action'],$_GET['u']);
  	
	// mes fichiers
	if(empty($_GET['files'])and $_GET['action'] != 'upload'){
		list_files($id,$_GET['files']);	
			
	//fichiers partagées avec moi
	}elseif($_GET['files'] == 'shared_files'){
		list_files_share_me($id,$_GET['files']);
		
	//fichiers que je partage
	}elseif($_GET['files'] == 'shared'){
		list_files_shared($id,$_GET['files']);
 	}else{
	if($_GET['action']== 'upload' and $_GET['up']== 'ok'){
	  $dossier = 'cloud/';
	  $extension = strrchr($_FILES['fichier']['name'], '.');

	  $fichier = ''.$dossier.''.$id.''.time().''.$extension.'';

		  if(move_uploaded_file($_FILES['fichier']['tmp_name'], $fichier)){

				mysql_query("INSERT INTO stockage VALUES('','".$_POST['nom_fichier']."','".$fichier."','".$_FILES['fichier']['size']."','".$extension."','".time()."')");

		        $id_con = mysql_insert_id();

				mysql_query("INSERT INTO stocke VALUES('".$id."','".$id_con."','1')");

			  echo '<div class="erreur_vert" style="margin-top:-5px; margin-bottom:10px;">Upload effectué avec succès !</div>';

		  }else{

			  echo 'Echec de l\'upload !';

		  }

	}

?>

<div id="mod_inscription">

<form method="POST" action="hdd.php?action=upload&up=ok" enctype="multipart/form-data">

<table width="100%" border="0" cellspacing="10">

  <tr>

    <td width="35%" align="left">Nom du fichier :</td>

    <td width="65%" align="left">

      <input type="text" name="nom_fichier" id="nom_fichier"style="width:90%;"/>

    </td>

  </tr>

  <tr>

    <td>Choisir un fichier :</td>

    <td width="65%">

    <input name="fichier" type="file" class="set_input"  style="width:90%;"/>

    <input type="hidden" name="MAX_FILE_SIZE" value="5000000" />

    </td>

  </tr>

  <tr>

    <td>&nbsp;</td>

    <td align="right"><input type="submit" name="envoyer" value="Envoyer le fichier"/></td>

  </tr>

</table>

</form>

</div>

<?php

	}

?>    

  </div>

  <!-- Bas du site -->

  <?php require('inc/_footer.php'); ?>

</div>

</body>

</html>



