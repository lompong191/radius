<?php
  include 'config.php';
  session_start();
 ?>
 <body>
   <?php
   include 'systemmenu.php'
    ?>
    <a href='member_list.php'>ตรวจสอบ / แก้ไข / ลบ ผู้ใช้งานในระบบ </a> |
    <a href='member_manage.php'>การจัดการกลุ่มของผู้ใช้งาน </a> |
    <a href='member_group_del.php'>ลบผู้ใช้งานทั้งกลุ่ม </a>
    <br><b><big>ตรวจสอบ / แก้ไข / ลบ ผู้ใช้งานในระบบ</b>

    <table>
      <tr>
        <td>รหัส</td>
        <td>ชื่อจริง</td>
        <td>นามสกุล</td>
        <td>กลุ่ม</td>
        <td>เพศ</td>
        <td>อีเมล์</td>
        <td>โทรศัพท์</td>
        <td>มือถือ</td>
        <td>สถานะปกติ | ระงับ ID</td>
      </tr>
      <?php
        $sql = "SELECT * FROM people,usergrp WHERE people.usergrp_id = usergrp.usergrp_id ";
        $sqlquery = $connect->query($sql);
        while($row=mysqli_fetch_array($sqlquery)) {
          if ($row['sex_id'] == 0){$sex_name = "ไม่ระบุ";}
          if ($row['sex_id'] == 1){$sex_name = "ชาย";}
          if ($row['sex_id'] == 2){$sex_name = "หญิง";}
          if ($row['deactivate'] == 0){$deactivate_name = "<a href='member_edit.php?people_id=$row[people_id]'>ตรวจสอบและแก้ไข</a><br><a href='people_activate.php?people_id=$row[people_id]&activate=1'>สถานะปกติ</a><br>";}
					if ($row['deactivate'] == 1){$deactivate_name = "<a href='people_activate.php?people_id=$row[people_id]&activate=0'><br><font color='red'><b>ระงับ ID</b><br><br></font></a>";}

      ?>
      <tr>
        <td><?php echo $row['people_id'] ?></td>
        <td><?php echo $row['people_name'] ?></td>
        <td><?php echo $row['people_surname'] ?></td>
        <td><?php echo $row['usergrp_name'] ?></td>
         <td><?php echo $sex_name ?></td>
         <td><?php echo $row['people_email'] ?></td>
         <td><?php echo $row['people_tel'] ?></td>
         <td><?php echo $row['people_mobile'] ?></td>
         <td><center><?php echo $deactivate_name ?></center></td>
      </tr>
      <?php
        }
       ?>
    </table>
 </body>
