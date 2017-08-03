<?php

	/**
	 * 数据库连接类
	 * 传入参数：数据库地址，用户名，密码，数据表名
	 */
	class connectDataBase
	{
		// public $ip = "";
		public $link = "";
		function __construct($host,$user,$pass,$db_name)
		{
			// $host = '127.0.0.1';
			// $user = 'root';
			// $pass = '';
			// $db_name = 'wishingwall';
			$timezone="Asia/Shanghai";

			if ($link = mysqli_connect($host,$user,$pass)) {
				mysqli_select_db($link,$db_name);
				mysqli_query($link,"set names 'UTF8'");
				// $ip = getIP();
				$this->link = $link;
				// echo "数据库连接成功".$this->link."\n";
			} else {
				echo "数据库连接失败！";
				exit;
			}
		}
	/**
	 * 检测当前IP是否在黑名单内
	 * @method checkBlackList
	 * @param  string         $ip [传入的IP地址]
	 * @return [int]           -1  [IP地址不存在]
	 *                         0   [IP地址不在黑名单内]
	 *                         1   [IP地址存在黑名单内]
	 */
		public function checkBlackList($ip)
		{
			# 检测黑名单
			if ($ip == '') {
				return -1;
			} else {
				$sql = mysqli_query($link, "SELECT `ip` FROM `saylove_2017_blacklist` WHERE ip='$ip'");
				$count = mysqli_num_rows($sql);
				if($count==0){
					return 0;
				}else {
					return 1;
				}
			}
		}

		/**
		 * 获取真实IP地址
		 * @method getIP
		 * @return string 返回真实IP地址
		 */
		public function getIP()
		{
			if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown"))
					$ip = getenv("HTTP_CLIENT_IP");
				else
					if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
						$ip = getenv("HTTP_X_FORWARDED_FOR");
					else
						if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
							$ip = getenv("REMOTE_ADDR");
						else
							if (isset ($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
								$ip = $_SERVER['REMOTE_ADDR'];
							else
								$ip = "unknown";
				return ($ip);
		}


		/**
		 * 检测与过滤服务器接收到的数据
		 * @method test_input
		 * @param  string     $data 传入需要检测的数据
		 * @return string           返回过滤过的数据
		 */
		public function test_input($data)
		{
			$data = trim($data);
		  $data = stripslashes($data);
		  $data = htmlspecialchars($data);
		  return $data;
		}
	}



 ?>
