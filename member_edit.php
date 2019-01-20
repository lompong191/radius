<?php
  include 'config.php';
  include 'systemmenu.php';
  $sql = "SELECT * FROM people WHERE people_id ='$_REQUEST[people_id]'";
  $sqlquery = $connect->query($sql);
  while ($row = mysqli_fetch_array($sqlquery)) {
    $people_id = $row['people_id'];
    $people_name = $row['people_name'];
    $people_surname = $row['people_surname'];
    $sex_id = $row['sex_id'];
    $people_email = $row['people_email'];
    $people_tel = $row['people_tel'];
    $people_mobile = $row['people_mobile'];
    $people_user = $row['people_user'];
    $people_pass = $row['people_pass'];
    $people_birthdate = $row['people_birthdate'];
    $usergrp_id = $row['usergrp_id'];

  }
 ?>
 <body>
   <div class="container">
     <form class="" action="index.html" method="post">
     <div class="row">
       <div class="col-md-5">
         <label for="">แก้ไขข้อมูล</label>
       </div>
     </div>
     <div class="row">
       <div class="col-md-5">
         <label for="">รหัสประจำตัวประชาชน :</label>
       </div>
       <div class="col-md-7">
         <?php echo $people_id; ?>
         <input type="hidden" name="people_id" value="<?=$people_id?>">
       </div>
     </div>
     <div class="row">
       <div class="col-md-5">
         <label for="">ชื่อ :</label>
       </div>
       <div class="col-md-7">
         <input type="text" name="people_name" value="<?=$people_name ?>">
       </div>
     </div>
     <div class="row">
       <div class="col-md-5">
         <label for="">นามสกุล :</label>
       </div>
       <div class="col-md-7">
         <input type="text" name="people_surname" value="<?=$people_surname ?>">
       </div>
     </div>
     <div class="row">
       <div class="col-md-5">
         <label for="">เพศ :</label>
       </div>
       <div class="col-md-7">
         <input type="radio" name="sex_id" value="1" <?php if ($sex_id == 1){echo "checked";}?>> ชาย
         <input type="radio" name="sex_id" value="2" <?php if ($sex_id == 2){echo "checked";}?>> หญิง
       </div>
     </div>
     <div class="row">
       <div class="col-md-5">
         <label for="">วันเดือนปีเกิด :</label>
       </div>
       <div class="col-md-7">
         <?php
         $people_birthdate = explode("-","$people_birthdate");
         $monthss = $people_birthdate['1'];
         $datess = $people_birthdate['2'];
         $yearss = $people_birthdate['0']+543;
         $year_name = "years";
				 $month_name = "months";
				 $date_name = "dates";
         include 'function_date.php';
          ?>
       </div>
     </div>
     <div class="row">
       <div class="col-md-5">
         <label for="">กลุ่มผู้ใช้งาน :</label>
       </div>
       <div class="col-md-7">
         <select class="" name="usergrp_id">
           <?php
            $sql = "SELECT * FROM usergrp ORDER BY usergrp_id";
            $sqlquery = $connect->query($sql);
            while ($row=mysqli_fetch_array($sqlquery)) {
              if ($usergrp_id == $row['usergrp_id']) {
                $check = "selected";
              }else {
                $check = "";
              }
              ?>
              <option value="<?=$usergrp_id?>" <?= $check ?>><?php echo $row['usergrp_name'] ?></option>
              <?php
            }
            ?>
         </select>
       </div>
     </div>
     <div class="row">
       <div class="col-md-5">
         <label for="">อีเมล์ :</label>
       </div>
       <div class="col-md-7">
         <input type="text" name="people_email" value="<?=$people_email ?>">
       </div>
     </div>
     <div class="row">
       <div class="col-md-5">
         <label for="">หมายเลขโทรศัพท์ (บ้าน) :</label>
       </div>
       <div class="col-md-7">
         <input type="text" name="people_tel" value="<?=$people_tel ?>">
       </div>
     </div>
     <div class="row">
       <div class="col-md-5">
         <label for="">หมายเลขโทรศัพท์ (มือถือ) :</label>
       </div>
       <div class="col-md-7">
         <input type="text" name="people_mobile" value="<?=$people_mobile ?>">
       </div>
     </div>
<?php
     $sql = "SELECT * FROM radcheck WHERE UserName = '$people_user'";
     $sqlquery = $connect->query($sql);
     $MaxAllSession = '';
     $Expiration = '';
     while ($row=mysqli_fetch_array($sqlquery)) {
       if ($row['Attribute'] == 'User-Password') {
         $UserPassword = $row['Value'];
       }
       if ($row['Attribute'] == 'Max-All-Session'){

    		$MaxAllSession = $row['Value'];
      }

       if ($row['Attribute'] == 'Expiration') {
         $Expiration = $row['Value'];
       }
     }

     $sql = "SELECT * FROM radreply WHERE UserName = '$people_pass'";
     $sqlquery = $connect->query($sql);
     $SessionTimeout = '';
     $IdleTimeout = '';
     while ($row=mysqli_fetch_array($sqlquery)) {
       if ($row['Attribute'] == 'Session-Timeout') {
         $SessionTimeout = $row['Value'];
       }
       if ($row['Attribute'] == 'Idle-Timeout') {
         $IdleTimeout = $row['Value'];
       }
     }
?>
     <hr>
     <div class="row">
       <div class="col-md-5">
         <label for="">ชื่อผู้ใช้งานในการเข้าสู่ระบบ</label>
       </div>
     </div>
     <div class="row">
       <div class="col-md-5">
         <label for="">ชื่อผู้ใช้งาน </label>
       </div>
       <div class="col-md-7">
         <?php echo $people_id; ?>
         <input type="hidden" name="people_user" value="<?=$people_pass ?>">
       </div>
     </div>
     <div class="row">
       <div class="col-md-5">
         <label for="">รหัสผ่าน </label>
       </div>
       <div class="col-md-7">
         <input type="text" name="people_pass" value="<?=$people_pass ?>"><br>
         <small>* อักษรหรือตัวเลข 6 - 15 ตัว</small>
       </div>
     </div>
     <div class="row">
       <div class="col-md-5">
         <label for="">ระยะเวลา</label>
       </div>
       <div class="col-md-7">
         <input type="radio" name="maxsession_type" value="1" checked>ไม่จำกัดเวลา
         <input type="radio" name="maxsession_type" value="2" <?php if ($MaxAllSession != ""){echo "checked";}else{} ?>>จำกัดเวลา
         <input type="text" name="maxsesion_limit" value="<?=$MaxAllSession ?>">
         <select class="" name="timecom_value">
           <?php
            $sql = "SELECT * FROM timecom ORDER BY timecom_id";
            $sqlquery = $connect->query($sql);
            while ($row=mysqli_fetch_array($sqlquery)) {
              ?>
            <option value="<?php echo $row['timecom_value'];?>" <?php echo $check ?>><?php echo $row['timecom_name'] ?></option>
            <?php
            }
            ?>
         </select> *
       </div>
     </div>
     <div class="row">
       <div class="col-md-5">
         <label for="">จำกัดระยะเวลาเมื่อไม่ใช้งาน</label>
       </div>
       <div class="col-md-7">
         <input type="radio" name="idle_type" value="1" checked>ไม่จำกัดเวลา
         <input type="radio" name="idle_type" value="2" <?php if ($IdleTimeout != ""){echo "checked";}else{} ?>>จำกัดเวลา
         <input type="text" name="idle_limit" value="<?=$IdleTimeout ?>">
         <select class="" name="timecom_value">
           <?php
            $sql = "SELECT * FROM timecom ORDER BY timecom_id";
            $sqlquery = $connect->query($sql);
            while ($row=mysqli_fetch_array($sqlquery)) {
              ?>
            <option value="<?php echo $row['timecom_value'];?>" <?php echo $check ?>><?php echo $row['timecom_name'] ?></option>
            <?php
            }
            ?>
         </select>
       </div>
     </div>
     <div class="row">
       <div class="col-md-5">
         <label for="">จำกัดระยะเวลาเข้าใช้งานต่อครั้ง</label>
       </div>
       <div class="col-md-7">
         <input type="radio" name="Session_type" value="1" checked>ไม่จำกัดเวลา
         <input type="radio" name="Session_type" value="2" <?php if ($SessionTimeout != ""){echo "checked";}else{} ?>>จำกัดเวลา
         <input type="text" name="Session_limit" value="<?=$SessionTimeout ?>">
         <select class="" name="timecom_value">
           <?php
            $sql = "SELECT * FROM timecom ORDER BY timecom_id";
            $sqlquery = $connect->query($sql);
            while ($row=mysqli_fetch_array($sqlquery)) {
              ?>
            <option value="<?php echo $row['timecom_value'];?>" <?php echo $check ?>><?php echo $row['timecom_name'] ?></option>
            <?php
            }
            ?>
         </select> *
       </div>
     </div>
     <div class="row">
       <div class="col-md-5">
         <label for="">วันหมดอายุ</label>
       </div>
       <div class="col-md-7">
         <input type="radio" name="exp_type" value="1" checked>ไม่จำกัดวันหมดอายุ
         <input type="radio" name="exp_type" value="2" <?php if ($Expiration != ''){echo "checked";} ?>>จำกัดวันหมดอายุ
        <?php
        if ($Expiration != '') {
          $Expiration = $people_split = split(" ", $Expiration);
          $dates = $Expiration['0'];

          $months = $Expiration['1'];
								if ($months == "Jan"){$months = "1";}
								if ($months == "Feb"){$months = "2";}
								if ($months == "Mar"){$months = "3";}
								if ($months == "Apr"){$months = "4";}
								if ($months == "May"){$months = "5";}
								if ($months == "Jun"){$months = "6";}
								if ($months == "Jul"){$months = "7";}
								if ($months == "Aug"){$months = "8";}
								if ($months == "Sep"){$months = "9";}
								if ($months == "Oct"){$months = "10";}
								if ($months == "Nov"){$months = "11";}
								if ($months == "Dec"){$months = "12";}

								$years = $Expiration['2'];
								$times = $Expiration['3'];
        }else{
          $dates =  date('d');
					$months = date('m');
        }

         ?>
         <select size="1" name="exp_date">
								<?php
								for ($i = 1; $i <= 31; $i++)
								{
									echo '<option value="'.substr('0'.$i, -2).'" '.($dates+0==$i?'selected="selected"':'').'>' . $i . '</option>';
								}
								?>
								</select>
								<select name="exp_months">
								<option value="Jan" <?php if ($months==1){ echo "selected";}else{}?>>มกราคม</option>
								<option value="Feb" <?php if ($months==2){ echo "selected";}else{}?>>กุมภาพันธ์</option>
								<option value="Mar" <?php if ($months==3){ echo "selected";}else{}?>>มีนาคม</option>
								<option value="Apr" <?php if ($months==4){ echo "selected";}else{}?>>เมษายน</option>
								<option value="May" <?php if ($months==5){ echo "selected";}else{}?>>พฤษภาคม</option>
								<option value="Jun" <?php if ($months==6){ echo "selected";}else{}?>>มิถุนายน</option>
								<option value="Jul" <?php if ($months==7){ echo "selected";}else{}?>>กรกฎาคม</option>
								<option value="Aug" <?php if ($months==8){ echo "selected";}else{}?>>สิงหาคม</option>
								<option value="Sep" <?php if ($months==9){ echo "selected";}else{}?>>กันยายน</option>
								<option value="Oct" <?php if ($months==10){ echo "selected";}else{}?>>ตุลาคม</option>
								<option value="Nov" <?php if ($months==11){ echo "selected";}else{}?>>พฤศจิกายน</option>
								<option value="Dec" <?php if ($months==12){ echo "selected";}else{}?>>ธันวาคม</option>
								</select>

								<?php

								$yearss1 = $Year;
								$yearss2 = $Year+1;
								$yearss3 = $Year+2;

								$years1 = $Year-543;
								$years2 = $Year+1-543;
								$years3 = $Year+2-543;


								if ($years==$years1){ $selected1 = "selected" ;}else{}
								if ($years==$years2){ $selected2 = "selected" ;}else{}
								if ($years==$years3){ $selected3 = "selected" ;}else{}
                  ?>
                  <select name="exp_years">
                    <option value='<?php echo $years1?>'><?=$yearss1?></option>
                    <option value='<?php echo $years2?>'><?=$yearss2?></option>
                    <option value='<?php echo $years3?>'><?=$yearss3?></option>
                  </select>
                  เวลา:นาที:วินาที <input type="text" name="exp_time"   size="6" value="<?php if ($times==''){echo '12:00:00';}else{echo $times;}?>">
       </div>
     </div>
     <input type="submit" name="submit" value="แก้ไขข้อมูล"><input type="submit" name="submit" value="ยกเลิก">
   </form>
   </div>
 </body>
