<?php session_start();

  require('inc/MySQL.php3');

  require('inc/functions.php');

  //permission

	if(empty($_SESSION['id'])){

		  header('location:index.php');

	}else{

		$id = $_SESSION['id'];

		proc_interrupteurs($id,$_GET['value']);

		edit_promo($_SESSION['id'],$_GET['promo']);

    }

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>

<!-- 

Développeur: Daniel Paiva

Nom programme: EBDL parametres

Date creation: 02/02/2012 14:04

Version: v1.0 

-->

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>EBDL  •  Parametres</title>

<link href="tpl/style.css" rel="stylesheet" type="text/css">

<link rel="icon" type="image/png" href="tpl/favicon.png" />

<script src="inc/jquery-latest.js"></script>

<!--[if IE]><link rel="shortcut icon" type="image/x-icon" href="tpl/favicon.ico" /><![endif]-->

<script type="text/javascript">

function MM_jumpMenu(targ,selObj,restore){ //v3.0

  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");

  if (restore) selObj.selectedIndex=0;

}

</script>

</head>

<body> 

<div id="barre_haut"><!-- Arc en Ciel Haut Site 8px --></div>

<div id="conteneur">

  <!-- Début du header -->

  <div id="header">

  <script type="text/javascript">

    $('#header').load('./inc/_header-dyn.php?time=<?php echo time();?>').fadeIn("slow");

    var auto_refresh = setInterval(

      function (){$('#header').load('./inc/_header-dyn.php?time=<?php echo time();?>').fadeIn("slow");}, 3000);

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

      <a href="settings.php"><li>Modifier mes infos</li></a>

      <a href="settings.php?gestion=flux"><li>Mes flux RSS</li></a>


     </ul>

    </div>

      <?php	  if(empty($_GET['gestion'])){ ?>

    <div class="titre_set">:: Parametres du compte</div>

	  <?php

	  //definir la promo

	  if(!empty($_SESSION['id'])){

		  if(!empty($_GET['id_promo']) and is_numeric($_GET['id_promo'])){

			  edit_promo($_SESSION['id'],$_GET['id_promo']);

		  }

		  $sql = mysql_query('SELECT id_promo FROM utilisateur WHERE id_user="'.$_SESSION['id'].'"');

		  $data = mysql_fetch_array($sql);

		  if(empty($data['id_promo'])){

			  echo '<div class="erreur_vert" style="margin-top:0px; margin-bottom:20px;">Veuillez choisir une promotion dans la liste ci-dessous !</div>';

		  }

	  }

	  extract($_POST); 

	  update_data($id,$nom,$prenom,$email,$mdp,$n_mdp,$phone,$adresse,$ville,$cp,$loisirs);

	  $dossier = 'user/';

	  $extensions = array('.png', '.gif', '.jpg', '.jpeg');

	  $extension = strrchr($_FILES['avatar']['name'], '.');

	  $fichier = ''.$dossier.''.$id.''.$extension.'';

	  if(!in_array($extension, $extensions)){

		  $erreur = 'Vous devez uploader un fichier de type png, gif, jpg ou jpeg';

	  }else{

		  if(move_uploaded_file($_FILES['avatar']['tmp_name'], $fichier)){

				mysql_query("UPDATE utilisateur SET avatar='".$fichier."' WHERE id_user=$id");

			  echo '<div class="erreur_vert" style="margin-top:-5px; margin-bottom:10px;">Upload effectué avec succès !</div>';

		  }else{

			  echo 'Echec de l\'upload !';

		  }

	  }

	  extract($_POST);

	  ?>

    <table width="100%" border="0" cellspacing="0">

        <tr>

          <td align="center" width="60%"><form action="?modif=true" method="post" enctype="multipart/form-data" name="settings" id="settings">

            <table width="100%" border="0" cellspacing="10" style="color:#000; border-right:dotted 1px #5ab500;">

              <tr>

                <td>Nom :</td>

                <td><input name="nom" type="text" class="set_input" id="nom" value="<?php if(!empty($nom)){echo $nom;}else{ info_user($id,'Nom');}?>" /></td>

              </tr>

              <tr>

                <td>Prénom :</td>

                <td><input name="prenom" type="text" class="set_input" id="prenom" value="<?php if(!empty($prenom)){echo $prenom;}else{ info_user($id,'Prenom');}?>" /></td>

              </tr>

              <tr>

                <td>Ma promotion :</td>

                <td>

                <select name="jumpMenu" class="set_input" style="width:97%;" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)">

                    <?php menu_promo($_SESSION['id'],return_info_user($id,'id_promo')); ?>

                </select>

                </td>

              </tr>

              <tr>

                <td>Adresse email :</td>

                <td><input name="email" type="text" class="set_input" id="email" value="<?php if(!empty($email)){echo $email;}else{ info_user($id,'Mail');}?>" /></td>

              </tr>

              <tr>

                <td>Téléphone :</td>

                <td><input name="phone" type="text" class="set_input" id="phone" value="<?php if(!empty($phone)){echo $phone;}else{ info_user($id,'Telephone');}?>" maxlength="14" /></td>

              </tr>

              <tr>

                <td>Adresse :</td>

                <td><input name="adresse" type="text" class="set_input" id="adresse" value="<?php if(!empty($adresse)){echo $adresse;}else{ info_user($id,'Adresse');}?>" /></td>

              </tr>

              <tr>

                <td>Ville :</td>

                <td><input name="ville" type="text" class="set_input" id="ville" value="<?php if(!empty($ville)){echo $ville;}else{ info_user($id,'ville');}?>" /></td>

              </tr>

              <tr>

                <td>Code postal :</td>

                <td><input name="cp" type="text" class="set_input" id="cp" value="<?php if(!empty($cp)){echo $cp;}else{ info_user($id,'code_postal');}?>" maxlength="5" /></td>

              </tr>

              <tr>

                <td>Loisirs :</td>

                <td><input name="loisirs" type="text" class="set_input" id="loisirs" value="<?php if(!empty($loisirs)){echo $loisirs;}else{ info_user($id,'loisirs');}?>" /></td>

              </tr>

              <tr>

                <td>Mot de passe actuel :</td>

                <td><input name="mdp" type="password" class="set_input" id="mdp" value="Mot de passe" onfocus="if (this.value == 'Mot de passe') { this.value = ''; }" onblur="if (this.value == '') { this.value = 'Mot de passe'; }" /></td>

              </tr>

              <tr>

                <td>Nouveau mot de passe  :</td>

                <td><input name="n_mdp" type="password" class="set_input" id="n_mdp" /></td>

              </tr>

              <tr>

                <td>&nbsp;</td>

                <td><input name="valider" type="submit" class="set_input" id="valider" value=" sauvegarder" style="width:100px;"/></td>

              </tr>

            </table>

          </form>

          </td>

          <td align="right" valign="top"><table width="100%" border="0" cellspacing="10" style="color:#5ab500;">

            <tr>

              <td align="left" valign="middle">Autoriser la recherche sur moi :</td>

            </tr>

            <tr>

              <td align="left" valign="middle">Activer les notifications :</td>

            </tr>

          </table>

            <form method="POST" action="settings.php" enctype="multipart/form-data">

              <table width="100%" border="0" cellspacing="10" style="color:#5ab500;">

                <tr>

                  <td align="left" valign="middle">&nbsp;</td>

                </tr>

                <tr>

                  <td align="left" valign="middle">Changer mon image perso :</td>

                </tr>

                <tr>

                  <td align="center" valign="middle"><input name="avatar" type="file" class="set_input"/></td>

                </tr>

                <tr>

                  <td align="center" valign="middle">

                    <input type="hidden" name="MAX_FILE_SIZE" value="5000000" />

                    <input type="submit" name="envoyer" value="Envoyer le fichier" class="set_input" />

                  </td>

                </tr>

              </table>

            </form>

          </td>

          <td align="right" valign="top"><table width="100%" border="0" cellspacing="10">

            <tr>

              <td align="right">

              <a href="?value=recherche"><img src="tpl/img/<?php aff_interrupteurs($id,'recherche');?>.jpg" width="80" alt="on" /></a>

              </td>

            </tr>

            <tr>

              <td align="right">

              <a href="?value=notifications"><img src="tpl/img/<?php aff_interrupteurs($id,'notifications');?>.jpg" width="80" alt="off" /></a>

              </td>

            </tr>

          </table>

            <table width="100%" border="0" cellspacing="10">

              <tr>

                <td height="23" align="right">&nbsp;</td>

              </tr>

              <tr>

                <td align="right"><img src="<?php info_user($id,'avatar');?>" width="77" height="88" alt="user" /></td>

              </tr>

          </table>

          </td>

        </tr>

      </table>

      <?php

	  }elseif($_GET['gestion'] == 'flux'){

		  add_flux($id,$_POST['nom_rss'],$_POST['url_rss'],$_GET['action']);

		  fav_flux($id,$_GET['fav'],$_GET['action']);

		  del_flux($id,$_GET['fav'],$_GET['action']);

	  ?>

    <div class="titre_set">:: Ajouter un flux RSS</div>

              <form method="POST" action="settings.php?gestion=flux&action=add" enctype="multipart/form-data">

                <table width="100%" border="0" cellspacing="10" style="color:#5ab500;">

                  <tr>

                    <td width="26%" align="left" valign="middle"><input name="nom_rss" type="text" class="set_input" id="nom_rss" style="width:90%;"  onfocus="if (this.value == 'Nom du flux') { this.value = ''; }" onblur="if (this.value == '') { this.value = 'Nom du flux'; }"  value="Nom du flux"/></td>

                    <td width="60%" align="left" valign="middle"><input name="url_rss" type="text" class="set_input" id="url_rss" style="width:95%;"  onfocus="if (this.value == 'URL du flux') { this.value = ''; }" onblur="if (this.value == '') { this.value = 'URL du flux'; }"  value="URL du flux"/></td>

                    <td width="14%" align="center" valign="middle"><input type="submit" name="envoyer2" value="ajouter" class="set_input" style="width:100px;" /></td>

                  </tr>

                  <tr>

                    <td align="left" valign="middle">&nbsp;</td>

                    <td align="left" valign="middle">&nbsp;</td>

                    <td align="center" valign="middle">&nbsp;</td>

                  </tr>

                </table>

              </form>

    <div class="titre_set">:: Gestion de mes flux RSS</div>

    <table width="849" border="0" cellspacing="10" style="color:#5ab500;">

                  <tr>

                    <td align="left" valign="middle">Nom du flux</td>

                    <td align="left" valign="middle">URL du flux </td>

                    <td width="107" align="center" valign="middle">Flux favori</td>

                    <td width="102" align="center" valign="middle">Supprimer</td>

                  </tr>

                  <?php liste_flux($id);?>

                </table>

<?php }else{}?>

  </div>

  <!-- Bas du site -->

  <?php require('inc/_footer.php'); ?>

</div>

</body>

</html>