<?php
	define('BASE_DIR', dirname(__FILE__));
	require_once(BASE_DIR.'/config.php');
  
	function sys_cmd($cmd) {
		if(strncmp($cmd, "reboot", strlen("reboot")) == 0) {
			shell_exec('sudo shutdown -r now');
		} else if(strncmp($cmd, "shutdown", strlen("shutdown")) == 0) {
			shell_exec('sudo shutdown -h now');
		} else if(strncmp($cmd, "settime", strlen("settime")) == 0) {
			if(isset($_GET['timestr'])) {
				$timestr=$_GET['timestr'];
				if($timestr !== "" && strpos($timestr, "-") === false && date_create($timestr) !== FALSE) {
					shell_exec("sudo date -s \"$timestr\"");
				}
			}
		} else {
			// unknown
		}
	}

	function food_cmd() {
		shell_exec('curl http://192.168.178.172/push');
	}

	if(isset($_GET['cmd'])) {
		$cmd=$_GET['cmd'];
		if (strncmp($cmd, "food", strlen("food")) == 0) {
			food_cmd();
		} else {
			sys_cmd($cmd);
		}
		
	}
?>
