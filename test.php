<?php
  include 'config.php';
  $id = '1';
  $sql = "SELECT * FROM radgroupcheck WHERE id = '$id'";
  $sqlquery = $connect->query($sql);
  while ($rows = mysqli_fetch_array($sqlquery,MYSQL_ASSOC)) {
    echo $rows['Attribute'];
  }

 ?>
