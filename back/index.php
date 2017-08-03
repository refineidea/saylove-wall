<!DOCTYPE html>
<?php
    session_start();
    //需要用isset来检测变量，不然php可能会报错。
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==1)
    {
      header("Location:protection.php");
      exit;
    }

    if(isset($_POST['login']))
    {
      $user =$_POST['username'];
      $password = $_POST['password'];

      if ($user == "kipa" && $password == "kipa.studio") {
        $_SESSION['loggedin'] = 1;
        header("Location:protection.php");
      } else {
        echo " <script > document.getElementById(\"info\").style.display='block';document.getElementById(\"info\").innerHTML='用户名或者密码错了';</script > ";
      }
    }
?>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>神奇的后台</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>
<body>
  <div>
      <form  method="post">
        <h3>后台管理</h3>
        <div id="info" style="display:none"></div>
        <input name="login" value="1" type="hidden" />
        <br />
        <input id="username" name="username" placeholder="Username" type="text" />
        <br />
        <input id="password" name="password" placeholder="Password" type="password" />
        <br />
        <input type="submit"  value="登录" />
      </form>
    </div>
</body>
</html>
