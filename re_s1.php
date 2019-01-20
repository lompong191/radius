<?php
  session_start();
  include 'config.php';
  $people_id = $_REQUEST['people_id'];

  $sql= "SELECT * FROM people WHERE people_id='$people_id'";
  $sqlquery = $connect->query($sql);
  // if (mysqli_num_rows($sqlq) >= 1) {
  //   echo "มีข้อมูล";
  // }else {
  //   echo "ไม่มีข้อมูล";
  // }

  if (mysqli_num_rows($sqlquery) >= 1) {
    echo "<meta http-equiv=\"refresh\" content=\"1; URL=member_new.php\">";
  			$code_error="<center><br><font color=\"red\">รหัสประจำตัวประชาชน ไม่สามารถใช้ได้</font>";
  			$_SESSION['code_error'] = $code_error;
  }else{
  			echo "<meta http-equiv=\"refresh\" content=\"1; URL=member_new.php\">";
  			$people_id_select=$_REQUEST['people_id'];
  			$_SESSION['people_id_select'] = $people_id_select;
  }

 ?>
