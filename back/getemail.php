<?php
  /**
   *
   */
  class getemail
  {
    public $maxItems = 100;
    function __construct()
    {

    }
    public function displayEmail($link, $page)
    {
      $page_later = ($page-1)*$this->maxItems;
      $mysql = "SELECT * FROM `saylove_2017_posts` WHERE `isDisplay` = '0' AND `isSended` = '0' AND email <> '' ORDER BY `mtime` DESC LIMIT {$page_later},{$this->maxItems}";
      $arr_address = mysqli_query($link, $mysql);

      $this->output($arr_address,$link);//输出posts
    }

    public function output($arr_address,$link)
    {
      $arr = array();
      while ( $row = mysqli_fetch_assoc($arr_address) ){
        $arrSub = array();

        $arrSub[] = $row['id'];;
        $arrSub[] = $row['nickName'];
        $arrSub[] = $row['toWho'];
        $arrSub[] = $row['contents'];
        $arrSub[] = $row['email'];
        $arrSub[] = $row['ip'];
        $arrSub[] = $row['mtime'];
        $arr[] = $arrSub;
      }
      echo json_encode($arr);
    }
  }

 ?>
