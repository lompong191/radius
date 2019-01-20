<?php
  session_start();
  if ($_SESSION['login'] == 1){}else{header("Location:login.php");}
  include 'config.php';
  include 'systemmenu.php';
 ?>
