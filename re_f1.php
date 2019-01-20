<?php
  include 'config.php';
  include 'systemmenu.php';

 ?>
 <body>
   <div class="container">
     <form class="" action="re_s1.php" method="post">
       <div class="form-inline">
         <div class="form-group">
           <label for="">รหัสประจำตัวประชาชน :</label>
           <input type="text" class="form-control" name="people_id" value="">
           <label for="">* ต.ย. 32001000010001 </label>
         </div>
       </div>
       <div class="form-group">
         <input type="submit" class="btn btn-primary" name="submit" value="ขั้นตอนถัดไป">
       </div>
     </form>

   </div>
 </body>
