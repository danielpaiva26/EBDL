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

Nom programme: EBDL Messagerie

Date creation : 11/11/2012

Date modif: 1/12/2012

Version: v1.0

-->

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>EBDL  •  Messagerie</title>

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
     <?php menu('Messagerie');?>
     </ul>

    </div>

    <div id="sous_menu_profil">

     <ul>

      <a href="?section=inbox"><li>Boîte de réception</li></a>

      <a href="?section=new"><li>Nouveau message</li></a>

     </ul>

    </div>

    <!-- Messages -->

    <?php if($_GET['section']=="new"){ ?>

    <div id="titre_mp">:: Nouveau message</div>

    <?php

	if($_GET['send'] == 'true'){

		$destinataire = $_POST['destinataire'];

		$objet = addslashes($_POST['objet']);

		$msg = addslashes($_POST['message']);

		if(!empty($msg) and $msg!="Votre message ici" and $objet!="Objet du message" and !empty($id) and !empty($destinataire) and !empty($objet)){

	    newmsg($id,$destinataire,$objet,$msg);

   	    echo '<div class="erreur_vert" style="margin-top:10px;">Message envoyée!</div>';

		}else{

			echo '<div class="erreur_rouge" style="margin-top:5px;">Erreur veuillez remplir tous les champs.</div><br><br>';

		}



	}

	?>

    <div id="mod_newMSG">

    <form action="?section=new&amp;send=true" method="post" enctype="multipart/form-data" name="NewMSG">

        <table width="750" border="0" align="center" cellpadding="0" cellspacing="20">

           <tr>

            <td>

                <select name="destinataire">

                  <option value=" " selected="selected"> </option>

                  <?php amis_dropdown($id); ?>

                </select>

            </td>

          </tr>

          <tr>

            <td><input name="objet" type="text" id="objet" onfocus="if (this.value == 'Objet du message') { this.value = ''; }" onblur="if (this.value == '') { this.value = 'Objet du message'; }" value="Objet du message" size="30"  /></td>

          </tr>

          <tr>

            <td>

            <textarea name="message" rows="5" id="message" onfocus="if (this.value == 'Votre message ici') { this.value = ''; }" onblur="if (this.value == '') { this.value = 'Votre message ici'; }">Votre message ici</textarea></td>

          </tr>

          <tr>

            <td align="right"><input name="envooi" type="submit" class="btn" id="envooi" value=" " /></td>

          </tr>

        </table>

    </form>

    </div>

    <?php 

	}elseif($_GET['section']=="msg"){ 

	affconversation($_GET['id'],$id,$_GET['tri']);

	

	echo "<br />";

    

	if($_GET['send'] == 'true'){

		$msg = addslashes($_POST['message']);

		if(!empty($msg) and $msg!="Votre message ici" and !empty($_GET['id'])){

	      repmsg($id,$msg,$_GET['id']);

		}else{

			echo '<div class="erreur_rouge" style="margin-top:-10px;">Erreur veuillez remplir tous les champs.</div><br><br>';

		}

	}

    //delete conversation

	$id_conversation = addslashes($_GET['id']);

	$status = addslashes($_GET['status']);

	 

	if(!empty($_GET['id']) and $_GET['action'] == "del" and $_GET['section'] == "msg" and !empty($status)){

	if(!empty($status) and $status!="1"){

		    del_conversation($id,$id_conversation,$status);

			

	}else{

			echo '<br><div class="erreur_rouge" style="margin-top:-10px;">Voulez-vous vraiment supprimer cette conversation? <a href="?section=msg&action=del&id='.$_GET['id'].'&status=2#mod_newMSG">OUI</a> | <a href="?section=msg&id='.$_GET['id'].'#mod_newMSG">NON</a></div><br><br>';

	}

	

	}

	?>

    <div id="mod_newMSG"> 

    <form action="?section=msg&send=true&tri=<?php echo $_GET['tri'];?>&id=<?php echo $_GET['id'];?>#mod_newMSG" method="post" enctype="multipart/form-data" name="NewMSG">

        <table width="750" border="0" align="center" cellpadding="0" cellspacing="20">

          <tr>

            <td>

            <textarea name="message" rows="3" id="message" onfocus="if (this.value == 'Votre message ici') { this.value = ''; }" onblur="if (this.value == '') { this.value = 'Votre message ici'; }">Votre message ici</textarea></td>

          </tr>

          <tr>

            <td align="right"><input name="envooi" type="submit" class="btn_reply" id="envooi" value=" " /></td>

          </tr>

        </table>

    </form>

    </div>

    <?php 

	}else{ 

	?>

    <div id="titre_mp">:: Boîte de réception</div>

    <?php 

	inbox_aff($id);

	}

	?>

    <div class="clear"></div>

  </div>

    

  <!-- Bas du site -->

  <?php require('inc/_footer.php'); ?>

</div>



</body>

</html>

