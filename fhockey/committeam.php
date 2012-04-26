<?php
	include "../inc/connect.inc.php";
	include "../inc/secure_page.inc.php";

	$error = '';
	//input validation
	$name = addslashes(trim($_POST['name']));
	$gks = substr($_POST['GKs'],1);
	$gks = array_slice(split(",",$gks),1);
	$dfs = substr($_POST['DFs'],1);
	$dfs = array_slice(split(",",$dfs),1);
	$mfs = substr($_POST['MFs'],1);
	$mfs = array_slice(split(",",$mfs),1);
	$fws = substr($_POST['FWs'],1);
	$fws = array_slice(split(",",$fws),1);
	
	$team = array_merge($gks, $dfs, $mfs, $fws);
	$uid = trim($_SESSION['shef_hockey_user_id']);
	$budget = trim($_POST['budget']);
	$sql = "INSERT INTO `fteams` (`name` , `user_id`, `budget`) VALUES (" .
				"'" . $name . "', " .
				"'" . $uid . "', ".
				"'" . $budget . "')";
				
	if (isset($sql) && (!empty($sql)))
	{
		$result = mysql_query($sql)
			or die("Invalid query: " . mysql_error());
		$fteamid = mysql_insert_id();
		
		$sql1 = "INSERT INTO `fteam_players` (`team_id` , `user_id`) VALUES ";
		for($a =0;$a<count($team);$a++)
		{
			$sql1 = $sql1 . "(" ."'" . $fteamid . "', " ."'" . $team[$a] . "'),";
		}
		$sql1 = substr($sql1,0,(strlen($sql1)-1));
		
		if (isset($sql) && (empty($error)))
		{
		$result1 = mysql_query($sql1)
			or die("Invalid query: " . mysql_error());
		}
		
		// LOG SUBMISSION
		$logdata = 	"User fantasy hockey team with team_id ". $fteamid;
		
		$log = "INSERT INTO log (`user_id`, `action`, `timestamp`, `ip`) VALUES ".
		"('". $_SESSION['shef_hockey_user_id'] ."', '". $logdata ."', '". date("Y-m-d G:i:s", time()) ."', '". $_SERVER['REMOTE_ADDR'] ."')";

		if (isset($log))
		{
		$logresult = mysql_query($log)
			or die("Log entry failed: ". mysql_error());
		}
	}
	header("location:../fhockey.php?Page=myteam");
?>