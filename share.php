<?php
  session_start();
  if (isset($_GET["id"])) {
    include_once 'php/connect.php';
    $connectDBS = new connectDataBase("127.0.0.1","root",'','saylove2017');
    $post_id = test_input($_GET["id"]);
    $result = mysqli_query($connectDBS->link,"SELECT * FROM saylove_2017_posts WHERE id='{$post_id}' ");

  } else {
    exit(0);
  }

  function test_input($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
?>
<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <title>分享</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="css/jquery.mobile-1.4.5.min.css" media="screen" title="no title">
    <script src="js/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
    <script src="js/jquery.mobile-1.4.5.min.js" charset="utf-8"></script>
    <link rel="stylesheet" href="css/homepage.css" media="screen" title="no title">
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" media="screen" />
    <script src="js/search.js" charset="utf-8"></script>
</head>

<body>
  <div id="Header" class="Header" data-role="header">
    <!-- <img src="images/logo.png" class="Header-logo" width="100%" height="400px"  alt=""/> -->
    <img src="images/title.png" class="Header-title" width="250px" alt="广西科技大学表白墙" />
    <!-- <img src="images/icon/logo2.png" alt="" /> -->
    <!-- <h1>科大表白墙</h1> -->
  </div>
  <div class="main-body" id="main" data-role="content">
    <?php
      $row = mysqli_fetch_assoc($result);
      //获取评论总数
      $posts_id = $row['id'];
      $total_comments_sql = "SELECT COUNT('posts_id') FROM `saylove_2017_commtents` WHERE posts_id = '$posts_id'";
      $total_comments_result = mysqli_fetch_array(mysqli_query($connectDBS->link,$total_comments_sql));
      $total_comments = $total_comments_result[0];

      //获取猜名字总数 -- 猜对的
      $total_guess_sql = "SELECT COUNT('posts_id') FROM `saylove_2017_guess` WHERE posts_id = '$posts_id' AND isRight = '1'";
      $total_guess_result = mysqli_fetch_array(mysqli_query($connectDBS->link,$total_guess_sql));
      $total_guess = $total_guess_result[0];

      //获取猜名字总数 -- 总数
      $total_guess_sql = "SELECT COUNT('posts_id') FROM `saylove_2017_guess` WHERE posts_id = '$posts_id'";
      $total_guess_result = mysqli_fetch_array(mysqli_query($connectDBS->link,$total_guess_sql));
      $total_guess_all = $total_guess_result[0];
echo <<<POSTS
<div class="post">
    <div class="post-title">
        <ul>
            <li class="{$row['gender']}">{$row['nickName']}</li>
            <li><img src="images/icon/to.png" alt=""></li>
            <li class="{$row['itsGender']}">{$row['toWho']}</li>
        </ul>
    </div>
    <div class="post-body">
        <p class="post-body-content">{$row['contents']}</p>
        <p class="post-body-time">{$row['mtime']}</p>
    </div>
    <div class="post-actions action ui-navbar" role="navigation">
        <ul class="ui-grid-c">
            <li class="ui-block-a"><a class="ui-link ui-btn ui-icon-like ui-btn-icon-left " href="#" post="{$row['id']}" data-icon="like">{$row['love']}</a></li>
            <li class="ui-block-b"><a class="ui-link ui-btn ui-icon-guess ui-btn-icon-left " href="#guess-Name-Popup" data-rel="popup" data-position-to="window" data-transition="pop" post="{$row['id']}" data-icon="guess">{$total_guess}/{$total_guess_all}</a></li>
            <li class="ui-block-c"><a class="ui-link ui-btn ui-icon-comment ui-btn-icon-left " href="#comment-Popup" data-rel="popup" data-position-to="window" data-transition="pop" post="{$row['id']}" data-icon="comment">{$total_comments}</a></li>
            <li class="ui-block-d"><a class="ui-link ui-btn ui-icon-share ui-btn-icon-left " href="#" post="{$row['id']}" data-icon="share">分享</a></li>
        </ul>
    </div>
</div>

POSTS;
     ?>
     <div  id="share-bars" >
      <div class="jiathis_style_m"></div>
     </div>

  </div>

  <div data-role="footer" id="footer" data-position="fixed" data-fullscreen="true" data-tap-toggle="false">
    <div class="" data-role="navbar">
      <ul>
        <li><a href="index.php" data-ajax='false' data-transition="slide" data-direction="reverse" data-role="button" data-icon="article" class="ui-icon-article" data-iconpos="notext"></a></li>
        <li><a href="saylove.html" data-ajax='false' data-role="button" data-icon="heart" class="ui-icon-heart" data-iconpos="notext"></a></li>
        <li><a href="search.html" data-ajax='false' data-role="button" data-icon="search" class="ui-icon-search" data-iconpos="notext"></a></li>
        <li><a href="help.html" data-ajax='false' data-role="button" data-icon="help" class="ui-icon-help" data-iconpos="notext"></a></li>
      </ul>
    </div>

  </div>
  <div data-role="popup" class="ui-content" data-overlay-theme="b" id="guess-Name-Popup">
    <a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn ui-icon-delete ui-btn-icon-notext ui-btn-right">关闭</a>
    <h4>猜名字</h4>
    <p>
      已猜中 <span id="guess_right"></span> 次, 被猜 <span id="guess_all"></span> 次.
    </p>
    <p class="guess-hint">
      猜名字游戏介绍请点击查看：<a style="color:#333;" href="help.html">帮助</a>
    </p>
    <div class="ui-field-contain">
      <label for="guess-input">猜一猜发起者的名字：</label>
      <input type="search" name="search" id="guess-input" placeholder="名字">
    </div>
    <input id="guess-submit" style="text-align:center;display:block;margin:0 auto;" type="submit" data-inline="true" value="猜！">
    <span id="guess-hint"></span>
  </div>

  <div data-role="popup" class="ui-content" data-overlay-theme="b" id="comment-Popup">
    <a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn ui-icon-delete ui-btn-icon-notext ui-btn-right">关闭</a>
    <h4>评论列表</h4>
    <div class="" id="comment-lists">
      <ul id="comment-lists-ul">
        <li style="visibility: hidden;">
          <span class="comment-floor">2楼</span>
          <span class="comment-ip">192.168.1.***</span>
          <span class="comment-time">2016/11/7 18:00:56</span>
          <p>占位占位占位占位占位占位占位占位占位占位占位</p>
        </li>
      </ul>
    </div>
    <div class="ui-field-contain">
      <label for="guess-input">评论：</label>
      <input type="search" name="search" id="guess-input" placeholder="我想说...">
    </div>
    <input id="comment-submit" style="text-align:center;display:block;margin:0 auto;" type="submit" data-inline="true" value="评论">
    <span id="comment-hint"></span>
  </div>
  <div data-role="popup" class="ui-content" data-overlay-theme="b" id="share-Popup">
    <a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn ui-icon-delete ui-btn-icon-notext ui-btn-right">关闭</a>
    <h4>链接分享</h4>
    <h5>复制链接给朋友或者点击打开链接</h5>
    <div id="link">
      <a href="http://qq597914752.gotoip1.com/app/saylove/share.php?id=">http://qq597914752.gotoip1.com/app/saylove/share.php?id=</a>
    </div>
  </div>
  <script type="text/javascript">
  var jiathis_config = {
    url: document.location.href,
    title: "2016 广西科技大学表白墙",
    summary:"这个表白好有意思 分享给大家看看！"
    }
  </script>
  <script type="text/javascript" src="http://v3.jiathis.com/code/jiathis_m.js" charset="utf-8"></script>
  <div class="" style="display:none;">
<script src="https://s95.cnzz.com/z_stat.php?id=1260775801&web_id=1260775801" language="JavaScript"></script>
  </div>
</body>

</html>
