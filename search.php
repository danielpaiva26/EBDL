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
	          $requete = mysql_query("SELECT * FROM Utilisateur WHERE id_user='".$id."'");
	          $data = mysql_fetch_array($requete);
			    if($data['id_user']){
			      $id = addslashes($_GET['user']);
			    }else{
			      $id = $_SESSION['id'];
			    }
		  }
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
Nom programme: EBDL recherche
Date création: 16/02/2012 00:14
Version: v1.0 
-->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>EBDL  &#8226;  Recherche</title>
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
      function (){$('#header').load('./inc/_header-dyn.php?time=<?php echo time();?>').fadeIn("slow");}, 5000);
  </script>
  </div>
  <!-- Début contenu site -->
  <div id="contenu">
    <div id="menu_profil">
     <ul>
     <?php menu('Recherche');?>
     </ul>
    </div>
    <div id="sous_menu_profil">
    </div>
    <form method="POST" action=""> 
      <table width="100%" border="0" cellspacing="7" class="titre_set">
        <tr>
            <td height="40" align="center">Rechercher un membre de la communauté :</td>
        </tr>
        <tr>
            <td align="center"><input name="recherche" type="text" class="set_input" /></td>
        </tr>
        <tr>
          <td align="center"><input type="SUBMIT" class="set_input" value="Rechercher" style="width:100px;" /></td>
        </tr>
        <tr>
          <td align="center">&nbsp;</td>
        </tr>
      </table>
      </form>
     <?php search($_POST['recherche']); ?>
   <div class="clear"></div>
  </div>
  <!-- Bas du site -->
  <?php require('inc/_footer.php'); ?>
</div>
</body>
</html>