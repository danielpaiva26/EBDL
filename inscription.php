<?php session_start();



  require('inc/MySQL.php3');

  require('inc/functions.php');

	  

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



Nom programme: EBDL Inscription



Date création: 16/10/2012 13:40



Date modif: 30/12/2012 13:07



Version: v1.1 



-->



<head>



<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />



<title>EBDL  &#8226;  Inscription</title>



<link href="tpl/style.css" rel="stylesheet" type="text/css">



<link rel="icon" type="image/png" href="tpl/favicon.png" />



<!--[if IE]><link rel="shortcut icon" type="image/x-icon" href="tpl/favicon.ico" /><![endif]-->



</head>



<body>



<div id="barre_haut"><!-- Arc en Ciel Haut Site 8px --></div>







<div id="conteneur">



  <!-- Début du header -->



  <?php  require('inc/_header-simple.php');  ?>    



  <!-- Début contenu site -->

  <div id="contenu">



    <div id="mod_inscription">

    <?php extract($_POST); inscription($verif,$cgu,$pseudo,$nom,$prenom,$email,$email2,$password,$password2);?>

      <form action="#" method="post" enctype="multipart/form-data" name="login">



        <table width="750" border="0" align="center" cellpadding="0" cellspacing="20">



          <tr>



            <td width="230">Inscription</td>



            <td width="425">&nbsp;</td>



          </tr>



          <tr>



            <td><input name="pseudo" type="text" id="pseudo" onfocus="if (this.value == 'Pseudo') { this.value = ''; }" onblur="if (this.value == '') { this.value = 'Pseudo'; }" value="<?php if(!empty($pseudo)){echo $pseudo;}else{ echo 'Pseudo';}?>" size="20"  /></td>



            <td>&nbsp;</td>



          </tr>



          <tr>



            <td><input name="nom" type="text" id="nom" onfocus="if (this.value == 'Nom') { this.value = ''; }" onblur="if (this.value == '') { this.value = 'Nom'; }" value="<?php if(!empty($nom)){echo $nom;}else{ echo 'Nom';}?>" size="30"  /></td>



            <td><input name="prenom" type="text" id="prenom" onfocus="if (this.value == 'Prenom') { this.value = ''; }" onblur="if (this.value == '') { this.value = 'Prenom'; }" value="<?php if(!empty($prenom)){echo $prenom;}else{ echo 'Prenom';}?>" size="30"  /></td>



          </tr>



          <tr>



            <td><input name="email" type="text" id="email" onfocus="if (this.value == 'Email') { this.value = ''; }" onblur="if (this.value == '') { this.value = 'Email'; }" value="<?php if(!empty($email)){echo $email;}else{ echo 'Email';}?>" size="30"  /></td>



            <td><input name="email2" type="text" id="email2" onfocus="if (this.value == 'Confirmation email') { this.value = ''; }" onblur="if (this.value == '') { this.value = 'Confirmation email'; }" value="<?php if(!empty($email2)){echo $email2;}else{ echo 'Confirmation email';}?>" size="30"  /></td>



          </tr>



          <tr>



            <td><input name="password" type="text" id="password" onfocus="if (this.value == 'Mot de passe') { this.value = ''; this.form.password.type='password' }" onblur="if (this.value == '') { this.value = 'Mot de passe'; this.form.password.type='text' }" value="Mot de passe" size="30"  /></td>



            <td><input name="password2" type="text" id="password2" onfocus="if (this.value == 'Confirmation du mot de passe') { this.value = ''; this.form.password2.type='password' }" onblur="if (this.value == '') { this.value = 'Confirmation du mot de passe'; this.form.password2.type='text' }" value="Confirmation du mot de passe" size="30"  /></td>



          </tr>



        </table>



        <table width="750" border="0" align="center" cellpadding="0" cellspacing="5">



          <tr>



            <td width="10">&nbsp;</td>



            <td width="20"><input type="checkbox" name="cgu" id="cgu" /><input name="verif" type="hidden" value="ok" /></td>



            <td width="570">J'ai lu et j'accepte les <a href="CGU_ebdl.php" target="_blank" style="color:#FFF;">conditions d'utilisation</a>.</td>



            <td width="125"><input name="envooi" type="submit" class="btn" id="envooi" value=" " /></td>



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



