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

Nom programme: EBDL Amis

Date creation: 06/02/2013

Date modif: 16/11/2012

Version: v1.0 

-->

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>EBDL  •  Amis</title>

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
     <?php menu('Amis');?>
     </ul>

    </div>

    <div id="sous_menu_profil">

     <ul>

      <a href="?tri=A"><li>A</li></a>

      <a href="?tri=B"><li>B</li></a>

      <a href="?tri=C"><li>C</li></a>

      <a href="?tri=D"><li>D</li></a>

      <a href="?tri=E"><li>E</li></a>

      <a href="?tri=F"><li>F</li></a>

      <a href="?tri=G"><li>G</li></a>

      <a href="?tri=H"><li>H</li></a>

      <a href="?tri=I"><li>I</li></a>

      <a href="?tri=J"><li>J</li></a>

      <a href="?tri=K"><li>K</li></a>

      <a href="?tri=L"><li>L</li></a>

      <a href="?tri=M"><li>M</li></a>

      <a href="?tri=N"><li>N</li></a>

      <a href="?tri=O"><li>O</li></a>

      <a href="?tri=P"><li>P</li></a>

      <a href="?tri=Q"><li>Q</li></a>

      <a href="?tri=R"><li>R</li></a>

      <a href="?tri=S"><li>S</li></a>

      <a href="?tri=T"><li>T</li></a>

      <a href="?tri=U"><li>U</li></a>

      <a href="?tri=V"><li>V</li></a>

      <a href="?tri=X"><li>X</li></a>

      <a href="?tri=Y"><li>Y</li></a>

      <a href="?tri=Z"><li>Z</li></a>

      <a href="?tri=ALL"><li>A - Z</li></a>

     </ul>

    </div>

    <div class="titre_set">:: Mes Amis</div>

    <?php amis_page($id,$_GET['tri']); ?>

    <div class="clear"><!-- clear --></div>

  <!-- Bas du site -->

  <?php require('inc/_footer.php'); ?>

</div>

</div>

</body>

</html>

