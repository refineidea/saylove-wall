<?php
  session_start();
  $logout = @$_GET['logout'];
  if($logout ==1)
    $_SESSION['loggedin']=0;

  if($_SESSION['loggedin']!=1)
  {
    header("Location:index.php");
    exit;
  }
 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
   <meta charset="UTF-8">
   <title>神奇的后台</title>
   <meta name="viewport" content="width=device-width, initial-scale=1" />
   <script src="../js/jquery-3.1.1.min.js" charset="utf-8"></script>
   <script src="act.js" charset="utf-8"></script>
 </head>
 <body>
   <a href="?logout=1" class="btn btn-danger">Log out</a>
   <button type="button" id="start" name="button">开始发送！</button>
   <div class="" id="email-list">
     <table id="email-list-table">

     </table>
     <button type="button" name="button">下一页</button>
     <div class="" id="info">

     </div>
   </div>
 </body>
 </html>
