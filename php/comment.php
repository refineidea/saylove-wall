<?php
  /**
   * 评论
   */
  class comment
  {
    function __construct()
    {
      # code...
    }

    public function insertComment($link, $posts_id, $contents, $ip)
    {
      $sql = "INSERT INTO `saylove_2017_commtents`(`posts_id`, `contents`, `ip`) VALUES ('$posts_id', '$contents', '$ip')";
      mysqli_query($link, $sql);
    }

    public function getComment($link, $posts_id)
    {
      $arr = array();
      $sql = "SELECT * FROM `saylove_2017_commtents` WHERE posts_id='$posts_id'";
      $arr_address = mysqli_query($link, $sql);
      $newIP = "";
      while ($row = mysqli_fetch_assoc($arr_address)){
        $newIP = "";
        $arrSub = array();
        $temp = explode(',', $row['ip']);
        $row['ip'] = $temp[0];
        $temp = explode('.', $row['ip']);
        foreach ($temp as $key => $value) {
          if ($key < count($temp)-1) {
            $newIP .= $value.".";
          }
        }
        $newIP .= "***";
        $arrSub[] = $row['mtime'];
        $arrSub[] = $row['contents'];
        $arrSub[] = $newIP;
        $arr[] = $arrSub;
      }
      echo json_encode($arr);
    }
  }

 ?>
