<?php
  session_start();
  include 'config.php';
 ?>
 <body>
   <?php
   if ($_POST['submit'] == 'ยกเลิก') {
     $_SESSION['people_id_select'] = "";
     $_SESSION['code_error'] = "";
     echo "ยกเลิก";
   }else {

     $people_birthdate = "$_REQUEST[years]/$_REQUEST[months]/$_REQUEST[dates]";

     $people_id = $_POST['people_id'];
     $people_pass = $_POST['people_pass'];
     $people_name = $_POST['people_name'];
     $people_surname = $_POST['people_surname'];
     $sex_id = $_POST['sex_id'];
     $usergrp_id = $_POST['usergrp_id'];
     $people_email = $_POST['people_email'];
     $people_tel = $_POST['people_tel'];
     $people_mobile = $_POST['people_mobile'];

     $sql = "INSERT INTO people (people_id,people_name,people_surname,sex_id,people_email,people_tel,people_mobile,people_user,people_pass,people_birthdate,usergrp_id)".
                "VALUES ('$people_id','$people_name','$people_surname','$sex_id','$people_email','$people_tel','$people_mobile','$people_id','$people_pass','$people_birthdate','$usergrp_id')";
     $sqlquery = $connect->query($sql);

     $sql2 = "INSERT INTO radcheck (UserName,Attribute,op,Value) VALUES ('$people_id','User-Password',':=','$people_pass')";
     $sqlquery2 = $connect->query($sql2);

     $sql3 = "INSERT INTO radcheck (UserName,Attribute,op,Value) VALUES ('$people_id','Simultaneous-Use',':=','1')";
     $sqlquery3 = $connect->query($sql3);

     $exp_type = $_POST['exp_type'];
     $exp_date = $_POST['exp_date'];
     $exp_months = $_POST['exp_months'];
     $exp_years = $_POST['exp_years'];
     $exp_time = $_POST['exp_time'];
     if ($exp_type == '1') {}else {
       $exp_limit = "$exp_date $exp_months $exp_years $exp_time";
       $sql4 = "INSERT INTO radcheck (UserName,Attribute,op,Value) VALUES ('$people_id','Expiration',':=','$exp_limit')";
       $sqlquery4 = $connect->query($sql4);
     }


     $sql5 = "SELECT * FROM usergrp WHERE usergrp_id = '$usergrp_id'";
     $sqlquery5 = $connect->query($sql5);

     while ($row = mysqli_fetch_array($sqlquery5 , MYSQL_ASSOC)) {
       $maxsession = $row['maxsession'];
       $session = $row['session'];
       $idle = $row['idle'];
       $maxdown = $row['maxdown'];
       $maxup = $row['maxup'];

         if ($maxsession == '0'){} else{
           $sql = "INSERT INTO radcheck (UserName,Attribute,op,Value) VALUES ('$people_id','Max-All-Session',':=','$maxsession')";
           $sqlquery = $connect->query($sql);
         }
          if ($session == '0'){} else{
            $sql = "INSERT INTO radreply (UserName,Attribute,op,Value) VALUES ('$people_id','Session-Timeout',':=','$session')";
            $sqlquery = $connect->query($sql);
          }
          if ($idle == '0'){} else{
            $sql = "INSERT INTO radreply (UserName,Attribute,op,Value) VALUES ('$people_id','Idle-Timeout',':=','$idle')";
            $sqlquery = $connect->query($sql);
          }
          if ($maxdown == '0'){} else{
            $sql = "INSERT INTO radreply (UserName,Attribute,op,Value) VALUES ('$people_id','WISPr-Bandwidth-Max-Down',':=','$maxdown')";
            $sqlquery = $connect->query($sql);
          }
          if ($maxup == '0'){} else{
            $sql = "INSERT INTO radreply (UserName,Attribute,op,Value) VALUES ('$people_id','WISPr-Bandwidth-Max-Up',':=','$maxup')";
            $sqlquery = $connect->query($sql);
          }

     }

     $_SESSION['people_id_select'] = "";
     $_SESSION['code_error'] = "";
   }
    ?>
    <?php
echo "<meta http-equiv=\"refresh\" content=\"1; URL=member_new.php\">";
?>
 </body>
