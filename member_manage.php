<?php
  include 'config.php';
  session_start();
  include 'systemmenu.php';
?>
<body>
  <table>

<form action="member_manage_save.php" method="post">


<?php
  $sql = "SELECT * FROM usergrp ORDER BY usergrp_id";
  $sqlquery = $connect->query($sql);
  while ($row = mysqli_fetch_array($sqlquery,MYSQL_ASSOC)) {
    $maxsession = $row['maxsession']/60;
    $session_timeout = $row['session']/60;
    $idle_timeout = $row['idle']/60;
    $maxdown = $row['maxdown']/1024;
    $maxup = $row['maxup']/1024;
    $simultaneous = $row['Simultaneous'];
  if (($row['usergrp_status']+0)==0) {
    $checked1 = 'checked';
    $checked2 = '';
  }else {
    $checked1 = '';
    $checked2 = 'checked';
  }

  if (($row['usergrp_date_type']+0)==0) {
    $checked3 = 'checked';
    $checked4 = '';
  }else {
    $checked3 = '';
    $checked4 = 'checked';
  }
?>
<tr>
  <td><?php echo $row['usergrp_name']; ?><input type="hidden" name="<?php echo 'id'.$row['usergrp_id']; ?>" value="<?php echo $row['usergrp_id']; ?>"></td>
</tr>
<tr>
  <td>สถานะของกลุ่ม:</td>
  <td>
  <input type="radio" name="<?php echo 'us'.$row['usergrp_id']; ?>" value="0" <?= $checked1 ?>> สถานะปกติ
  <input type="radio" name="<?php echo 'us'.$row['usergrp_id'] ?>" value="1" <?= $checked2 ?>> ระงับการใช้งาน
  </td>
</tr>
<tr>
  <td>ระยะเวลา:</td>
  <td>
    <input type="text" name="<?php echo 'm'.$row['usergrp_id']; ?>" value="<?=$maxsession ?>">นาที
  </td>
</tr>
<tr>
  <td>จำกัดระยะเวลาเมื่อไม่ใช้งาน:</td>
  <td>
    <input type="text" name="<?php echo 'i'.$row['usergrp_id']; ?>" value="<?= $idle_timeout ?>">นาที
  </td>
</tr>
<tr>
  <td>จำกัดระยะเวลาเข้าใช้งานต่อครั้ง:</td>
  <td>
    <input type="text" name="<?php echo 'st'.$row['usergrp_id']; ?>" value="<?= $session_timeout ?>">นาที
  </td>
</tr>
<tr>
  <td>Bandwidth Download:</td>
  <td>
    <input type="text" name="<?php echo 'd'.$row['usergrp_id']; ?>" value="<?= $maxdown ?>">Kbps
  </td>
</tr>
<tr>
  <td>Bandwidth Upload:</td>
  <td>
    <input type="text" name="<?php echo 'u'.$row['usergrp_id']; ?>" value="<?= $maxup ?>">Kbps
  </td>
</tr>
<tr>
  <td>วันหมดอายุของ Account:</td>
  <td>
  <input type="radio" name="<?php echo 'y'.$row['usergrp_id']; ?>" value="0" <?= $checked3 ?>> ไม่จำกัดวันหมดอายุ
  <input type="radio" name="<?php echo 'y'.$row['usergrp_id'] ?>" value="1" <?= $checked4 ?>> หมดอายุวันที่
  <?php
    $people_startdate = explode('-',$row['Expiration']);
  	$date_select = $people_startdate[2];
  	$month_select = $people_startdate[1];
   	$year_select = $people_startdate[0];
  			dateinput('วันหมดอายุของ Account','dd'.$row['usergrp_id'],'mm'.$row['usergrp_id'],'yy'.$row['usergrp_id'],$date_select,$month_select,$year_select,'3','1','');
   ?>
  </td>
</tr>
<?php
  if (($simultaneous+0) == 0) {
    $simultaneous++;
  }
 ?>
 <tr>
   <td>การเข้าใช้งานซ้อนกันได้:</td>
   <td>
     <input type="text" name="<?php echo 's'.$row['usergrp_id']; ?>" value="<?=$simultaneous?>">Session   * การใช้งาน Account เดียวกันพร้อมกัน
   </td>
 </tr>
  <?php
  $usergrp_id =  $row['usergrp_id'];
  }
?>
<tr>
  <td align='right' colspan='2'>* หากระบุข้อมูลเป็น 0 คือ ไม่จำกัด | <input name="countno" type="hidden" value="<?php echo $usergrp_id; ?>"><input type="submit" name="submit" value="บันทึกข้อมูล"></td>
</tr>
</form>
  </table>
</body>


<?php

function dateinput($caption,$date_name,$month_name,$year_name,$date_select,$month_select,$year_select,$year_count,$year_thai,$disabled)
{
	if ($date_select == ''){
	$date_select = date(d);
	}

	echo '<select size="1" name="'.$date_name.'" class="select">';
	for ($i = 1; $i <= 31; $i++)
	{
		echo '<option value="'.substr('0'.$i, -2).'" '.($date_select+0==$i?'selected="selected"':'').'>' . $i . '</option>';
	}
	echo '</select> ';

	if ($month_select == ''){
	$month_select = date(m);
	}
	echo '<select size="1" name="'.$month_name.'" class="select">';
	?>
		<option value="1" <?php if ($month_select==1){ echo "selected";}else{}?>>มกราคม</option>
		<option value="2" <?php if ($month_select==2){ echo "selected";}else{}?>>กุมภาพันธ์</option>
		<option value="3" <?php if ($month_select==3){ echo "selected";}else{}?>>มีนาคม</option>
		<option value="4" <?php if ($month_select==4){ echo "selected";}else{}?>>เมษายน</option>
		<option value="5" <?php if ($month_select==5){ echo "selected";}else{}?>>พฤษภาคม</option>
		<option value="6" <?php if ($month_select==6){ echo "selected";}else{}?>>มิถุนายน</option>
		<option value="7" <?php if ($month_select==7){ echo "selected";}else{}?>>กรกฎาคม</option>
		<option value="8" <?php if ($month_select==8){ echo "selected";}else{}?>>สิงหาคม</option>
		<option value="9" <?php if ($month_select==9){ echo "selected";}else{}?>>กันยายน</option>
		<option value="10" <?php if ($month_select==10){ echo "selected";}else{}?>>ตุลาคม</option>
		<option value="11" <?php if ($month_select==11){ echo "selected";}else{}?>>พฤศจิกายน</option>
		<option value="12" <?php if ($month_select==12){ echo "selected";}else{}?>>ธันวาคม</option>
	</select>
	<?php
	if ($year_select == ''){
	$year_select = date('Y');
	}

	$thisyear = date('Y');
	echo '<select name="'.$year_name.'" class="select">';

	for ($i = $thisyear + $year_count; $i >= $thisyear; $i--)
	{
		if ($year_thai == 1){
		$yname =  $i+543;
		}else{
		$yname =  $i;
		}
		$years = $i;
		echo '<option value="'.$years.'" '.($year_select+0==$i?'selected="selected"':'').'>' .$yname. '</option>';
	}
	echo '</select>';

}
?>
