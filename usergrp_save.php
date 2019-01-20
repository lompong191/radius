<?php
  include 'config.php';
  $id = $_POST['id'];
  $name = $_POST['name'];
  // $sql = "INSERT INTO radgroupcheck (GroupName,Attribute,op,Value) VALUES ('$name','Auth-Type',':=','Local')";
  // $sqlquery = $connect->query($sql);

  $sql = "INSERT INTO usergrp (usergrp_id,usergrp_name) VALUES ('$id','$name')";
  $sqlquery = $connect->query($sql);

  if ($sqlquery) {
    header("Location:usergrp_new.php");
  }else {
    echo "<script>alert('ไม่สามารถเพิ่มข้อมูลได้');</script>";
    echo "<script>window.history.back();</script>";
  }
 ?>
