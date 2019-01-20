<?php
  include 'config.php';
  $id = $_SESSION['people_id_select'];
  include 'systemmenu.php';
 ?>
 <body>
   <form class="" action="re_s2.php" method="post">
   <div class="container">
     <div class="row">
       <label for="">เพิ่มสมาชิกใหม่</label>
     </div>
     <div class="row">
       <div class="col-md-3">
         <label for="">รหัสประจำตัวประชาชน :</label>
       </div>
       <div class="col-md-3">
         <label for=""><?php echo $id; ?></label>
         <input type="hidden" name="people_id" value="<?php echo $id ?>">
       </div>
     </div>
     <div class="row">
       <div class="col-md-3">
         <label for="">ชื่อ : </label>
       </div>
       <div class="col-md-3">
         <input type="text" name="people_name" value=""> *
       </div>
     </div>
     <div class="row">
       <div class="col-md-3">
         <label for="">นามสกุล : </label>
       </div>
       <div class="col-md-3">
         <input type="text" name="people_surname" value=""> *
       </div>
     </div>
     <div class="row">
       <div class="col-md-3">
         <label for="">เพศ : </label>
       </div>
       <div class="col-md-3">
         <input type="radio" name="sex_id" value="1" checked> ชาย
         <input type="radio" name="sex_id" value="2"> หญิง
       </div>
     </div>
     <div class="row">
       <div class="col-md-3">
         <label for="">วันเดือนปีเกิด</label>
       </div>
       <div class="col-md-3">
          <select size="1" name="dates">
          <?php
          for ($i = 1; $i <= 31; $i++)
          	{
          		echo '<option value="'.substr('0'.$i, -2).'" '.($datess+0==$i?'selected="selected"':'').'>' . $i . '</option>';
            }
          ?>
          </select>
          <?php
          $monthss = date('m');
           ?>
          <select size="1" name="months" >
          																		<option value="1" <?php if ($monthss==1){ echo "selected";}else{}?>>มกราคม</option>
          																		<option value="2" <?php if ($monthss==2){ echo "selected";}else{}?>>กุมภาพันธ์</option>
          																		<option value="3" <?php if ($monthss==3){ echo "selected";}else{}?>>มีนาคม</option>
          																		<option value="4" <?php if ($monthss==4){ echo "selected";}else{}?>>เมษายน</option>
          																		<option value="5" <?php if ($monthss==5){ echo "selected";}else{}?>>พฤษภาคม</option>
          																		<option value="6" <?php if ($monthss==6){ echo "selected";}else{}?>>มิถุนายน</option>
          																		<option value="7" <?php if ($monthss==7){ echo "selected";}else{}?>>กรกฎาคม</option>
          																		<option value="8" <?php if ($monthss==8){ echo "selected";}else{}?>>สิงหาคม</option>
          																		<option value="9" <?php if ($monthss==9){ echo "selected";}else{}?>>กันยายน</option>
          																		<option value="10" <?php if ($monthss==10){ echo "selected";}else{}?>>ตุลาคม</option>
          																		<option value="11" <?php if ($monthss==11){ echo "selected";}else{}?>>พฤศจิกายน</option>
          																		<option value="12" <?php if ($monthss==12){ echo "selected";}else{}?>>ธันวาคม</option>
          																		</select>

                                              <?php
                                              																		echo "<select size='' name='years'>";
                                              																		for ($i = $Year; $i >= $Year - 100; $i--)
                                              																		{
                                              																			$years = $i-543;
                                              																			echo '<option value="'.$years.'" '.($yearss+0==$i?'selected="selected"':'').'>' . $i . '</option>';
                                              																		}
                                              																		echo " </select>";
                                              																		?>

       </div>
     </div>
     <div class="row">
       <div class="col-md-3">
         <label for="">กลุ่มผู้ใช้งาน :</label>
       </div>
       <div class="col-md-3">
        <select class="" name="usergrp_id">
           <?php
            $sql = "SELECT * FROM usergrp ORDER BY usergrp_id";
            $sqlquery = $connect->query($sql);
            while ($row = mysqli_fetch_array($sqlquery, MYSQL_ASSOC)) {
            ?>
            <option value="<?php echo $row['usergrp_id'] ?>"><?php echo $row['usergrp_name'];?></option>
            <?php
            }
            ?>
         </select>
       </div>
     </div>
     <div class="row">
       <div class="col-md-3">
         <label for="">อีเมล์ :</label>
       </div>
       <div class="col-md-3">
         <input type="text" name="people_email" value="">
       </div>
     </div>
     <div class="row">
       <div class="col-md-3">
         <label for="">หมายเลขโทรศัพท์ (บ้าน) :</label>
       </div>
       <div class="col-md-3">
         <input type="text" name="people_tel" value="">
       </div>
     </div>
     <div class="row">
       <div class="col-md-3">
         <label for="">หมายเลขโทรศัพท์ (มือถือ) :</label>
       </div>
       <div class="col-md-3">
         <input type="text" name="people_mobile" value="">
       </div>
     </div>
     <div class="row" style="border-top:1px solid #ccc;margin-top:10px;">
       <label for="">ชื่อผู้ใช้งานในการเข้าสู่ระบบ</label>
     </div>
     <div class="row">
       <div class="col-md-3">
         <label for="">ชื่อผู้ใช้งาน</label><br>
       </div>
       <div class="col-md-7">
         <label for=""><?php echo $id; ?></label><br>
         <small>* ระบบกำหนดให้อัตโนมัติ โดยใช้รหัรหัสประจำตัวประชาชน สามารถเปลี่ยนได้ในภายหลัง</small>
       </div>
     </div>
     <div class="row">
       <div class="col-md-3">
         <label for="">รหัสผ่าน</label>
       </div>
       <div class="col-md-8">
         <input type="text" name="people_pass" value="<?php echo $id;?>"><br>
         <small>* ตัวอักษรหรือตัวเลข 6-15 ตัว</small>
       </div>
     </div>
     <div class="row">
       <div class="col-md-3">
         <label for="">วันหมดอายุ</label>
       </div>
       <div class="col-md-9">
         <input type="radio" value="1" name="exp_type" checked>ไม่จำกัดวันหมดอายุ
                    <input type="radio" name="exp_type" value="2"> จำกัดวันหมดอายุ

                    <?php
                    $dates =  date("d");
                    $months = date("m");

                    ?>

                    <select size="1" name="exp_date" class="SELECT">
                    <?php
                    for ($i = 1; $i <= 31; $i++)
                    {
                      echo '<option value="'.substr('0'.$i, -2).'" '.($dates+0==$i?'selected="selected"':'').'>' . $i . '</option>';
                    }
                    ?>
                    </select>
                    <select size="1" name="exp_months" class="SELECT">
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
                    $years = date("Y");
                    $yearss1 = $Year;
                    $yearss2 = $Year+1;
                    $yearss3 = $Year+2;

                    $years1 = $Year-543;
                    $years2 = $Year+1-543;
                    $years3 = $Year+2-543;

                    if ($years==$years1){ $selected1 = "selected" ;}else{}
                    if ($years==$years2){ $selected2 = "selected" ;}else{}
                    if ($years==$years3){ $selected3 = "selected" ;}else{}

                    echo "<select size='' name='exp_years' class='SELECT'>";
                    echo "  <option value='$years1' $selected1>$yearss1</option> ";
                    echo "  <option value='$years2' $selected2 >$yearss2</option> ";
                    echo "  <option value='$years3' $selected3>$yearss3</option> ";
                    echo " </select>";
                    ?>
                    เวลา:นาที:วินาที <input type="text" name="exp_time"  class="" size="6" value="12:00:00">
       </div>
     </div>
     <div class="row">
       <div class="col-md-12">
         <input type="submit" name="submit" value="เพิ่มสมาชิกใหม่">
         <input type="submit" name="submit" value="ยกเลิก">
       </div>
     </div>
   </div>
 </form>
 </body>
