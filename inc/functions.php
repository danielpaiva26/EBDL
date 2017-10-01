<?php

//Menu principal

function menu($menu){

	$liens = array(0 => 'profil.php','maPromo.php','amis.php','hdd.php','forum.php','messagerie.php','news.php','search.php','?action=logout');

	$item = array(0 => 'Profil','Ma promotion','Amis','Cloud','Forum','Messagerie','News','Recherche','Déconnexion');

	

	foreach ($liens as $lien){

		$m = $item[array_search($lien, $liens)];

		if($m == $menu){

			$activ = 'class="act_menu"';

		}else{

			$activ = '';

		}

		echo '<a href="'.$lien.'"><li '.$activ.'>'.$m.'</li></a>';

	}

}



//recherche

function search($recherche){

	if(!empty($recherche)){

	$sql = mysql_query("SELECT * FROM utilisateur u WHERE u.Nom LIKE '%$recherche%' OR u.Prenom LIKE '%$recherche%' OR u.Pseudo LIKE '%$recherche%' OR u.Mail LIKE '%$recherche%'") or die (mysql_error());

	while($data = mysql_fetch_array($sql)){

		if($data['recherche']){

		$html = '<div class="ami">';

		$html .= '<table width="415" height="100" border="0">';

		$html .= '<tr>';

		$html .= '<td width="87" align="center" valign="middle"><img src="'.return_info_user($data['id_user'],'avatar').'" width="60" height="70" alt="avatar" /></td>';

		$html .= '<td width="268"><p>'.$data['Prenom'].' '.$data['Nom'].'</p><p>'.$data['code_postal'].' '.$data['ville'].'</p><p>'.$data['Mail'].'</p></td>';

		$html .= '<td width="50"><a href="profil.php?user='.$data['id_user'].'">voir &raquo;</a></td>';

		$html .= '</tr>';

		$html .= '</table>';

		$html .= '</div>';

		echo $html;

		}

	}

	}

}



//Connexion

function login($user,$password){

	$password = sha1(md5($password));

    $req1 = mysql_query('SELECT mot_de_passe,id_user,rang FROM utilisateur WHERE pseudo="'.$user.'" OR mail="'.$user.'"');

    $data1 = mysql_fetch_array($req1);



		if($data1['mot_de_passe'] == $password){



            $_SESSION['id'] = $data1['id_user'];



	        echo '<meta http-equiv="refresh" content="0;url=profil.php"/>';



		}else{ 



			echo '<div class="erreur_rouge">Erreur de connexion</div>';



		}	

}







//Déconnexion



if($_GET['action'] == 'logout'){



	session_destroy();

	echo '<meta http-equiv="refresh" content="0;url=index.php"/>';

}







//Signup



function inscription($verif,$cgu,$pseudo,$nom,$prenom,$email,$email_verif,$pw,$pw_verif){



  if($verif == 'ok'){

  if(!empty($cgu)){

	  //verif pseudo

	  if(!empty($pseudo) and !$data and $pseudo!='Pseudo'){



	  //verif pseudo existe

	  $sql = mysql_query("SELECT * FROM utilisateur WHERE Pseudo='".$pseudo."'");

	  $data = mysql_fetch_array($sql);

	  if(!$data){



		  //verfif nom

		  if(!empty($nom) and $nom!='Nom'){



			  //verif prenom

			  if(!empty($prenom) and $prenom!='Prenom'){



				  //verif email

				  if(!empty($email) and !empty($email_verif) and $email==$email_verif  and !$data){

					  

				  //verif email existe

	              $sql = mysql_query("SELECT * FROM utilisateur WHERE Mail='".$email."'");

				  $data = mysql_fetch_array($sql);

				  if(!$data){

					  if(!empty($pw) and !empty($pw_verif) and $pw==$pw_verif){

					  mysql_query("INSERT INTO utilisateur VALUES('','$nom','$prenom','$pseudo','$email','".sha1(md5($pw))."','','','','','','','0','1','1',' NC')");

					  $_SESSION['id'] = mysql_insert_id();

					  echo '<meta http-equiv="refresh" content="0;url=profil.php"/>';

					  }else{

						  echo 'erreur pw';

					  }

				  }else{



					  echo 'email déja existant';

				  }

				  }else{



					  echo 'email non renseigné ou verification';

				  }

			  }else{

				  echo 'prenom non renseigné';

			  }

		  }else{echo 'nom non renseigné';}

	  }else{

		  echo 'pseudo existant';

	  }

	  }else{

		  echo 'pseudo non renseigné';

	  }

  }else{

		  echo 'conditions';

  }

  }

}







//Compter le nombre de membres inscrits

function nb_membres(){



	$req1 = mysql_query("SELECT * FROM utilisateur");



	$data1 = mysql_num_rows($req1);



	echo $data1;



}







//remplacement



function remplace($chaine){



	$reel = array("<3","<", ">", "merde", ";", "$");



    $new   = array("♥",":", ":", "m***e", ":", "$ ");



    $message = str_replace($reel, $new,$chaine);



	return $message;



}



//function date



function date_conversion($time){



		$diff = time()-$time;



	    if($diff<0) return false;



	    $sec = $diff%60;



	    $min = ($diff-$sec)/60%60;



	    $heure = ($diff-$sec-$min*60)/3600%24;



	    $minuit = mktime('0','0','0',date('m'),date('d'),date('Y'));



	    $hier = mktime('0','0','0',date('m'),date('d')-1,date('Y'));



	    if($diff<60) { $date = "Il y a ".$diff."s"; }



	    elseif($diff<3600) { $date = "Il y a ".$min." min"; }



	    elseif($diff<7200) { $date = "Il y a ".$heure."h".$min; }



	    elseif($time>$minuit) { $date = "Ajourd'hui à ".date("H:i",$time); }



	    elseif($time>$hier) { $date = "Hier à ".date("H:i",$time); }



	    else { $date = "Le ".date('d/m/Y \à H:i',$time); }



		return $date;



}







//Infos user



function info_user($id,$request){



	if(!empty($id) && !empty($request)){



		$sql = mysql_query("SELECT $request FROM utilisateur WHERE id_user=$id");



		$data = mysql_fetch_array($sql);



	    if($request == 'avatar' and empty($data[$request])){



			echo 'user/0.jpg?var='.time().'';



		}else{



			echo $data[$request];



		}



	}



}



function return_info_user($id,$request){



	if(!empty($id) && !empty($request)){



		$sql = mysql_query("SELECT $request FROM utilisateur WHERE id_user=$id");



		$data = mysql_fetch_array($sql);



	    if($request == 'avatar' and empty($data[$request])){



			$return = 'user/0.jpg?var='.time().'';



			return  $return;



		}else{



			$return = $data[$request];



			return $return;



		}



	}



}







//Admin 



function isAdmin($id){



	$sql = mysql_query("SELECT rang FROM utilisateur WHERE id_user=$id");



	$data = mysql_fetch_array($sql);



	$admin = $data['rang'];



	return $admin;



}







//Nombre notifications

function nb_notifications($id){



	$req1 = mysql_query("SELECT * FROM notifications n, utilisateur u WHERE u.id_user=n.id_destinataire AND n.id_destinataire='".$id."' AND n.vu='0' AND u.notifications='1'");

	$data1 = mysql_num_rows($req1);



	echo $data1;



}



//Afficher notifications

function afficher_notifications($id){

	$req = mysql_query("SELECT * FROM notifications WHERE id_destinataire='".$id."' ORDER BY id_notif DESC");

	if(!mysql_num_rows($req)){ echo '<div class="erreur_vert" style="margin-top:10px;">Aucune nouvelle notification</div>';}

	

	while($data = mysql_fetch_array($req)){

	if($data['vu']){

		echo '<div class="notif_vu">'.$data['contenu'].'</div>';

	}else{

		echo '<div class="notif">'.$data['contenu'].'</div>';

	}

	 mysql_query("UPDATE notifications SET vu='1' WHERE id_destinataire='".$id."'");

	}

	

}







//Nombre messages non lues



function nb_msg_nlu($id){



	$req1 = mysql_query("SELECT * FROM messagerie WHERE id_destinataire='".$id."' AND lu='0'");



	$data1 = mysql_num_rows($req1);



	echo $data1;



}







//Promo user



function promotion($id){



	$req1 = mysql_query("SELECT p.nom_promo FROM promotion p, utilisateur u WHERE u.id_user=$id AND u.id_promo=p.id_promo");



	$data1 = mysql_fetch_array($req1);



	echo $data1['nom_promo'];



}



//modifier la promotion

function edit_promo($id,$id_promo){

	if(!empty($id) and !empty($id_promo)){

		mysql_query("UPDATE utilisateur SET id_promo='".$id_promo."' WHERE id_user='".$id."'");

	}

}



//dropdown promotion

function menu_promo($id,$id_p){

		$data2 = mysql_fetch_array(mysql_query("SELECT * FROM utilisateur u WHERE u.id_user='$id'"));

		if($data2['id_promo'] == 0){

		echo '<option value="?id_promo=" selected="selected"> </option>';

		}

	$sql = mysql_query("SELECT * FROM promotion ORDER BY nom_promo DESC");

	while($data = mysql_fetch_array($sql)){

		if($data2['id_promo'] == $data['id_promo']){

		echo '<option value="?id_promo='.$data['id_promo'].'" selected="selected">'.$data['nom_promo'].'</option>';

		}else{

		echo '<option value="?id_promo='.$data['id_promo'].'">'.$data['nom_promo'].'</option>';

		}

	}

}



//Boite de reception messages

function inbox_aff($id){



	$req = mysql_query("SELECT * FROM messagerie WHERE id_user='".$id."' OR id_destinataire='".$id."' GROUP BY conversation ORDER BY max(date_post) DESC");



	while($data = mysql_fetch_array($req)){







        //verif si supprimé



	    $req3 = mysql_query("SELECT  * FROM conversation_del WHERE  id_conversation='".$data['conversation']."'");



		$data3 = mysql_fetch_array($req3);



		



	    if($data3['user1'] == $id){



			$u = $data3['user1_del'];



			$lautre = $data3['user2'];



		}else{



			$u = $data3['user2_del'];



			$lautre = $data3['user1'];



		}



		if($u== 0){



		



		//recup infos message



		$req1 = mysql_query("SELECT * FROM messagerie WHERE conversation='".$data['conversation']."' ORDER BY id_mp DESC");



		$data1 = mysql_fetch_array($req1);



		



		//recup infos user



		$req2 = mysql_query("SELECT u.nom, u.prenom FROM utilisateur u WHERE u.id_user = '".$lautre."' ");



		$data2 = mysql_fetch_array($req2);



		



		//traitement de l'heure







		$date = date_conversion($data1['date_post']);		



		



		if($data1['id_user'] == $id){



			$lu = "_lu";



		}elseif($data1['lu'] == 0){



			$lu = "";



		}else{



			$lu = "_lu";



		}







      echo '<a href="?section=msg&id='.$data['conversation'].'">



	        <div class="message'.$lu.'">



               <div class="b_1"><div class="voyant"></div></div>



               <div class="b_2">'.$data2['prenom'].' '.$data2['nom'].'</div>



               <div class="b_3">'.ucfirst($data1['objet']).'</div>



               <div class="b_4">'.$date.'</div>



			   <div class="clear"></div>



            </div>



			</a>';



		   }



	}



	if(empty($data2)){



			echo '<div class="erreur_vert" style="margin-top:10px;">Pas de nouveaux messages.</div><br>';



	}







}







//Nouvelle conversation



function newmsg($expediteur,$destinataire,$objet,$message){ 



	$date = time();



	//remplace mots illicites



	$message = remplace($message);







	mysql_query("INSERT INTO messagerie VALUES('','".nl2br($message)."','".$date."','0','".$expediteur."','".$destinataire."','".$objet."','')");



	$id_con = mysql_insert_id();



	mysql_query("UPDATE messagerie SET conversation='".$id_con."' WHERE id_mp='".$id_con."' ");



	mysql_query("INSERT INTO conversation_del VALUES('".$id_con."','".$expediteur."','0','".$destinataire."','0')");



}







//Reponse conversation



function repmsg($expediteur,$message,$conversation){ 



    $req = mysql_query("SELECT * FROM messagerie WHERE conversation='".$conversation."'");



	$data = mysql_fetch_array($req);



	



	//remplace mots illicites



	$message = remplace($message);



	



	if($data['id_user'] == $expediteur){



		$destinataire = $data['id_destinataire'];



	}else{



		$destinataire = $data['id_user'];



	}



	$date = time();



	mysql_query("INSERT INTO messagerie VALUES('','".addslashes(nl2br($message))."','".$date."','0','".$expediteur."','".$destinataire."','".addslashes($data['objet'])."','".$conversation."')");



	mysql_query("UPDATE conversation_del SET user1_del='0',user2_del='0' WHERE id_conversation='".$conversation."' ");



	echo '<meta http-equiv="refresh" content="1;url=messagerie.php?section=msg&tri='.$_GET['tri'].'&id='.$_GET['id'].'#mod_newMSG"/>';



}







//affichage de la conversation



function affconversation($id,$id_u,$tri){



	



	//affichage



	$req = mysql_query("SELECT count(*) as total_m FROM messagerie WHERE conversation='".$id."' AND id_user='".$id_u."' OR  conversation='".$id."' AND id_destinataire='".$id_u."'");



	$data2 = mysql_fetch_array($req);



	if($tri==10 and $data2['total_m']>= 10){



		$tt = $data2['total_m']-10;



		$var = ' LIMIT '.$tt.',10';



	}elseif($tri==5 and $data2['total_m']>= 5){



		$tt = $data2['total_m']-5;



		$var = ' LIMIT '.$tt.',5';



	}else{



		$var = ' ';



	}







	//declarer comme lu



	mysql_query("UPDATE messagerie SET lu='1' WHERE id_destinataire='".$id_u."' AND conversation='".$id."'");



	



	$i = 0;	



	



	$req = mysql_query("SELECT * FROM messagerie WHERE conversation='".$id."' AND id_user='".$id_u."' OR  conversation='".$id."' AND id_destinataire='".$id_u."' ORDER BY id_mp ASC $var ");



	while($data = mysql_fetch_array($req)){



		



		//afficher objet



		if($i == 0){



			echo'<div id="titre_mp"><a href="?section=inbox"><div class="retour"><img src="./tpl/img/retour.png" width="20" height="20" alt="retour" /></div></a>:: '.ucfirst(stripslashes($data['objet'])).' <span style="font-size:11px;color:#000;"> //'.$data2['total_m'].' Message(s)</span><a href="?section=msg&action=del&id='.$id.'&status=1#mod_newMSG"><div class="ico"><img src="./tpl/img/trash.png" width="17" height="20" alt="supprimer" /></div></a><a href="?section=msg&id='.$id.'&tri=10"><div class="ico"><img src="./tpl/img/10.png" width="20" height="20" alt="Affciher 10 messages" /></div></a><a href="?section=msg&id='.$id.'&tri=5"><div class="ico"><img src="./tpl/img/5.png" width="20" height="20" alt="Affciher 5 messages" /></div></a><a href="?section=msg&id='.$id.'"><div class="ico"><img src="./tpl/img/all.png" width="40" height="20" alt="Affciher tous les messages" /></div></a></div>';



		}



		



		//infos du post



		$req2 = mysql_query("SELECT * FROM utilisateur WHERE id_user='".$data['id_user']."'");



		$data2 = mysql_fetch_array($req2);







		//traitement de l'heure



		$date = date_conversion($data['date_post']);		







   //affichage message



	if($data['id_destinataire'] == $id_u){



      echo '<div class="message_r" id="msg_'.$i.'">



             <table width="840" border="0" cellspacing="0" cellpadding="5">



              <tr>



               <td width="10" align="left" valign="top"><div class="voyant"></div></td>



               <td width="170" align="left" valign="top"><p>'.$data2['Prenom'].' '.$data2['Nom'].'</p><p><span class="date">'.$date.'</span></p></td>



               <td width="660" align="left">'.ucfirst(stripslashes($data['message'])).'</td>



              </tr>



             </table>



            </div>';



	}else{



      echo '<div class="message_e" id="msg_'.$i.'">



             <table width="840" border="0" cellspacing="0" cellpadding="5">



              <tr>



               <td width="10" align="left" valign="top"><div class="voyant"></div></td>



               <td width="170" align="left" valign="top"><p>'.$data2['Prenom'].' '.$data2['Nom'].'</p><p><span class="date">'.$date.'</span></p></td>



               <td width="660" align="left">'.ucfirst(stripslashes($data['message'])).'</td>



              </tr>



             </table>



            </div>';



	}



	$i++;







	}



}







//delete conversation



function del_conversation($id,$id_conversation,$status){



	//choix user



	$req = mysql_query("SELECT * FROM conversation_del WHERE id_conversation='".$id_conversation."'");



	$data = mysql_fetch_array($req);



    if($id == $data['user1'] and $status=="2" and $data['user2_del'] == '1'){



		//requete



	    mysql_query("DELETE FROM messagerie WHERE conversation='".$id_conversation."'");



	    mysql_query("DELETE FROM conversation_del WHERE id_conversation='".$id_conversation."'");



	    echo '<meta http-equiv="refresh" content="4;url=messagerie.php?section=inbox"/>';



	    echo '<div class="erreur_vert" style="margin-top:-10px;">Conversation supprimée.</div>';



	}elseif($id == $data['user2'] and $status=="2" and $data['user1_del'] == '1'){



		//requete



	    mysql_query("DELETE FROM messagerie WHERE conversation='".$id_conversation."'");



	    mysql_query("DELETE FROM conversation_del WHERE id_conversation='".$id_conversation."'");



	    echo '<meta http-equiv="refresh" content="4;url=messagerie.php?section=inbox"/>';



	    echo '<div class="erreur_vert" style="margin-top:-10px;">Conversation supprimée.</div>';



	}elseif($id == $data['user1'] and $status=="2"){



		//requete



	    mysql_query("UPDATE conversation_del SET user1_del=1 WHERE id_conversation='".$id_conversation."'");



	    echo '<meta http-equiv="refresh" content="4;url=messagerie.php?section=inbox"/>';



	    echo '<div class="erreur_vert" style="margin-top:-10px;">Conversation supprimée.</div>';



	}elseif($id == $data['user2'] and $status=="2"){



		//requete



	    mysql_query("UPDATE conversation_del SET user2_del=1 WHERE id_conversation='".$id_conversation."'");



	    echo '<meta http-equiv="refresh" content="4;url=messagerie.php?section=inbox"/>';



	    echo '<div class="erreur_vert" style="margin-top:-10px;">Conversation supprimée.</div>';



	}else{



	    echo '<div class="erreur_rouge" style="margin-top:-10px;">ERREUR</div><br><br>';



	}



}







//liste amis dropdown list



function amis_dropdown($id){



	$req = mysql_query("SELECT ad.id_demandeur, ad.id_user FROM ami_de ad, accept a WHERE ad.id_accept=a.id_accept AND a.etat='1' AND ad.id_demandeur='".$id."' OR ad.id_user='".$id."' AND  ad.id_accept=a.id_accept AND a.etat='1'");



	while($data=mysql_fetch_array($req)){



		if($id != $data['id_user']){



	        $req2 = mysql_query("SELECT u.Nom, u.Prenom FROM utilisateur u WHERE id_user='".$data['id_user']."'");



			$data2=mysql_fetch_array($req2);



			echo '<option value="'.$data['id_user'].'">'.$data2['Prenom'].' '.$data2['Nom'].'</option>';



		}else{



	        $req2 = mysql_query("SELECT u.Nom, u.Prenom FROM utilisateur u WHERE id_user='".$data['id_demandeur']."'");



			$data2=mysql_fetch_array($req2);



			echo '<option value="'.$data['id_demandeur'].'">'.$data2['Prenom'].' '.$data2['Nom'].'</option>';



		}



	}



}



// si ami

function verif_ami($id,$ami,$statut){



	$data = mysql_fetch_array(mysql_query("SELECT * FROM ami_de ami, accept a WHERE ami.id_accept=a.id_accept AND a.etat='".$statut."' AND ami.id_demandeur='".$id."' AND ami.id_user='".$ami."' OR ami.id_accept=a.id_accept AND a.etat='".$statut."' AND ami.id_demandeur='".$ami."' AND ami.id_user='".$id."'"));

	

	if($data){

		return $data['id_demandeur'];

	}else{

		return $data = 0;

	}

}



//Ajouter a mes amis

function add_friend($id,$ami,$action){

	if(!empty($id) and !empty($ami) and $action=='add_friend' and !verif_ami($id,$ami,1) and !verif_ami($id,$ami,0)){

		mysql_query("INSERT INTO ami_de VALUES('','".$id."','".$ami."')");

		$id_con = mysql_insert_id();

	    mysql_query("INSERT INTO accept VALUES('".$id_con."','0')");

		$notification = '<a href="profil.php?user='.$id.'">'.return_info_user($id,'Prenom').' '.return_info_user($id,'Nom').' souhaite vous ajouter a ses amis.</a>';

	    mysql_query("INSERT INTO notifications VALUES('','".time()."','".$notification."','add_ami','".$id."','".$ami."','0')");

		

	}elseif(!empty($id) and !empty($ami) and $action=='accept_friend' and verif_ami($id,$ami,0)){

		//recup

		$sql = mysql_query("SELECT * FROM ami_de WHERE id_demandeur='".$id."' AND id_user='".$ami."' OR id_demandeur='".$ami."' AND id_user='".$id."'");

		$data = mysql_fetch_array($sql);

		if($data['id_user'] == $id and $data['id_demandeur'] == $ami){

			mysql_query("UPDATE accept SET etat='1' WHERE id_accept='".$data['id_accept']."'");

			mysql_query("DELETE FROM notifications WHERE id_destinataire='".$id."' AND id_user='".$ami."' AND type='add_ami'");

		}

		

	}elseif(!empty($id) and !empty($ami) and $action=='reject_friend' and verif_ami($id,$ami,0)){

		//recup

		$sql = mysql_query("SELECT * FROM ami_de WHERE id_demandeur='".$id."' AND id_user='".$ami."' OR id_demandeur='".$ami."' AND id_user='".$id."'");

		$data = mysql_fetch_array($sql);

		if($data['id_user'] == $id and $data['id_demandeur'] == $ami){

			mysql_query("DELETE FROM ami_de WHERE id_demandeur='".$id."' AND id_user='".$ami."' OR  id_demandeur='".$ami."' AND id_user='".$id."'");

			mysql_query("DELETE FROM notifications WHERE id_destinataire='".$id."' AND id_user='".$ami."' AND type='add_ami'");

		}

		

	}else{

		//rien

	}

}

//Amis



function amis_page($id,$tri){



	function mise_en_page($id,$prenom,$nom,$promo,$mail){



		$html = '<div class="ami" '.$color.'>';



		$html .= '<table width="415" height="100" border="0">';



		$html .= '<tr>';



		$html .= '<td width="87" align="center" valign="middle"><img src="'.return_info_user($id,'avatar').'" width="60" height="70" alt="avatar" /></td>';



		$html .= '<td width="268"><p>'.$prenom.' '.$nom.'</p><p>'.$promo.'</p><p>'.$mail.'</p></td>';



		$html .= '<td width="50"><a href="profil.php?user='.$id.'">voir &raquo;</a></td>';



		$html .= '</tr>';



		$html .= '</table>';



		$html .= '</div>';



		echo $html;



	}



	$req = mysql_query("SELECT ad.id_demandeur, ad.id_user FROM ami_de ad, accept a WHERE ad.id_accept=a.id_accept AND a.etat='1' AND ad.id_demandeur='".$id."' OR ad.id_user='".$id."' AND  ad.id_accept=a.id_accept AND a.etat='1'");



	



	$i = 0;



	while($data=mysql_fetch_array($req)){



		



		if($id != $data['id_user']){



	        $req2 = mysql_query("SELECT u.Nom, u.Prenom, u.id_user, p.nom_promo, u.Mail FROM utilisateur u, promotion p WHERE id_user='".$data['id_user']."' AND u.id_promo=p.id_promo");



			$data2=mysql_fetch_array($req2);



			if(substr($data2['Nom'], 0, 1) == $tri or substr($data2['Prenom'], 0, 1) == $tri && $tri!='ALL'){



				mise_en_page($data2['id_user'],$data2['Prenom'],$data2['Nom'],$data2['nom_promo'],$data2['Mail']);



			}elseif($tri == 'ALL' or empty($tri)){



				mise_en_page($data2['id_user'],$data2['Prenom'],$data2['Nom'],$data2['nom_promo'],$data2['Mail']);



			}



		}else{



	        $req2 = mysql_query("SELECT u.Nom, u.Prenom, u.id_user, p.nom_promo,u.Mail FROM utilisateur u, promotion p WHERE id_user='".$data['id_demandeur']."' AND u.id_promo=p.id_promo");



			$data2=mysql_fetch_array($req2);



			if(substr($data2['Nom'], 0, 1) == $tri or substr($data2['Prenom'], 0, 1) == $tri && $tri!='ALL'){



				mise_en_page($data2['id_user'],$data2['Prenom'],$data2['Nom'],$data2['nom_promo'],$data2['Mail']);



			}elseif($tri == 'ALL' or empty($tri)){



				mise_en_page($data2['id_user'],$data2['Prenom'],$data2['Nom'],$data2['nom_promo'],$data2['Mail']);



			}



		}



	}



}







//Amis



function promotion_page($id,$tri){



	$sql = mysql_fetch_array(mysql_query("SELECT p.id_promo FROM promotion p, utilisateur u WHERE p.id_promo=u.id_promo AND u.id_user=$id"));



	$req = mysql_query("SELECT u.Nom, u.Prenom, u.id_user, p.nom_promo, u.Mail FROM utilisateur u, promotion p WHERE u.id_promo=p.id_promo AND p.id_promo='".$sql['id_promo']."'");



	while($data=mysql_fetch_array($req)){



		$html = '<div class="ami">';



		$html .= '<table width="415" height="100" border="0">';



		$html .= '<tr>';



		$html .= '<td width="87" align="center" valign="middle"><img src="'.return_info_user($data['id_user'],'avatar').'" width="60" height="70" alt="avatar" /></td>';



		$html .= '<td width="268"><p>'.$data['Prenom'].' '.$data['Nom'].'</p><p>'.$data['nom_promo'].'</p><p>'.$data['Mail'].'</p></td>';



		$html .= '<td width="50"><a href="profil.php?user='.$data['id_user'].'">voir &raquo;</a></td>';



		$html .= '</tr>';



		$html .= '</table>';



		$html .= '</div>';



		



		if(substr($data['Nom'], 0, 1) == $tri or substr($data['Prenom'], 0, 1) == $tri && $tri!='ALL'){



			echo $html;



		}elseif($tri == 'ALL' or empty($tri)){



			echo $html;



		}



		



	}



}







//flux favorit



function flux_fav($id){



  //verif connection internet



  if(!$sock = @fsockopen('www.google.fr', 80, $num, $error, 5)){



        echo '<div class="flux"><center><img src="tpl/img/rss-px.png" /><br><b>Pas de connection internet !</b></center></div>';



  }else{



  $sql = mysql_query("SELECT url,nom FROM fluxrss WHERE id_user='".$id."' AND favori='1'");



  $data = mysql_fetch_array($sql);

  $nombre_limite = 5;

  if($data){

  $raw = file_get_contents($data['url']); 



  if ($raw) {



     if(eregi("<item>(.*)</item>",$raw,$rawitems)){



        $items = explode("<item>", $rawitems[0]);



		$datetime = date_create($pubDate[1]);



		$date = date_format($datetime, 'd/m'); 



        $nb = count($items); 



        $maximum = (($nb-1) < $nombre_limite) ? ($nb-1) : $nombre_limite; 







        for ($i=0;$i<$maximum;$i++) {



        eregi("<title>(.*)</title>",$items[$i+1], $title); 



        eregi("<link>(.*)</link>",$items[$i+1], $link); 

		//nb max caracteres

		$max=65;

		$chaine = ''.$date.' - ['.$data['nom'].'] '.$title[1].'';

		if(strlen($chaine)>=$max){

			$chaine=substr($chaine,0,$max);

			$espace=strrpos($chaine," ");

			if($espace){

				$chaine=substr($chaine,0,$espace);

				$chaine .= '...';

			}

		}

        echo '<div class="flux"><a href="'.$link[1].'" target="_blank">'.$chaine.'</a></div>';



		}



	}



  }



  }else{



        echo '<div class="flux"><center><br>Veulliez choisir un flux rss comme favori :)</center></div>';



  }



  }



}







//flux rss



function flux($id,$flux){



  //verif connection internet



  if(!$sock = @fsockopen('www.google.fr', 80, $num, $error, 5)){



        echo '<br><center><img src="tpl/img/rss-px.png" /><br><b>Pas de connection internet !</b></center>';



  }else{



	  



  $couleurs = array('vert','jaune','bleu','violet');



  $bg = 0;



  if(!empty($flux)){



	  $var = ' AND id_rss='.$flux.'';



	  $nombre_limite = 15;



  }else{



	  $nombre_limite = 3;



  }



  



  $sql = mysql_query("SELECT url, nom FROM fluxrss WHERE id_user='".$id."' $var");



  while($data = mysql_fetch_array($sql)){



	  



  



      /*$bg = rand(0,3);*/



      if($bg == 3){



		  $bg = 0;



	  }



	  



	  $raw = file_get_contents($data['url']);



	  if ($raw) {



		  if(eregi("<item>(.*)</item>",$raw,$rawitems)){



			  $items = explode("<item>", $rawitems[0]);



			  $nb = count($items);



			  $maximum = (($nb-1) < $nombre_limite) ? ($nb-1) : $nombre_limite;



			  for ($i=0;$i<$maximum;$i++) {



				  eregi("<title>(.*)</title>",$items[$i+1], $title);



				  eregi("<link>(.*)</link>",$items[$i+1], $link);



				  echo '<a href="'.$link[1].'" target="_blank">



                        <div class="xml_info">



                          <div class="titre">'.$title[1].'</div>



                          <div class="photo" style="background:url(tpl/img/rss-'.$couleurs[$bg].'.jpg);"><span class="titre_flux">'.$data['nom'].'</span></div>



                        </div>



                        </a>';



			   }



	       }



	   }



  $bg++;



  }



  }



}



//flux rss menu

function list_my_flux($id){



  $sql = mysql_query("SELECT id_rss, nom FROM fluxrss WHERE id_user='".$id."'");



	  echo '<a href="news.php"><li>Tous</li></a>';



  while($data = mysql_fetch_array($sql)){



	  echo '<a href="?flux='.$data['id_rss'].'"><li>'.$data['nom'].'</li></a>';



  }



}



//liste des flux

function liste_flux($id){

	  $sql = mysql_query("SELECT * FROM fluxrss WHERE id_user='".$id."'");

	  while($data = mysql_fetch_array($sql)){

		  if(!$data['favori']){

			  $opacity = ' style="opacity:0.3;"';

		  }else{

			  $opacity = '';

		  }

		  $html = '<tr style="font-size:13px; color:#000;">';

          $html .= '<td align="left" valign="middle">'.$data['nom'].'</td>';

          $html .= '<td align="left" valign="middle">'.$data['URL'].'</td>';

          $html .= '<td align="center" valign="middle"><a href="?gestion=flux&action=change&fav='.$data['id_rss'].'"><img src="tpl/img/star.JPG" '.$opacity.'/></a></td>';

          $html .= '<td align="center" valign="middle"><a href="?gestion=flux&action=delete&fav='.$data['id_rss'].'"><img src="tpl/img/trash.png"/></a></td>';

          $html .= '</tr>';

		  echo $html;

	  }

}



//add flux rss

function add_flux($id,$nom,$url,$action){

	if(!empty($id) and !empty($nom) and !empty($url) and $action == 'add'){

		mysql_query("INSERT INTO fluxrss VALUES('','".$nom."','".$url."','".$id."','0')");

	}

}



//set fav rss

function fav_flux($id,$flux,$action){

	if(!empty($id) and !empty($flux) and $action == 'change'){

		mysql_query("UPDATE fluxrss SET favori='0' WHERE id_user='".$id."'");

		mysql_query("UPDATE fluxrss SET favori='1' WHERE id_rss='".$flux."' AND id_user='".$id."'");

	}

}



//del flux rss

function del_flux($id,$flux,$action){

	if(!empty($id) and !empty($flux) and $action == 'delete'){

		mysql_query("DELETE FROM fluxrss WHERE id_rss='".$flux."' AND id_user='".$id."'");

	}

}



//affichage des categories

function affichage_categories_fofo(){



	$sql = mysql_query("SELECT nom,id_categorie FROM forum_categorie");



	while($data = mysql_fetch_array($sql)){



		echo '<div class="categorie">// '.ucfirst($data['nom']).'</div>';



		



		$sql2 = mysql_query("SELECT titre,id_sujet FROM forum_sujet t WHERE t.id_cat='".ucfirst($data['id_categorie'])."' ORDER BY id_sujet DESC");



		while($data2 = mysql_fetch_array($sql2)){



			



				$nb_total = mysql_query("SELECT COUNT(*) AS nb_total FROM forum_topic WHERE id_sujet='".$data2['id_sujet']."'");



	            $nb_total = mysql_fetch_array($nb_total);







			



			echo '<a href="?id='.ucfirst($data2['id_sujet']).'&section=l_sujet">



                  <div class="sujet">



                    <div class="titre">'.ucfirst($data2['titre']).'</div>



                    <div class="date">&nbsp;</div>



                    <div class="nb">'.$nb_total['nb_total'].'</div>



                    <div class="clear"><!-- Clear --></div>



                  </div>



                  </a>';



		}



	}



}







//liste des topics



function liste_topic_fofo($id_sujet,$id_page){



	$pagination = 10;



	



	if( isset($id_page) && is_numeric($id_page) ){



		$page = $id_page;



	}else{



		$page = 1;



	}



	$limit_start = ($page - 1) * $pagination;



	



	$nb_total = mysql_query("SELECT COUNT(*) AS nb_total FROM forum_topic WHERE id_sujet=$id_sujet");



	$nb_total = mysql_fetch_array($nb_total);



	$nb_total = $nb_total['nb_total'];



	$nb_pages = ceil($nb_total / $pagination);



	



	$sql2 = mysql_query("SELECT titre FROM forum_sujet WHERE id_sujet=$id_sujet ");



	$data2 = mysql_fetch_array($sql2);



	



	echo '<div class="categorie">// '.ucfirst($data2['titre']).'<div class="pages">Page '.$page.' sur '.$nb_pages.'</div></div>';



	



	$sql = mysql_query("SELECT * FROM forum_topic WHERE id_sujet=$id_sujet ORDER BY id_topic LIMIT $limit_start,$pagination");



	while($data = mysql_fetch_array($sql)){



		    //nombre de messages



			$sql10 = mysql_query("SELECT COUNT(*) AS nb_su_total FROM forum_message WHERE id_topic='".$data['id_topic']."'");



	        $data10 = mysql_fetch_array($sql10);



		    //dernier message



			$sql11 = mysql_query("SELECT date,auteur FROM forum_message WHERE id_topic='".$data['id_topic']."' ORDER BY date DESC");



	        $data11 = mysql_fetch_array($sql11);



		    //dernier message



			$sql12 = mysql_query("SELECT nom,prenom FROM utilisateur WHERE id_user='".$data11['auteur']."'");



	        $data12 = mysql_fetch_array($sql12); 



			



			echo '<a href="?id='.$data['id_topic'].'&section=l_topic">



                  <div class="sujet">



                    <div class="titre">'.ucfirst($data['description']).'</div>



                    <div class="date">'.date_conversion($data11['date']).' Par '.ucfirst($data12['prenom']).' '.ucfirst($data12['nom']).'</div>



                    <div class="nb">'.$data10['nb_su_total'].'</div>



                    <div class="clear"><!-- Clear --></div>



                  </div>



                  </a>';



	}



	



	//pagination et erreur si pas de topics



	if(!$nb_total){



		echo '<div class="erreur_vert" style="margin-top:10px;">Aucun topic dans ce sujet.</div>';



	    echo '<div class="pagination"><a href="forum.php"><div class="item_hover">RETOUR</div></a></div>';



	}else{



		echo '<div class="pagination">';



		for ($i = 1 ; $i <= $nb_pages ; $i++) {



			if ($i == $page ){



				echo ' <div class="item_hover">'.$i.'</div> ';



			}else{



				echo ' <a href="?page='.$i.'&id='.$id_sujet.'&section=l_sujet"><div class="item">'.$i.'</div></a> ';



			}



		}



		echo '</div>';



	}



	



}







//Reponse fofo
function repfofo($id_u,$contenu,$id_t,$page){ 
if(!empty($contenu)){
    $req = mysql_query("SELECT * FROM messagerie WHERE conversation='".$conversation."'");
	$data = mysql_fetch_array($req);
	
	$date = time();
	//remplace mots illicites
	$message = remplace($contenu);
	mysql_query("INSERT INTO forum_message VALUES('','".$id_u."','".$message."','".$date."','".$id_t."')");
	
	echo '<meta http-equiv="refresh" content="1;url=forum.php?id='.$id_t.'&section=l_topic&page='.$page.'#mod_newMSG"/>';
}
}
//dropdown categories
function dropdown_cat(){
	$req = mysql_query("SELECT * FROM forum_categorie");
	while($data = mysql_fetch_array($req)){
		echo '<option value="'.$data['id_categorie'].'">'.$data['nom'].'</option>';
	}
}
//creer forum
function add_fofo($id,$nom,$cat){
	if(isAdmin($id) and !empty($nom) and !empty($cat)){
		mysql_query("INSERT INTO forum_sujet VALUES('','".$cat."','".$id."','".addslashes($nom)."')");
	echo '<meta http-equiv="refresh" content="1;url=forum.php"/>';
	}
}
//creer forum
function add_cats($id,$nom){
	if(isAdmin($id) and !empty($nom)){
		mysql_query("INSERT INTO forum_categorie VALUES('','".addslashes($nom)."')");
	echo '<meta http-equiv="refresh" content="1;url=forum.php"/>';
	}
}
//Liste des messages
function liste_msg_fofo($id_sujet,$id_page){
	$pagination = 5;
	if( isset($id_page) && is_numeric($id_page) ){
		$page = $id_page;
	}else{
		$page = 1;
	}
	$limit_start = ($page - 1) * $pagination;



	//comptage pour pagination



	$nb_total = mysql_query("SELECT COUNT(*) AS nb_total FROM forum_message WHERE id_topic=$id_sujet");



	$nb_total = mysql_fetch_array($nb_total);



	$nb_total = $nb_total['nb_total'];



	$nb_pages = ceil($nb_total / $pagination);



	



	



	$sql2 = mysql_query("SELECT description FROM forum_topic WHERE id_topic=$id_sujet ");



	$data2 = mysql_fetch_array($sql2);



	



	echo '<div class="categorie">// '.ucfirst($data2['description']).'<div class="pages">Page '.$page.' sur '.$nb_pages.'</div></div><br>';



	



	$sql = mysql_query("SELECT * FROM forum_message WHERE id_topic=$id_sujet ORDER BY date ASC LIMIT $limit_start,$pagination");



	while($data = mysql_fetch_array($sql)){



	        $sql2 = mysql_query("SELECT * FROM utilisateur WHERE id_user='".$data['auteur']."'");



			$data2 = mysql_fetch_array($sql2);



			



			$a_message = '<table width="100%" border="0" cellspacing="0" cellpadding="0">';



			$a_message .= '<tr>';



			$a_message .= '<td class="header_fofo">'.date_conversion($data['date']).'</td>';



			$a_message .= '</tr>';



			$a_message .= '</table>';



			$a_message .= '<table width="100%" border="0" cellspacing="0" cellpadding="0" class="fofo">';



			$a_message .= '<tr>';



			$a_message .= '<td width="150" class="infos_user" style="font-size:14px; color:#5ab500;"><p><a href="profil.php?user='.$data2['id_user'].'"><img src="'.return_info_user($data2['id_user'],'avatar').'" width="77" height="88" alt="avatar" /></a></p><p>'.$data2['Prenom'].' '.$data2['Nom'].'</p></td>';



			$a_message .= '<td class="message_fofo" valign="top">'.ucfirst($data['message']).'</td>';



			$a_message .= '</tr>';



			$a_message .= '</table>';



			echo $a_message;



	}



	



	    //pagination des messages



		echo '<div class="pagination">';



		for ($i = 1 ; $i <= $nb_pages ; $i++) {



			if ($i == $page ){



				echo ' <div class="item_hover">'.$i.'</div> ';



			}else{



				echo ' <a href="?page='.$i.'&id='.$id_sujet.'&section=l_topic"><div class="item">'.$i.'</div></a> ';



			}



		}



		echo '</div>';



}







//creer new topic

function new_topic_fofo($send,$id_sujet,$page,$titre,$contenu,$auteur){

	if($titre == 'Titre du topic' or empty($titre)){

		$titre_rappel = 'Titre du topic';

	}else{

		$titre_rappel = $titre;

	}





	if($send and !empty($titre) and $titre != 'Titre du topic' and !empty($contenu)){

		mysql_query("INSERT INTO forum_topic VALUES('','".$id_sujet."','".$auteur."','".ucfirst(addslashes($titre))."')");

		$id_topic = mysql_insert_id();

		$date = time();

		//remplace mots illicites

	    $contenu = remplace($contenu);



		mysql_query("INSERT INTO forum_message VALUES('','".$auteur."','".addslashes(nl2br($contenu))."','".$date."','".$id_topic."')");

		echo '<div class="erreur_vert" style="margin-top:10px;">Topic crée avec succés.</div><br>';

		echo '<meta http-equiv="refresh" content="4;url=?id='.$id_sujet.'&section=l_sujet"/>';

	}else{

		if($send and empty($titre) or $titre == 'Titre du topic'){

			echo '<div class="erreur_rouge" style="margin-top:10px;">Veuillez renseigner un titre !</div><br><br>';

		}elseif($send and empty($contenu)){

			echo '<div class="erreur_rouge" style="margin-top:10px;">Veuillez renseigner le contenu du topic !</div><br><br>';

		}else{

		}

		$sql = mysql_query('SELECT titre FROM forum_sujet WHERE id_sujet='.$id_sujet.'');

		$data = mysql_fetch_array($sql);

		//html

		echo '

		<div id="mod_newMSG">

		<form action="?id='.$id_sujet.'&section=l_sujet&action=new" method="post" enctype="multipart/form-data" name="NewMSG">

		 <table width="750" border="0" align="center" cellpadding="0" cellspacing="20">

		  <tr>

		   <td align="left">

		   <input name="titre" type="text" id="titre" onfocus="if (this.value == \''.$titre_rappel.'\') { this.value = \'\'; }" onblur="if (this.value == \'\') { this.value = \''.$titre_rappel.'\'; }" value="'.$titre_rappel.'" size="30"  />

		   </td>

		   <td align="right">

		   <input name="sujet" type="text" id="sujet" value="Categorie: '.ucfirst($data['titre']).'" size="50" readonly="readonly"  />

		   <input name="send" type="hidden" id="send" value="send_ok" />

		   </td>

		  </tr>

		 </table>

		 <table width="750" border="0" align="center" cellpadding="0" cellspacing="20">

		  <tr>

		   <td>

		    <textarea name="contenu" rows="8" id="contenu"></textarea></td>

		  </tr>

          <tr>

		   <td align="right"><input name="envooi" type="submit" class="btn" id="envooi" value=" " /></td>

		  </tr>

		 </table>

		</form>

		</div>';

	}

}



//creer un sujet

function add_sujet($id,$id_cat,$auteur,$titre,$action){

	if(!empty($id_cat) and !empty($auteur) and !empty($titre) and isadmin($id) and $action == 'add_suj'){

		mysql_query("INSERT INTO forum_sujet VALUES('','".$id_cat."','".$auteur."','".$titre."')");

	}

}



//creer une categorie

function add_cat($id,$titre,$action){

	if(!empty($id) and !empty($titre) and isadmin($id) and $action == 'add_cat'){

		mysql_query("INSERT INTO forum_categorie VALUES('','".$titre."'')");

	}

}



//modif infos perso

function update_data($id,$nom,$prenom,$email,$mdp,$n_mdp,$phone,$adresse,$ville,$cp,$loisirs){



	if(!empty($id) && !empty($nom) && !empty($prenom) && !empty($email) && $mdp != 'Mot de passe' ){



		$sql = mysql_query("SELECT * FROM utilisateur WHERE id_user='".$id."'");



		$data = mysql_fetch_array($sql);



		//verif si bon mdp



		if(sha1(md5($mdp)) == $data['Mot_de_passe']){



			if(!empty($n_mdp)){



				mysql_query("UPDATE utilisateur SET Nom='".ucfirst($nom)."', Prenom='".ucfirst($prenom)."', Mail='".$email."', Telephone='".wordwrap($phone,2," ",1)."', Adresse='".$adresse."', ville='".ucfirst($ville)."', code_postal='".$cp."', loisirs='".$loisirs."', Mot_de_passe='".sha1(md5($n_mdp))."' WHERE id_user='".$id."'");

			}else{



				mysql_query("UPDATE utilisateur SET Nom='".ucfirst($nom)."', Prenom='".ucfirst($prenom)."', Mail='".$email."', Telephone='".wordwrap($phone,2," ",1)."', Adresse='".$adresse."', ville='".ucfirst($ville)."', code_postal='".$cp."', loisirs='".$loisirs."' WHERE id_user='".$id."'");

			}



			echo '<div class="erreur_vert" style="margin-top:-5px; margin-bottom:10px;">Informations mises à jour !</div>';



		}else{



			echo '<div class="erreur_rouge" style="margin-top:-5px; margin-bottom:10px;">Mauvais mot de passe !</div>';



		}



	}elseif($mdp == 'Mot de passe'){



		echo '<div class="erreur_rouge" style="margin-top:-5px; margin-bottom:10px;">Veuillez saisir votre mot de passe !</div>';



	}else{ }



}







// Affichage interrupteurs



function aff_interrupteurs($id,$request){



	if(!empty($id) && !empty($request)){



		$sql = mysql_query("SELECT $request FROM utilisateur WHERE id_user=$id");



		$data = mysql_fetch_array($sql);



		



		if($data[$request]){



			echo "ON";



		}else{



			echo "OFF";



		}



		



	}



}



// Affichage interrupteurs



function proc_interrupteurs($id,$url){



	if(!empty($id) && !empty($url)){



		$sql = mysql_query("SELECT $url FROM utilisateur WHERE id_user=$id");



		$data = mysql_fetch_array($sql);



		if($data[$url]){



			mysql_query("UPDATE utilisateur SET $url='0' WHERE id_user=$id");



		}else{



			mysql_query("UPDATE utilisateur SET $url='1' WHERE id_user=$id");



		}		



	}



}





//list files

function list_files($id,$page){

	

		$html  = '<table width="100%" border="0" cellspacing="0">';

        $html .= '<tr bgcolor="#000000" style="color:#FFF; font-size:14px;">';

        $html .= '<td width="7%" height="30" valign="middle">&nbsp;&nbsp;Nom</td>';

        $html .= '<td width="37%" height="30" valign="middle">&nbsp;&nbsp;</td>';

        $html .= '<td width="19%" align="left" valign="middle">Type</td>';

        $html .= '<td width="22%" align="left" valign="middle">Modification</td>';

        $html .= '<td width="5%">&nbsp;</td>';

        $html .= '<td width="5%">&nbsp;</td>';

        $html .= '<td width="5%">&nbsp;</td>';

        $html .= '</tr>';

		

		$sql = mysql_query("SELECT * FROM stocke a, stockage b WHERE a.id_fichier=b.id_fichier AND a.id_user='".$id."'");

	

		if(mysql_num_rows($sql)){

		echo $html;

		while($data = mysql_fetch_array($sql)){

	    	$s = mysql_query("SELECT * FROM stocke a, stockage b WHERE a.id_fichier=b.id_fichier AND a.id_fichier='".$data['id_fichier']."' AND a.auth='1'");

			$data2 = mysql_fetch_array($s);
			if($data2['id_user'] != $id){

			$var = ' de <a href="profil.php?user='.$data2['id_user'].'">'.return_info_user($data2['id_user'],'Prenom').' '.return_info_user($data2['id_user'],'Nom').'</a>';

			}else{
			$var = '';
			}

			

			$groupe = '<img src="tpl/img/groupe.jpg" height="21" alt="group" />';

			

			$ctn  = '<tr style="font-size:15px;">';

            $ctn .= '<td height="40" valign="bottom">&nbsp;&nbsp;<img src="tpl/img/pdf.jpg" width="27" height="32" alt="format" /></td>';

			$ctn .= '<td height="40" align="left" valign="middle">'.ucfirst($data['nom_fichier']).''.$var.'</td>';

            $ctn .= '<td>'.date("d/m/Y",$data['date']).' '.date("H:i",$data['date']).'</td>';

            $ctn .= '<td>'.date("d/m/Y",$data['date']).' '.date("H:i",$data['date']).'</td>';

            $ctn .= '<td align="center" valign="middle"><a href="hdd-partage.php?file='.$data['id_fichier'].'">'.$groupe.'</a></td>';

            $ctn .= '<td align="center" valign="middle"><a  target="_blank" href="./'.$data['lien'].'"><img src="tpl/img/download.gif" height="20" alt="download" /></a></td>';

            $ctn .= '<td align="center" valign="middle"><a href="?file='.$data['id_fichier'].'&u='.$data['id_user'].'&action=delete&files='.$page.'"><img src="tpl/img/trash.png" height="21" alt="group" /></a></td>';

			$ctn .= '</tr>';

			echo $ctn;

		}

		echo '</table>';

		}else{

			echo '<div class="erreur_vert" style="margin-top:10px;">Aucun fichier partagé avec moi dans le cloud</div>';

		}



}

//list files partagees avec moi

function list_files_share_me($id,$page){

	

		$html  = '<table width="100%" border="0" cellspacing="0">';

        $html .= '<tr bgcolor="#000000" style="color:#FFF; font-size:14px;">';

        $html .= '<td width="7%" height="30" valign="middle">&nbsp;&nbsp;Nom</td>';

        $html .= '<td width="37%" height="30" valign="middle">&nbsp;&nbsp;</td>';

        $html .= '<td width="19%" align="left" valign="middle">Type</td>';

        $html .= '<td width="22%" align="left" valign="middle">Modification</td>';

        $html .= '<td width="5%">&nbsp;</td>';

        $html .= '<td width="5%">&nbsp;</td>';

        $html .= '<td width="5%">&nbsp;</td>';

        $html .= '</tr>';

		

		$sql = mysql_query("SELECT * FROM stocke a, stockage b WHERE a.id_fichier=b.id_fichier AND a.id_user='".$id."' AND a.auth='0'");

	

		if(mysql_num_rows($sql)){

		echo $html;

		while($data = mysql_fetch_array($sql)){

	    	$s = mysql_query("SELECT * FROM stocke a, stockage b WHERE a.id_fichier=b.id_fichier AND a.id_fichier='".$data['id_fichier']."' AND a.auth='1'");

			$data2 = mysql_fetch_array($s);

			

			$groupe = '<img src="tpl/img/groupe.jpg" height="21" alt="group" />';

			

			$ctn  = '<tr style="font-size:15px;">';

            $ctn .= '<td height="40" valign="bottom">&nbsp;&nbsp;<img src="tpl/img/pdf.jpg" width="27" height="32" alt="format" /></td>';

			$ctn .= '<td height="40" align="left" valign="middle">'.ucfirst($data['nom_fichier']).' de <a href="profil.php?user='.$data2['id_user'].'">'.return_info_user($data2['id_user'],'Prenom').' '.return_info_user($data2['id_user'],'Nom').'</a></td>';

            $ctn .= '<td>'.date("d/m/Y",$data['date']).' '.date("H:i",$data['date']).'</td>';

            $ctn .= '<td>'.date("d/m/Y",$data['date']).' '.date("H:i",$data['date']).'</td>';

            $ctn .= '<td align="center" valign="middle"><a href="hdd-partage.php?file='.$data['id_fichier'].'">'.$groupe.'</a></td>';

            $ctn .= '<td align="center" valign="middle"><a  target="_blank" href="./'.$data['lien'].'"><img src="tpl/img/download.gif" height="20" alt="download" /></a></td>';

            $ctn .= '<td align="center" valign="middle"><a href="?file='.$data['id_fichier'].'&u='.$data['id_user'].'&action=delete&files='.$page.'"><img src="tpl/img/trash.png" height="21" alt="group" /></a></td>';

			$ctn .= '</tr>';

			echo $ctn;

		}

		echo '</table>';

		}else{

			echo '<div class="erreur_vert" style="margin-top:10px;">Aucun fichier partagé avec moi dans le cloud</div>';

		}

}



//list files partagees 

function list_files_shared($id,$page){
		$html  = '<table width="100%" border="0" cellspacing="0">';
        $html .= '<tr bgcolor="#000000" style="color:#FFF; font-size:14px;">';
        $html .= '<td width="7%" height="30" valign="middle">&nbsp;&nbsp;Nom</td>';
        $html .= '<td width="37%" height="30" valign="middle">&nbsp;&nbsp;</td>';
        $html .= '<td width="19%" align="left" valign="middle">Type</td>';
        $html .= '<td width="22%" align="left" valign="middle">Modification</td>';
        $html .= '<td width="5%">&nbsp;</td>';
        $html .= '<td width="5%">&nbsp;</td>';
        $html .= '<td width="5%">&nbsp;</td>';
        $html .= '</tr>';
		

	echo $html;
	$sea = mysql_query("SELECT * FROM stocke WHERE id_user='".$id."' AND auth='1'");
	while($req = mysql_fetch_array($sea)){
	
	$sql = mysql_query("SELECT * FROM stocke a, stockage b WHERE a.id_fichier=b.id_fichier AND a.id_fichier='".$req['id_fichier']."' AND a.auth='0' ORDER BY b.date DESC");
		while($data = mysql_fetch_array($sql)){
			$ctn  = '<tr style="font-size:15px;">';
            $ctn .= '<td height="40" valign="bottom">&nbsp;&nbsp;<img src="tpl/img/pdf.jpg" width="27" height="32" alt="format" /></td>';
			$ctn .= '<td height="40" align="left" valign="middle">'.ucfirst($data['nom_fichier']).' avec <a href="profil.php?user='.$data['id_user'].'">'.return_info_user($data['id_user'],'Prenom').' '.return_info_user($data['id_user'],'Nom').'</a></td>';
            $ctn .= '<td>'.date("d/m/Y",$data['date']).' '.date("H:i",$data['date']).'</td>';
            $ctn .= '<td>'.date("d/m/Y",$data['date']).' '.date("H:i",$data['date']).'</td>';
            $ctn .= '<td align="center" valign="middle"><a href="hdd-partage.php?file='.$data['id_fichier'].'">'.$groupe.'</a></td>';
            $ctn .= '<td align="center" valign="middle"><a  target="_blank" href="./'.$data['lien'].'"><img src="tpl/img/download.gif" height="20" alt="download" /></a></td>';
            $ctn .= '<td align="center" valign="middle"><a href="?file='.$data['id_fichier'].'&u='.$data['id_user'].'&action=delete&files='.$page.'"><img src="tpl/img/trash.png" height="21" alt="group" /></a></td>';
			$ctn .= '</tr>';
			echo $ctn;
		}
	}
	echo '</table>';
}


//delete fichier
function del_fichier($id,$id_fichier,$action,$u){
	if(!empty($id) and !empty($id_fichier) and $action == 'delete'){
		
		$req = mysql_query("SELECT * FROM stocke WHERE id_fichier='".$id_fichier."' AND auth='1'");
		$verif = mysql_fetch_array($req);

		$req2 = mysql_query("SELECT s.auth, st.lien FROM stocke s, stockage st WHERE s.id_fichier=st.id_fichier AND s.id_user='".$u."' AND s.id_fichier='".$id_fichier."'");
		$data = mysql_fetch_array($req2);
		
		if($verif['id_user'] == $id){
		if($data['auth']){
			mysql_query('DELETE FROM stocke WHERE id_fichier='.$id_fichier.'');
		}else{
			mysql_query('DELETE FROM stocke WHERE id_fichier='.$id_fichier.' and id_user='.$u.'');
		}
		}else{
			mysql_query('DELETE FROM stocke WHERE id_fichier='.$id_fichier.' and id_user='.$id.'');
		}
		
	}
}

//partage fichier
function partage_file($id,$file,$user){
	if(empty($user)){
		$req = mysql_fetch_array(mysql_query("SELECT * FROM stocke s, stockage st WHERE s.id_fichier=st.id_fichier AND s.id_fichier='".$file."'"));
		echo 'Partager le fichier &laquo; '.$req['nom_fichier'].' &raquo; avec :';
	}else{
		
	$req2 = mysql_query("SELECT * FROM stocke WHERE id_fichier='".$file."'");
	$verif = mysql_fetch_array($req2);
	if($verif){
		$verif = mysql_fetch_array(mysql_query("SELECT * FROM stocke WHERE id_fichier='".$file."' AND id_user='".$user."'"));
		if(!$verif){
		echo 'Partagée !';
		mysql_query("INSERT INTO stocke VALUES('".$user."','".$file."','0')");
		$contenu = '<a href="hdd.php">'.return_info_user($id,'Prenom').' '.return_info_user($id,'Nom').' à partagé un fichier avec vous le '.date("d/m/Y H:i").'</a>';
		mysql_query("INSERT INTO notifications VALUES('','".time()."','".$contenu."','partage_fichier','".$id."','".$user."','0')");
		}else{
		echo 'Déja partagée !';
		}
	}
	
	}
}


?>