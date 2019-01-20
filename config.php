<?php
  $hostname = "127.0.0.1";
  $user = "root";
  $pass = "";
  $dbname = "radius";
  $connect = mysqli_connect($hostname,$user,$pass,$dbname) or die ('ไม่สามารถเชื่อต่อได้');
  $connect->query("SET NAMES UTF8");
  $Year = date("Y")+543;
 ?>
 <link rel="stylesheet" href="css/bootstrap.min.css">
