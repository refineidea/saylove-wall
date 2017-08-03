<?php
  /**
   * 输出
   */
  class display
  {
    public $maxItems = 18;
    function __construct()
    {
      # code..
    }
    public function show($link, $page, $mode)
    {
      $maxItems = 18;
      switch ($mode) {
    		case '0'://0：默认按点赞数多少显示全部；
    			$page_later = ($page-1)*$maxItems;
    			$mysql = "SELECT * FROM `saylove_2017_posts` WHERE `isDisplay` = '0' ORDER BY `love` DESC LIMIT {$page_later},{$maxItems}";
    			$arr_address = mysqli_query($link, $mysql);

    			$this->output($arr_address,$link);//输出posts
    			break;
    		case '1'://1：按时间倒序显示；
    			$page_later = ($page-1)*$maxItems;
    			$mysql = "SELECT * FROM `saylove_2017_posts` WHERE `isDisplay` = '0' ORDER BY `mtime` DESC LIMIT {$page_later},{$maxItems}";
    			$arr_address = mysqli_query($link, $mysql);

    			$this->output($arr_address,$link);//输出posts
    			break;
    		case '2'://随机进入页面；
          //获取数据总数
          $total_sql = "SELECT COUNT(*) FROM `saylove_2017_posts` where isDisplay = '0'";
          $total_result = mysqli_fetch_array(mysqli_query($link,$total_sql));
          $total = $total_result[0];
          $total_page = floor($total/$this->maxItems);
    			$page_later = rand(1,$total_page)*$maxItems;//随机页面
    			$mysql = "SELECT * FROM `saylove_2017_posts` WHERE isDisplay = '0' ORDER BY `love` DESC LIMIT {$page_later},{$maxItems}";
    			$arr_address = mysqli_query($link, $mysql);
    			$this->output($arr_address,$link);//输出posts
    			break;
    		case '3'://点赞数最少排序
    			$page_later = ($page-1)*$maxItems;
    			$mysql = "SELECT * FROM `saylove_2017_posts` WHERE isDisplay = '0' ORDER BY `love` ASC LIMIT {$page_later},{$maxItems}";
    			$arr_address = mysqli_query($link, $mysql);

    			$this->output($arr_address,$link);//输出posts
    			break;
    		case '4'://最旧帖子时间
    			$page_later = ($page-1)*$maxItems;
    			$mysql = "SELECT * FROM `saylove_2017_posts` WHERE isDisplay = '0' ORDER BY `mtime` ASC LIMIT {$page_later},{$maxItems}";
    			$arr_address = mysqli_query($link, $mysql);

    			$this->output($arr_address,$link);//输出posts
    			break;
        case '5': //
          # code...
          break;
    	}
    }

    public function output($arr_address,$link)
    {
      $arr = array();
      while ($row = mysqli_fetch_assoc($arr_address)){
        $arrSub = array();
        //获取评论总数
        $posts_id = $row['id'];
      	$total_comments_sql = "SELECT COUNT('posts_id') FROM `saylove_2017_commtents` WHERE posts_id = '$posts_id'";
      	$total_comments_result = mysqli_fetch_array(mysqli_query($link,$total_comments_sql));
      	$total_comments = $total_comments_result[0];

        //获取猜名字总数 -- 猜对的
        $total_guess_sql = "SELECT COUNT('posts_id') FROM `saylove_2017_guess` WHERE posts_id = '$posts_id' AND isRight = '1'";
      	$total_guess_result = mysqli_fetch_array(mysqli_query($link,$total_guess_sql));
      	$total_guess = $total_guess_result[0];

        //获取猜名字总数 -- 总数
        $total_guess_sql = "SELECT COUNT('posts_id') FROM `saylove_2017_guess` WHERE posts_id = '$posts_id'";
      	$total_guess_result = mysqli_fetch_array(mysqli_query($link,$total_guess_sql));
      	$total_guess_all = $total_guess_result[0];

        //获取数据总数
        $total_sql = "SELECT COUNT(*) FROM `saylove_2017_posts` where isDisplay = '0'";
        $total_result = mysqli_fetch_array(mysqli_query($link,$total_sql));
        $total = $total_result[0];
        $total_page = floor($total/$this->maxItems);

        $arrSub[] = $posts_id;
        $arrSub[] = $row['nickName'];
        $arrSub[] = $row['toWho'];
        $arrSub[] = $row['contents'];
        $arrSub[] = $row['love'];
        $arrSub[] = $total_guess;
        $arrSub[] = $total_comments;
        $arrSub[] = $row['mtime'];
        $arrSub[] = $total_page;
        $arrSub[] = $total_guess_all;
        $arrSub[] = $row['gender'];
        $arrSub[] = $row['itsGender'];
        $arrSub[] = $total;
        $arr[] = $arrSub;
      }
      echo json_encode($arr);
    }
  }

 ?>
