<?php
include 'config.php';
session_start();


if ($_SESSION['people_id_select'] == "") {
  include 're_f1.php';
  echo $_SESSION['code_error'];
}else {
  include 're_f2.php';
}
 ?>
