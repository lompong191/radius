<?php
  include 'config.php';
  include 'systemmenu.php';
 ?>
 <body>
   <div class="container">
     <form class="" action="usergrp_save.php" method="post">
       <div class="form-inline">
         <div class="form-group">
           <label for="">ID :</label>
           <input type="text" class="form-control" name="id" value="">
         </div>
         <div class="form-group">
           <label for="">Name :</label>
           <input type="text" class="form-control" name="name" value="">
         </div>
         <div class="form-group">
           <input type="submit" class="btn btn-primary" name="submit" value="ส่งข้อมูล">
         </div>
       </div>
     </form>

     <div class="">
       <table class="table table-striped">
         <?php
          $sql = "SELECT * FROM usergrp ORDER BY usergrp_id";
          $sqlquery = $connect->query($sql);
          while ($rows = mysqli_fetch_array($sqlquery, MYSQL_ASSOC)) {
          ?>
          <tr>
            <td><?php echo $rows['usergrp_id']; ?></td>
            <td><?php echo $rows['usergrp_name']; ?></td>
            <td><a href="usergrp_del.php?id=<?php echo $rows['usergrp_id']; ?>">X</a></td>
          </tr>
          <?php
          }
          ?>
       </table>
     </div>
   </div>
 </body>
