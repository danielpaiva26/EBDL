<?php session_start();
  require('MySQL.php3');
  require('functions.php');
?>

<div id="header">

    <div id="logo"><a href="index.php"><img src="tpl/img/logo.jpg" width="127" height="37" alt="EBDL"></a></div>

    <div id="menu_siConnectee">

      <div id="avatar"><a href="profil.php"><img src="<?php info_user($_SESSION['id'],'avatar');?>" width="40" height="42" alt="avatar" /></a></div>

      <div id="pseudo"><a href="settings.php"><img src="tpl/img/settings.jpg" width="18" height="16" alt="settings" /></a><a href="profil.php"><?php info_user($_SESSION['id'],'Nom');?> <?php info_user($_SESSION['id'],'Prenom');?></a></div>

      <div id="msg"><a href="messagerie.php?section=inbox"><img src="tpl/img/msg.jpg" width="19" height="13" alt="settings" /><?php nb_msg_nlu($_SESSION['id']);?></a></div>

      <div id="notifications"><a href="notifications.php"><img src="tpl/img/notif.jpg" width="17" height="16" alt="settings" /><?php nb_notifications($_SESSION['id']);?></a></div>

    </div>

    <div class="clear"></div>

</div>