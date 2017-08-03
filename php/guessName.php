<?php
  /**
   * 猜名字
   */
  class guessName
  {

    function __construct($link, $posts_id, $name, $ip)
    {
      include_once 'LCS.php'; //引入字符串比较
      $lcs = new LCS();

      //获取数据库中真实的名字
      $sql = "SELECT `tureName` FROM `saylove_2017_posts` WHERE `id` = '$posts_id'";
      $res = mysqli_query($link, $sql);
      $result = mysqli_fetch_array($res);
      $tureName = $result[0];

      // $lcs->getLCS($name, $tureName);
      $similar = $lcs->getSimilar($name, $tureName);
      //匹配
      $sql = "SELECT count(*) FROM `saylove_2017_posts` WHERE `id` = '$posts_id' AND `tureName` = '$name'";
      $res = mysqli_query($link, $sql);
      $result = mysqli_fetch_array($res);
      $num = $result[0];
      if ($num == 0) {
        # 没有猜对名字
        $sql = "INSERT INTO `saylove_2017_guess`(`posts_id`, `guessName`, `isRight`, `ip`) VALUES ('$posts_id','$name','0','$ip')";
        $res = mysqli_query($link, $sql);
        echo "很遗憾没有猜对，相似度为：".($similar*100)."%";
      } else {
        # 猜对名字
        $sql = "INSERT INTO `saylove_2017_guess`(`posts_id`, `guessName`, `isRight`, `ip`) VALUES ('$posts_id','$name','1','$ip')";
        $res = mysqli_query($link, $sql);
        echo "恭喜你猜对了！相似度为：".($similar*100)."%";
      }

    }

  }

 ?>
