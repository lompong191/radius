<?php
  include 'config.php';
  session_start();
  if (isset($_POST['submit'])) {
    $id = $_POST['user'];
    $pass = $_POST['pass'];
    $sql = "SELECT * FROM administrator WHERE admin_user = '$id' AND admin_pass = '$pass'";
    $sqlquery = $connect->query($sql);
    if ($sqlquery) {
      $_SESSION['login'] = 1;
      header("Location:index.php");
    }else{
      echo "<script>window.history.back();</script>";
    }
  }
 ?>
 <style>
  .login-form{
    padding:20px;
    width:500px;
    border:1px solid #ccc;
    margin-top: 80px;
  }
 </style>
<body>
  <div class="container">
    <div class="container login-form">
      <form class="" action="login.php" method="post">
        <div class="form-group">
          <label for="">Username</label>
          <input type="text" class="form-control" name="user" value="">
        </div>
        <div class="form-group">
          <label for="">Password</label>
          <input type="Password" class="form-control" name="pass" value="">
        </div>
        <div class="form-group">
          <input type="submit" class="form-control btn btn-primary" name="submit" value="OK">
        </div>
      </form>
    </div>
  </div>

</body>
