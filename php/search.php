<?php
  /**
   * 搜索
   */
  include_once 'display.php';

  class search extends display
  {

    function __construct($link, $name)
    {
      $result = mysqli_query($link,"SELECT * FROM saylove_2017_posts WHERE (nickName LIKE '%{$name}%' OR toWho LIKE '%{$name}%') AND `isDisplay` = '0' ORDER BY `love` DESC");
      $this->output($result,$link);
      // $result = mysqli_query($link,"SELECT * FROM saylove_2017_posts WHERE toWho='{$name}' ORDER BY `love` DESC");
      // $this->output($result,$link);
    }

  }

 ?>
