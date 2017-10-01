  <div id="header"> 

    <div id="logo"><a href="index.php"><img src="tpl/img/logo.jpg" width="127" height="37" alt="EBDL"></a></div>

    <div id="menu">

     <ul> 

      <li><a href="index.php">accueil</a></li>

      <?php 

	  if(empty($_SESSION['id'])){

		  echo '<li><a href="connexion.php">connexion</a></li>';

		  echo '<li><a href="inscription.php">inscription</a></li>';

	  }else{

		  echo '<li><a href="profil.php">profil</a></li>';

		  echo '<li><a href="?action=logout">déconnexion</a></li>';
	  }

	  ?>

      

      <li><a href="contact.php">contact</a></li>

     </ul>

    </div>

    <div class="clear"></div>

  </div>

