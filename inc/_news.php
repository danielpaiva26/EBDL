<?php
  session_start();
  require('MySQL.php3');
  require('functions.php');
  if(empty($_GET['state'])){
    flux($_SESSION['id'],$_GET['flux']);
  }else{
    flux_fav($_GET['id']);
  }
?>