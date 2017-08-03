<?php
header("Content-type:text/html; charset=utf-8");
if ( isset($_POST["act"] ) ){
  include_once '../php/connect.php';
  $connectDBS = new connectDataBase("127.0.0.1","root",'','saylove2017');
  $action = $connectDBS->test_input($_POST["act"]);
  $ip = $connectDBS->getIP();
  $sql = "SELECT count(*) FROM `saylove_2017_blacklist` WHERE `ip` = '$ip'";
  $res = mysqli_query($connectDBS->link, $sql);
  $result = mysqli_fetch_array($res);
  $num = $result[0];
  if ($num != 0) {
    exit(0);
  }

  switch ($action) {
    case 'resend':
      include_once 'resend.php';
      $post_id = $connectDBS->test_input($_POST["id"]);
      $email = $connectDBS->test_input($_POST["email"]);
      $reSend = new sendEmail();
      $reSend->sendOut($connectDBS->link, $post_id, $email);
      break;
    case 'getemail':
      include 'getemail.php';
      $page = $connectDBS->test_input($_POST["page"]);
      $getEmail = new getemail();
      $getEmail->displayEmail($connectDBS->link, $page);
      break;
    case 'start':
      # code...
      include_once 'resend.php';
      // include 'getemail.php';
      $reSend = new sendEmail();
      $mysql = "SELECT * FROM `saylove_2017_posts` WHERE `isDisplay` = '0' AND `isSended` = '0' AND email <> '' ORDER BY `mtime` DESC";
      $arr_address = mysqli_query($connectDBS->link , $mysql);
      while ( $row = mysqli_fetch_assoc($arr_address) ){
        $reSend->sendOut($connectDBS->link, $row['id'], $row['email']);
        sleep(30);
      }
      break;
    default:
      # code...
      break;
  }
}
 ?>
