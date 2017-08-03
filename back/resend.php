<?php
  /**
   *
   */
  class sendEmail
  {

    function __construct()
    {

    }

    public function sendOut($linkDatabaese, $uid, $email)
    {
      // require '../php/PHPMailer/PHPMailerAutoload.php';
      include_once '../php/PHPMailer/PHPMailerAutoload.php';
      $mail = new PHPMailer;
      // $mail->SMTPDebug = 3;                               // Enable verbose debug output
      $mail->isSMTP();                                      // Set mailer to use SMTP
      // $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
      // $mail->SMTPAuth = true;
      // $mail->CharSet = "utf-8";                               // Enable SMTP authentication
      // $mail->Username = 'l597914752@gmail.com';                 // SMTP username
      // $mail->Password = 'diponksmtsfogxjb';                           // SMTP password
      // $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, tls `ssl` also accepted
      // $mail->Port = 465;                                    // TCP port to connect to
      // $link = "http://qq597914752.gotoip1.com/app/saylove/share.php?id={$uid}";
      //
      // $mail->setFrom('l597914752@gmail.com', '广西科技大学2016表白墙');
      // $mail->addAddress("{$email}");               // Name is optional
      // $mail->addReplyTo('l597914752@gmail.com', '广西科技大学2016表白墙');
      //
      $mail->Host = 'smtp.qq.com;';  // Specify main and backup SMTP servers
      $mail->SMTPAuth = true;
      $mail->CharSet = "utf-8";                               // Enable SMTP authentication
      $mail->Username = '597914752';                 // SMTP username
      $mail->Password = 'ljp7672318';                           // SMTP password
      $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, tls `ssl` also accepted
      $mail->Port = 465;                                    // TCP port to connect to
      $link = "http://qq597914752.gotoip1.com/app/saylove/share.php?id={$uid}";

      $mail->setFrom('597914752@qq.com', '广西科技大学2016表白墙');
      $mail->addAddress("{$email}");               // Name is optional
      $mail->addReplyTo('597914752@qq.com', '广西科技大学2016表白墙');



      //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
      //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
      $mail->isHTML(true);                                  // Set email format to HTML

      $mail->Subject = '你被表白啦！来自广西科技大学表白墙';
      $mail->Body    = '你被表白啦！点击<a href="'.$link.'">这里</a>查看<br>或者猛戳链接：'.$link.'<br>此封邮件来自广西科技大学表白墙应用<br>官网地址：http://qq597914752.gotoip1.com/app/saylove<br>如果你的正常生活被表白墙影响到请联系管理员删除表白，谢谢谅解！<br> 管理员企鹅：597914752';
      $mail->AltBody = '';

      if(!$mail->send()) {
          echo '邮件发送失败！因为当前人数太多，邮件发送频率高被限制，不过系统会在稍后自动重新发送邮件，请放心，联系站长QQ：597914752<br>';
          echo 'Mailer Error: ' . $mail->ErrorInfo . '<br>';
          $sql = "UPDATE `saylove_2017_posts` set isSended = '2' where id='$uid'";
        	mysqli_query($linkDatabaese, $sql);
      } else {
          echo '邮件发送成功！<br>';
          $sql = "UPDATE `saylove_2017_posts` set isSended = '1' where id='$uid'";
        	mysqli_query($linkDatabaese, $sql);
      }
    }
  }

 ?>
