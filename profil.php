<?php session_start();

  require('inc/MySQL.php3');

  require('inc/functions.php');

  //permission

	if(empty($_SESSION['id'])){

		  header('location:index.php');
	}else{

		  if(empty($_GET['user'])){

			  $id = $_SESSION['id'];

		  }else{

			  $id = addslashes($_GET['user']);

	          $requete = mysql_query("SELECT * FROM utilisateur WHERE id_user='".$id."'");

	          $data = mysql_fetch_array($requete);

			  

			    if($data['id_user']){

			      $id = addslashes($_GET['user']);

			    }else{

			      $id = $_SESSION['id'];

			    }

				

		  }

	  }
      //demande d'amitié
	  add_friend($_SESSION['id'],$_GET['user'],$_GET['action']);
	  
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

Nom programme: EBDL Profil

Date creation: 23/11/2012 16:48

Date modif: 05/02/2012 13:48

Version: v0.5 

-->

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>EBDL  &#8226;  Profil</title>

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
     <?php menu('Profil');?>
     </ul>

    </div>

    <div id="sous_menu_profil">

     <ul>

      <a href="profil.php"><li>Mon Profil</li></a>

      <?php if($id == $_SESSION['id']){ echo '<a href="settings.php"><li>Modifier mes infos</li></a>';}?>
      <?php if(!verif_ami($id,$_SESSION['id'],'1') and !verif_ami($id,$_SESSION['id'],'0') and $id != $_SESSION['id']){ echo '<a href="profil.php?user='.$_GET['user'].'&action=add_friend"><li>Ajouter a mes amis</li></a>';}?>
      
     </ul>

    </div>
    <?php 
	if(!empty($_SESSION['id']) and !empty($id) and verif_ami($_SESSION['id'],$id,'0')==$id){
		echo '<div class="erreur_vert" style="margin-top:0px; margin-bottom:20px;"><a href="profil.php?user='.$id.'&action=accept_friend">Accepter sa demande d\'amitié</a> | <a href="profil.php?user='.$id.'&action=reject_friend">Refuser sa demande d\'amitié</a></div>';
	}
	?>
    <div id="profil">

      <div id="avatar"><img src="<?php info_user($id,'avatar');?>" width="77" height="88" alt="avatar" /></div>

      <div id="infos">

       <table width="100%" border="0" cellspacing="0" cellpadding="0">

        <tr>

         <td><h1><?php info_user($id,'Nom');?> <?php info_user($id,'Prenom');?></h1></td>

        </tr>


        <tr>

         <td><?php info_user($id,'adresse');?></td>

        </tr>
        <tr>

         <td><?php info_user($id,'code_postal');?> <?php info_user($id,'ville');?></td>

        </tr>
        <tr>

         <td><?php info_user($id,'Mail');?> | <?php info_user($id,'Telephone');?></td>

        </tr>
       </table> 

      </div>

      <div class="clear"></div>

      <div id="ma_promo">Ma promotion  //  <?php promotion($id);?></div>

      <div id="mes_interets">Mes loisirs //  <?php info_user($id,'loisirs');?></div>

    </div>

    <!-- Module rss -->

    <div id="rss">

      <div id="titre_rss">Flux RSS</div>

      <div id="n_ews" style="opacity:1;">

      <script type="text/javascript">

	    $('#n_ews').fadeOut(1).load('./inc/_news.php?time=<?php echo time();?>&flux=<?php echo $_GET['flux'];?>&state=ok&id=<?php echo $id;?>').fadeIn(2000);

      </script>

      <table width="100%" border="0">

       <tr>

        <td align="center" valign="middle" height="100"><img src="tpl/img/loading.gif" width="30" height="30" alt="loading" /></td>

       </tr>

      </table>

      </div>

    </div>

    

    <div class="clear"></div>

  </div>

    

  <!-- Bas du site -->

  <?php require('inc/_footer.php'); ?>

</div>



</body>

</html>

