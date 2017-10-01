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

Nom programme: EBDL news

Date creation: 23/11/2012 16:48

Date modif: 10/02/2013 10:30

Version: v1.1 

-->

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>EBDL  •  News</title>

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

    $('#header').load('./inc/_header-dyn.php?time=<?php echo time();?>').fadeIn("fast");

    var auto_refresh = setInterval(

      function (){$('#header').load('./inc/_header-dyn.php?time=<?php echo time();?>').fadeIn("slow");}, 2000);

  </script>

  </div>

  <!-- Début contenu site -->

  <div id="contenu">

    <div id="menu_profil">

     <ul>
     <?php menu('News');?>
     </ul>

    </div>

    <div id="sous_menu_profil">

     <ul>

      <?php list_my_flux($id);?>

     </ul>

    </div>

    

    <!-- lister les infos -->

      <div id="n_ews" style=" display:none;">

      <script type="text/javascript">

	    $('#n_ews').fadeOut(100).load('./inc/_news.php?time=<?php echo time();?>&flux=<?php echo $_GET['flux'];?>').fadeIn(2000);

      </script>

      <table width="100%" height="200" border="0" cellspacing="0" cellpadding="0">

       <tr>

        <td align="center" valign="middle"><img src="tpl/img/loading.gif" width="40" height="40" alt="loading" /></td>

       </tr>

      </table>

      </div>

      

    <div class="clear"></div>



  </div>

    

  <!-- Bas du site -->

  <?php require('inc/_footer.php'); ?>

</div>



</body>

</html>

