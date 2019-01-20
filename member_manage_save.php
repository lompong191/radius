<?php
  include 'config.php';
  session_start();

for ($x=1; $x<=$_POST['countno'] ; $x++) {
  $idx = $_POST['id'.$x];
  $mx = $_POST['m'.$x]*60; //Max-All-Session
  $ix = $_POST['i'.$x]*60; //Idle-Timeout
  $stx = $_POST['st'.$x]*60; //Session-Timeout
  $dx = $_POST['d'.$x]*1024; //Download
  $ux = $_POST['u'.$x]*1024; //Upload

  $usx = $_POST['us'.$x]; //status
  $sx = $_POST['s'.$x]; //Simultaneous
  $yx = $_POST['y'.$x]; //date type
  $enddate = $_POST['yy'.$x].'-'.$_POST['mm'.$x].'-'.$_POST['dd'.$x].' 12:00:00';
  $sql = "UPDATE usergrp SET maxsession='$mx', session='$stx' , idle='$ix' , maxdown='$dx' , maxup='$ux' , usergrp_status='$usx' , usergrp_date_type='$yx' , Expiration='$enddate' , Simultaneous='$sx' WHERE usergrp_id='$idx'";
  $sqlquery = $connect->query($sql);

}
  $sql = "TRUNCATE TABLE radreply";
  $sqlquery = $connect->query($sql);
  $sql = "TRUNCATE TABLE radcheck";
  $sqlquery = $connect->query($sql);

  $query1 = "SELECT * FROM usergrp ORDER BY usergrp_id";
  $qq1 = $connect->query($query1);
  while ($row=mysqli_fetch_array($qq1)) {
    $_REQUEST['deactivate'] = $row['usergrp_status']+1;
    $_REQUEST['maxsession_type'] = $row['maxsession']+1;
    $_REQUEST['maxsession_limit'] = $row['maxsession'];
    $_REQUEST['session_type'] = $row['session']+1;
    $_REQUEST['session_limit'] = $row['session'];
    $_REQUEST['idle_type'] = $row['idle']+1;
    $_REQUEST['idle_limit'] = $row['idle'];
    $_REQUEST['exp_type'] =  $row['usergrp_date_type']+1;
    $_REQUEST['limitspeed'] = $row['maxdown']+1;
    $_REQUEST['maxdown'] = $row['maxdown'];
    $_REQUEST['maxup'] = $row['maxup'];

      $query = "SELECT * FROM people WHERE usergrp_id='".$row['usergrp_id']."'";
      $qq = $connect->query($query);
      while ($arr = mysqli_fetch_array($qq)) {
        $people_id = $arr['people_id'];
        $people_user = $arr['people_user'];
        $people_pass = $arr['people_pass'];

            if ($_REQUEST['deactivate'] == '2') {
            $sql = "UPDATE people SET deactivate='0' WHERE people_id='$people_id'";
            $sqlquery = $connect->query($sql);

            $sql = "DELETE FROM radcheck WHERE UserName='$people_user' AND Attribute='User-Password'";
            $sqlquery = $connect->query($sql);

            $sql = "DELETE FROM radcheck WHERE UserName='$people_user' AND Attribute='Simultaneous-Use'";
            $sqlquery = $connect->query($sql);

          }else{
            $sql = "UPDATE people SET deactivate='0' WHERE people_id = '$people_id'";
            $sqlquery = $connect->query($sql);

            $sql = "DELETE FROM radcheck WHERE UserName='$people_user' AND Attribute='User-Password'";
            $sqlquery = $connect->query($sql);

            $sql = "DELETE FROM radcheck WHERE UserName='$people_user' AND Attribute='Simultaneous-Use'";
            $sqlquery = $connect->query($sql);

            $sql = "INSERT INTO radcheck (UserName, Attribute, op, Value) VALUES ('$people_user', 'User-Password', ':=', '$people_pass')";
            $sqlquery = $connect->query($sql);

            $sql = "INSERT INTO radcheck (UserName, Attribute, op, Value) VALUES ('$people_user', 'Simultaneous-Use', ':=', '$row[Simultaneous]')";
            $sqlquery = $connect->query($sql);


          }
        if ($_REQUEST['maxsession_type'] == '1') {
          $sql = "DELETE FROM radcheck WHERE UserName='$people_user' AND Attribute='Max-All-Session'";
          $sqlquery = $connect->query($sql);
        }else {
          $sql = "DELETE FROM radcheck WHERE UserName='$people_user' AND Attribute='Max-All-Session'";
          $sqlquery = $connect->query($sql);

          $maxallsession = $_REQUEST['maxsession_limit'];

          $sql = "INSERT INTO radcheck (UserName, Attribute, op, Value) VALUES ('$people_user', 'Max-All-Session', ':=', '$row[maxsession]')";
          $sqlquery = $connect->query($sql);
        }

        if ($_REQUEST['session_type'] == '1') {

          $sql = "DELETE FROM radreply WHERE UserName='$people_user' AND Attribute='Session-Timeout'";
          $sqlquery = $connect->query($sql);
        }else {
          $sql = "DELETE FROM radreply WHERE UserName='$people_user' AND Attribute='Session-Timeout'";
          $sqlquery = $connect->query($sql);

          $sessiontimeout = $_REQUEST['session_limit'];

          $sql = "INSERT INTO radreply (UserName, Attribute, op, Value) VALUES ('$people_user', 'Session-Timeout', ':=', '$row[session]')";
          $sqlquery = $connect->query($sql);
        }


        if ($_REQUEST['exp_type'] == '1') {
          $sql = "DELETE FROM radcheck WHERE UserName='$people_user' AND Attribute='Expiration'";
          $sqlquery = $connect->query($sql);
        }else {
          $sql = "DELETE FROM radcheck WHERE UserName='$people_user' AND Attribute='Expiration'";
          $sqlquery = $connect->query($sql);

          $exp_limit = datethai($row['Expiration']);

          $sql = "INSERT INTO radcheck (UserName, Attribute, op, Value) VALUES ('$people_user', 'Expiration', ':=', '$exp_limit')";
          $sqlquery = $connect->query($sql);
        }

        if ($_REQUEST['limitspeed'] == '1') {
          $sql = "DELETE FROM radreply WHERE UserName='$people_user' AND Attribute='WISPr-Bandwidth-Max-Down'";
          $sqlquery = $connect->query($sql);

          $sql = "DELETE FROM radreply WHERE UserName='$people_user' AND Attribute='WISPr-Bandwidth-Max-Up'";
          $sqlquery = $connect->query($sql);
        }else{
          $sql = "DELETE FROM radreply WHERE UserName='$people_user' AND Attribute='WISPr-Bandwidth-Max-Down'";
          $sqlquery = $connect->query($sql);

          $sql = "DELETE FROM radreply WHERE UserName='$people_user' AND Attribute='WISPr-Bandwidth-Max-Up'";
          $sqlquery = $connect->query($sql);

          $maxdown = $_REQUEST['maxdown'];
          $maxup = $_REQUEST['maxup'];

          $sql = "INSERT INTO radreply (UserName, Attribute, op, Value) VALUES ('$people_user', 'WISPr-Bandwidth-Max-Down', ':=', '$maxdown')";
          $sqlquery = $connect->query($sql);

          $sql = "INSERT INTO radreply (UserName, Attribute, op, Value) VALUES ('$people_user', 'WISPr-Bandwidth-Max-Up', ':=', '$maxup')";
          $sqlquery = $connect->query($sql);
        }

        if ($_REQUEST['idle_type'] == '1') {
          $sql = "DELETE FROM radreply WHERE UserName='$people_user' AND Attribute='Idle-Timeout'";
          $sqlquery = $connect->query($sql);
        }else {
          $sql = "DELETE FROM radreply WHERE UserName='$people_user' AND Attribute='Idle-Timeout'";
          $sqlquery = $connect->query($sql);

          $idletimeout = $_REQUEST['idle_limit'];

          $sql = "INSERT INTO radreply (UserName, Attribute, op, Value) VALUES ('$people_user', 'Idle-Timeout', ':=', '$idletimeout')";
          $sqlquery = $connect->query($sql);
        }


      }
  }
  header("Location:member_manage.php");
 ?>

 <?php
function datethai($datedata)
{

	$datedataex1 = explode(' ',$datedata);
	$datedataex = explode('-',$datedataex1[0]);
	$date = $datedataex[2];
	$month = $datedataex[1];
 	$year = $datedataex[0];

	switch($month)
	{
	case "1":
	$printmonth = "Jan";
	break;
	case "2":
	$printmonth = "Feb";
	break;
	case "3":
	$printmonth = "Mar";
	break;
	case "4":
	$printmonth = "Apr";
	break;
	case "5":
	$printmonth = "May";
	break;
	case "6":
	$printmonth = "Jun";
	break;
	case "7":
	$printmonth = "Jul";
	break;
	case "8":
	$printmonth = "Aug";
	break;
	case "9":
	$printmonth = "Sep";
	break;
	case "10":
	$printmonth = "Oct";
	break;
	case "11":
	$printmonth = "Nov";
	break;
	case "12":
	$printmonth = "Dec";
	break;
	}

	$Ythai = $year;
	return ($date+0).' '.$printmonth.' '.$Ythai.' 12:00:00';
}
?>
