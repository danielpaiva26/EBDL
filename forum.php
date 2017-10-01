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
Nom programme: EBDL Forum
Date modif: 13/12/2012
Version: v1.0
-->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>EBDL  •  Forum</title>
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

     <?php menu('Forum');?>

     </ul>

    </div>

    <div id="sous_menu_profil">

     <ul>
      <a href="forum.php"><li>Forums</li></a>
      <?php 
	  if($_GET['section'] == 'l_sujet'){
		   echo '<a href="forum.php?id='.$_GET['id'].'&section=l_sujet&action=new"><li>Créer un topic</li></a>';
	  }elseif($_GET['section'] == 'l_topic'){
		   $sql = mysql_query('SELECT s.titre, s.id_sujet, t.description FROM forum_sujet s, forum_topic t WHERE t.id_sujet=s.id_sujet AND t.id_topic='.$_GET['id'].''); 
		   $data = mysql_fetch_array($sql);
		   echo '<li>>></li>'; 
		   echo '<a href="forum.php?id='.$data['id_sujet'].'&section=l_sujet"><li>'.ucfirst($data['titre']).'</li></a>';
		   echo '<li>>></li>'; 
		   echo '<a href=""><li>'.ucfirst($data['description']).'</li></a>';
	  }elseif(empty($_GET['section']) and isAdmin($id)){
		   echo '<a href="?section=add_cat"><li>Créer une categorie</li></a>';



		   echo '<a href="?section=add_suj"><li>Créer un forum</li></a>';



	  }else{



	  }



	  ?>



     </ul>



    </div>



    <!-- CTN -->



    <?php 



	if($_GET['section'] == 'l_sujet' and $_GET['action']=='new'){
		//new topic
		new_topic_fofo($_POST['send'],$_GET['id'],$_GET['page'],$_POST['titre'],$_POST['contenu'],$id);

	}elseif($_GET['section'] == 'l_sujet'){
		//liste des topics
		liste_topic_fofo($_GET['id'],$_GET['page']);

	}elseif($_GET['section'] == 'l_topic'){
		//formulaire reponse
			$date = time();
			$contenu = addslashes(nl2br($_POST['contenu']));
			$id_t = addslashes($_GET['id']);
			$page = addslashes($_GET['page']);
            repfofo($id,$contenu,$id_t,$page);
		//liste des messages
		liste_msg_fofo($_GET['id'],$_GET['page']);

		//formulaire de rep

		echo '

		<div id="mod_newMSG">

		<form action="forum.php?page='.$page.'&id='.$id_t.'&section=l_topic&send=send" method="post" name="NewMSG">

		 <table width="750" border="0" align="center" cellpadding="0" cellspacing="20">

		  <tr>

		   <td>

		    <textarea name="contenu" rows="2" id="contenu">'.$contenu.'</textarea></td>

			<input name="send" type="hidden" id="send" value="send_ok" />

		  </tr>

          <tr>

		   <td align="right"><input name="envooi" type="submit" class="btn" id="envooi" value=" "/></td>

		  </tr>

		 </table>

		</form>

		</div>';

	}elseif($_GET['section'] == 'add_suj'){
		add_fofo($id,$_POST['send'],$_POST['cats']);
		$html  = '<div class="titre_set">:: Créer un sujet de conversation</div>';
		$html .= '<div id="mod_newMSG">';
		$html .= '<form action="forum.php?section=add_suj" method="post" name="NewMSG">';
		$html .= '<table width="750" border="0" align="center" cellpadding="0" cellspacing="20">';
		$html .= '<tr>';
		$html .= '<td align="center">';
		$html .= '<select name="cats">';
		echo $html;
		dropdown_cat();
		$html2 = '</select>';
		$html2 .= '</td>';
		$html2 .= '</tr>';
		$html2 .= '<tr>';
		$html2 .= '<td align="center">';
		$html2 .= '<input name="send" type="text" id="send" value="" style="width:95%;" />';
		$html2 .= '</td>';
		$html2 .= '</tr>';
        $html2 .= '<tr>';
		$html2 .= '<td align="center"><input name="envooi" type="submit" class="send" id="envooi" value="Créer"/></td>';
		$html2 .= '</tr>';
		$html2 .= '</table>';
		$html2 .= '</form>';
		$html2 .= '</div>';
		echo $html2;
	}elseif($_GET['section'] == 'add_cat'){
		add_cats($id,$_POST['send']);
		$html2  = '<div class="titre_set">:: Créer une categorie</div>';
		$html2 .= '<div id="mod_newMSG">';
		$html2 .= '<form action="forum.php?section=add_cat" method="post" name="NewMSG">';
		$html2 .= '<table width="750" border="0" align="center" cellpadding="0" cellspacing="20">';
		$html2 .= '<tr>';
		$html2 .= '<td align="center">';
		$html2 .= '<input name="send" type="text" id="send" value="" style="width:95%;" />';
		$html2 .= '</td>';
		$html2 .= '</tr>';
        $html2 .= '<tr>';
		$html2 .= '<td align="center"><input name="envooi" type="submit" class="send" id="envooi" value="Créer"/></td>';
		$html2 .= '</tr>';
		$html2 .= '</table>';
		$html2 .= '</form>';
		$html2 .= '</div>';
		echo $html2;
	}else{



		//Categories et sujets



		affichage_categories_fofo();



	}



	?>    



    </div>



  <!-- Bas du site -->



  <?php require('inc/_footer.php'); ?>



</div>







</body>



</html> 