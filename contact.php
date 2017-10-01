<?php session_start();
  require('inc/MySQL.php3');
  require('inc/functions.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<!-- 
Développeur: Loic Manet
Nom programme: EBDL Contact
Date creation: 16/10/2012 13:40
Date modif: 19/02/2013 13:07
Version: v1.1 
-->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>EBDL  &#8226;  Contact</title>
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
	<table width="750" border="0" align="center" cellpadding="0" cellspacing="20">
		<tr>
			<td><p>Contact<br/></p></td>
		</tr>
		<tr>
			<td><p>Si vous rencontrez des difficultés pour vous inscrire, vous connectez, ou tout autres problèmes<br/>
			vous pouvez nous contacter en remplissant le formulaire et en décrivant votre problème.</p></td>
		</tr>
     </table>
     <?php
	 extract($_POST);
	 if(!empty($objet) and !empty($requete) and !empty($email)){
 	 echo '<center><div class="erreur_vert" style="margin-top:20px; width:80%;">Message envoyé :)</div></center>';
     $to = 'contact@ebdl.local';
     $headers = 'From: '.$email.'' . "\r\n" .
     'Reply-To: '.$email.'' . "\r\n" .
     'X-Mailer: PHP/' . phpversion();

     mail($to, $objet, $requete, $headers);
	 }
	 ?>
      <form action="#" method="post" enctype="multipart/form-data" name="login">
        <table width="750" border="0" align="center" cellpadding="0" cellspacing="20">
          <tr>
            <td>
            <input name="nom" type="text" id="nom" onfocus="if (this.value == 'Nom') { this.value = ''; }" onblur="if (this.value == '') { this.value = 'Nom'; }" value="Nom" style="width:95%;"/>
            </td>
            <td align="right">
            <input name="prenom" type="text" id="prenom" onfocus="if (this.value == 'Prenom') { this.value = ''; }" onblur="if (this.value == '') { this.value = 'Prenom'; }" value="Prenom" style="width:95%;"/>
            </td>
          </tr>
          <tr>
            <td>
            <input name="email" type="text" id="email" onfocus="if (this.value == 'Email') { this.value = ''; }" onblur="if (this.value == '') { this.value = 'Email'; }" value="Email" style="width:95%;"/>
            </td>
			<td align="right">
            <input name="objet" type="text" id="objet" onfocus="if (this.value == 'Objet') { this.value = ''; }" onblur="if (this.value == '') { this.value = 'Objet'; }" value="Objet" style="width:95%;"  />
            </td>
          </tr>
		</table >
		<table border="0" cellpadding="0" cellspacing="20" width="750" align="center">
			<tr><td><p>Message :</p></td></tr>
			<tr>
				<td align="center">
                <textarea name="requete" rows="10" id="requete" style="width:100%;"></textarea>
                </td> 
			</tr>
			<tr><td align="right" width="125"><input name="envooi" type="submit" class="btn" id="envooi" value=" " /></td></tr>
        </table>
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