<?php
include('../inc/connect.inc.php');
include('../inc/secure_page.inc.php');
include('../fhockey/constants.inc.php');
include('../fhockey/functions.inc.php');
include('../inc/commitfunctions.inc.php');
include('facebook.inc.php');
	
switch ($_GET['Action'])
{
	case "add":
		$error = '';
		//input validation
		$matchid = $_POST['matches'];
		$hscore = myAddSlashes(trim($_POST['hscore']));
		$oscore = myAddSlashes(trim($_POST['oscore']));
		$motm = trim($_POST['motm']);
		$dotd = trim($_POST['dotd']);
		$report = myAddSlashes(nl2br(trim($_POST['report'])));
		$scorers = substr($_POST['scorers'],1);
		$scorers = array_slice(split(",",$scorers),1);
		$scorervalues = array_count_values($scorers);
		$ycards = substr($_POST['ycards'],1);
		$ycards = array_slice(split(",",$ycards),1);
		$rcards = substr($_POST['rcards'],1);
		$rcards = array_slice(split(",",$rcards),1);
	
		$matchquery = 'SELECT * FROM matches WHERE match_id = '.$matchid;
		$matchresult = mysql_query($matchquery)
			or die(mysql_error());
		
		$matchrow = mysql_fetch_array($matchresult);
		$opposition = $matchrow['opposition'];
		$opposition = addslashes($opposition);
		$date = $matchrow['date'];
		$time = $matchrow['pushback'];
		$squad = $matchrow['squad_id'];
		$home = $matchrow['home'];
		$friendly = $matchrow['friendly'];
		$minus = 0; // For Fantasy Hockey
		$uid = array();
				
		if (empty($error))
		{
			// move the match to playedmatches
			$sql = "INSERT INTO `playedmatches` (`opposition` , `squad_id` , `home` , `date` , `time` , `home_score`, `opp_score`, `friendly` ) VALUES (" .
						"'" . $opposition . "', " .
						"'" . $squad . "', " .
						"'" . $home . "', " .
						"'" . $date . "', " .
						"'" . $time . "', " .
						"'" . $hscore . "', " .
						"'" . $oscore . "', " .
						"'" . $friendly . "')";
		}
		else
		{
			header('location:../memberpages.php?Page=matchereports&Action=add&error='.urlencode($error));
		}
		
		if (isset($sql) && (!empty($sql)))
		{
			$result = mysql_query($sql)
				or die("Invalid query 1: " . mysql_error());
			$newmatchid = mysql_insert_id();
			
			// add the report into match reports
			$sql2 = "INSERT INTO `matchreports` (`text` , `motm` , `dotd`, `user_id`, `created_on`) VALUES (" .
						"'" . $report . "', " .
						"'" . $motm . "', " .
						"'" . $dotd . "', " .
						"'" . USR_ID . "', " .
						"'" . date('Y-m-d') . "')";
						
			$result2 = mysql_query($sql2)
				or die("Invalid query 2: " . mysql_error());
				
			$reportid = mysql_insert_id();
			
			// Set the report id in the playedmatches table
			$sql3 = "UPDATE playedmatches SET report_id = '" . $reportid . "' WHERE match_id = '" . $newmatchid . "'";					
			$result3 = mysql_query($sql3)
				or die("Invalid query3: " . mysql_error());
			
			// Move the squad to the playedmatches_users table
			$psql = "SELECT user_id FROM user_squad WHERE squad_id = '" . $squad . "'";
			$presult = mysql_query($psql)
				or die("Invalid query \'p\': " . mysql_error());
			while ($p_row = mysql_fetch_array($presult))
			{
				$uid[] = $p_row['user_id'];
			}
							
			if (count($uid) !=0)
			{
				$sql4 = "INSERT INTO `playedmatch_user` (`match_id` ,`user_id`) VALUES ";
				for($a =0;$a<count($uid);$a++)
				{
					$sql4 = $sql4 . "(" ."'" . $newmatchid . "', '" . $uid[$a] . "'),";
				}
				$sql4 = substr($sql4,0,(strlen($sql4)-1));
				
				$result4 = mysql_query($sql4)
					or die("Invalid query 4: " . mysql_error());
			}
			
			//delete entries from match_squad
			//limit set to the size of the number of players in the squad
			$sql5 = "DELETE FROM match_squad WHERE match_id = '" . $matchid . "' " .
					"LIMIT " . sizeof($uid) . "";
			
			$result5 = mysql_query($sql5)
				or die("Invalid query 5: " . mysql_error());
			
			//delete the single entry from matches
			$sql6 = "DELETE FROM matches WHERE match_id = '" . $matchid . "'";
			
			$result6 = mysql_query($sql6)
				or die("Invalid query 6: " . mysql_error());

			if ($scorers[0] != '')
			{
				// Add the scorers to the scorers table
				$sql7 = "INSERT INTO `scorers` (`user_id` , `report_id`) VALUES ";
				for($b=0; $b<count($scorers); $b++)
				{
					$sql7 = $sql7 . "(" ."'" . $scorers[$b] . "', " ."'" . $newmatchid . "'),";
				}
				$sql7 = substr($sql7,0,(strlen($sql7)-1));
				
				$result7 = mysql_query($sql7)
					or die("Invalid query 7: " . mysql_error());
			}
			
			if ($ycards[0] != '')
			{
				// Add the naughty players to the ycards table
				$sql8 = "INSERT INTO `ycards` (`user_id` , `report_id`) VALUES ";
				for($b=0; $b<count($ycards); $b++)
				{
					$sql8 = $sql8 . "(" ."'" . $ycards[$b] . "', " ."'" . $newmatchid . "'),";
				}
				$sql8 = substr($sql8,0,(strlen($sql8)-1));
				
				$result8 = mysql_query($sql8)
					or die("Invalid query 8: " . mysql_error());
			}
			
			if ($rcards[0] != '')
			{
				// Add the extremely naughty players to the rcards table
				$sql9 = "INSERT INTO `rcards` (`user_id` , `report_id`) VALUES ";
				for($b=0; $b<count($rcards); $b++)
				{
					$sql9 = $sql9 . "(" ."'" . $rcards[$b] . "', " ."'" . $newmatchid . "'),";
				}
				$sql9 = substr($sql9,0,(strlen($sql9)-1));
				
				$result9 = mysql_query($sql9)
					or die("Invalid query 9: " . mysql_error());
			}
			
			// FANTASY HOCKEY
			// May not look like much but it is!
			if ($friendly == 0) // No points scored for friendly matches
			{
				$points = array_map("calcScore", $uid);
				
				// Calculates the points awarded to each team
				CalcTeamPoints();
			}
			
			// LOG SUBMISSION
			$logdata = 	'User added match report with report_id: '.$reportid.' about match_id: '.$matchid;
			submitlog($logdata);
			
			// FACEBOOK NOTIFICATION
			$siteUrl = getSiteUrl();
			$msg = '('.getUsername(USR_ID).') has written a match report about '.getSquadName($squad).' v '.$opposition.'. <a href="http://'.$siteUrl.'/matches.php?report_id='.$reportid.'">Click here to read it</a>';
			$fbres = notifyPeople($facebook,$msg);
		}
		header('location:../memberpages.php?Page=matchreports');
	break;
	
	case "delete":
		/*
		 * There's a problem with this. Cos matches are deleted from matches and moved to playedmatches, 
		 * if a match report is deleted, another match report cannot take its place!
		 * Therefore, a playedmatch has to be put back into the matches table once if its report has been deleted,
		 * And that playedmatch also has to be deleted too, or duplicate matches will occur!
		 * Also, all match_squad will have to be committed with a "yes" on their availability otherwise
		 * the main menu entry match checker will detect a match that you've not answered for.
		 */
		 
		 /*
		  * Fantasy Hockey has problems here too. In order to remove the points from each person it needs to know how many it gave!
		  * Therefore, the uid, scorervalues, ycards and rcards arrays are re-constructed and oscore and motm are made variables
		  */
	
		$error = '';
		// first, get the data for the played match
		$sql1 = "SELECT * FROM playedmatches WHERE match_id = '" . $_POST['matchid'] . "'";
		$res1 = mysql_query($sql1)
			or die("Error with query 1: " . mysql_error());
		
		$row1 = mysql_fetch_array($res1);
		$squad = $row1['squad_id'];
		$opposition = $row1['opposition'];
		$opposition = ereg_replace("'", "\'", $opposition);
		$home = $row1['home'];
		$date = $row1['date'];
		$time = $row1['time'];
		$friendly = $row1['friendly'];
		$oscore = $row1['opp_score']; // FANTASY HOCKEY
		
		$scorers = array();
		$scorervalues = array();
		$ycards = array();
		$rcards = array();
		$uid = array();
		
		// next, insert this data into the matches table
		$sql2 = "INSERT INTO `matches` (`squad_id`, `opposition`, `home`, `date`, `pushback`, `friendly`) VALUES ( " .
					"'" . $squad . "', " .
					"'" . $opposition . "', " .
					"'" . $home . "', " .
					"'" . $date . "', " .
					"'" . $time . "', " .
					"'" . $friendly . "')";
		$res2 = mysql_query($sql2)
			or die("Error with query 2: " . mysql_error());
		// get the last insert id for the matchessquad query
		$newid = mysql_insert_id();
		
		// next, get the playedmatch_user
		$sql6 = "SELECT * FROM playedmatch_user WHERE match_id = '" . $_POST['matchid'] . "'";
		$res6 = mysql_query($sql6)
			or die("Error with query 6: " . mysql_error());
		
		while ($row6 = mysql_fetch_array($res6))
		{
			$uid[] = $row6['user_id'];
		}
		
		// then take that data, put it into matchessquad (this is all so that a dotd/motm can be selected again
		for ($i=0; $i<sizeof($uid); $i++)
		{
			$sql7 = "INSERT INTO `match_squad` (`user_id`, `squad_id`, `match_id`, `available`) VALUES ( " .
					"'" . $uid[$i] . "', " .
					"'" . $squad . "', " .
					"'" . $newid . "', " .
					"'1')";
			$res7 = mysql_query($sql7)
				or die("Error with query 7: " . mysql_error());
		}
		//Before the scorers, ycards and rcards entries are deleted, they need to be tallied for FH
		//Scorers
		$fsql = "SELECT * FROM scorers WHERE report_id = '" . $_POST['reportid'] . "'";
		$fres = mysql_query($fsql)
			or die("Error with FH query 1: " . mysql_error());
		
		while ($frow = mysql_fetch_array($fres))
		{
			$scorers[] = $frow['user_id'];
		}
		$scorervalues = array_count_values($scorers);
		//YCards
		$fsql2 = "SELECT * FROM ycards WHERE report_id = '" . $_POST['reportid'] . "'";
		$fres2 = mysql_query($fsql2)
			or die("Error with FH query 1: " . mysql_error());
		
		while ($frow2 = mysql_fetch_array($fres2))
		{
			$ycards[] = $frow2['user_id'];
		}
		//RCards
		$fsql3 = "SELECT * FROM rcards WHERE report_id = '" . $_POST['reportid'] . "'";
		$fres3 = mysql_query($fsql3)
			or die("Error with FH query 1: " . mysql_error());
		
		while ($frow3 = mysql_fetch_array($fres3))
		{
			$rcards[] = $frow3['user_id'];
		}
		
		//Get the MOTM from the report
		$fsql4 = "SELECT motm FROM matchreports WHERE report_id = '".$_POST['reportid']."'";
		$fres4 = mysql_query($fsql4)
			or die(mysql_error());
		$frow4 = mysql_fetch_array($fres4);
		$motm = $frow4['motm'];
		
		// FANTASY HOCKEY
		// May not look like much but it is!
		$minus = 1;
		if ($friendly == 0) // No points scored for friendly matches
		{
			$points = array_map("calcScore", $uid);

			// Calculates the points awarded to each team
			CalcTeamPoints();
		}
		
		// quickly delete all the entries from scorers
		$sql9 = "DELETE FROM scorers WHERE report_id = '" . $_POST['reportid'] . "'";
		$res9 = mysql_query($sql9)
			or die("Error with query 9: " . mysql_error());
			
		// quickly delete all the entries from ycards
		$sql10 = "DELETE FROM ycards WHERE report_id = '" . $_POST['reportid'] . "'";
		$res10 = mysql_query($sql10)
			or die("Error with query 10: " . mysql_error());
			
		// quickly delete all the entries from rcards
		$sql11 = "DELETE FROM rcards WHERE report_id = '" . $_POST['reportid'] . "'";
		$res11 = mysql_query($sql11)
			or die("Error with query 11: " . mysql_error());
		
		// then delete all those entries from playedmatch_user
		$sql8 = "DELETE FROM playedmatch_user WHERE match_id = '" . $_POST['matchid'] . "'";
		$res8 = mysql_query($sql8)
			or die("Error with query 8: " . mysql_error());
		
		// next, disassociate any pictures for the match report
		// This doesn't exist in USEv4
		/*
		$sql3 = "DELETE FROM playedmatch_pictures WHERE report_id = '" . $_POST['reportid'] . "'";
		$res3 = mysql_query($sql3)
			or die("Error with query 3: " . mysql_error());
		*/
		
		// then delete the playedmatch
		$sql4 = "DELETE FROM playedmatches WHERE match_id = '" . $_POST['matchid'] . "' LIMIT 1";
		$res4 = mysql_query($sql4)
			or die("Error with query 4: " . mysql_error());
		
		// and finally delete the report itself
		$sql5 = "DELETE FROM matchreports WHERE report_id = '" . $_POST['reportid'] . "'";
		$res5 = mysql_query($sql5)
			or die("Error with query 5: " . mysql_error());
		
		// LOG SUBMISSION
		$logdata = 	'User deleted match report with report_id: '.$_POST['reportid'].' about match_id '.$_POST['matchid'];
		submitlog($logdata);
		
		header('location:../memberpages.php?Page=matchreports');
	break;

	case "edit":
		// For FH, variables need to be set up and old stats need to be polled. The FH function will be run twice
		$scorers = array();
		$ycards = array();
		$rcards = array();
		// Get old data
		$fsql = "SELECT opp_score, friendly FROM playedmatches WHERE match_id = '".$_POST['id']."'";
		$fres = mysql_query($fsql)
			or die(mysql_error());
		$frow = mysql_fetch_array($fres);
		$oscore = $frow['opp_score'];
		$friendly = $frow['friendly'];
		
		$fsql2 = "SELECT motm FROM matchreports WHERE report_id = '".$_POST['reportid']."'";
		$fres2 = mysql_query($fsql2)
			or die(mysql_error());
		$frow2 = mysql_fetch_array($fres2);
		$motm = $frow2['motm'];
		
		// Get uids
		$sql6 = "SELECT * FROM playedmatch_user WHERE match_id = '" . $_POST['id'] . "'";
		$res6 = mysql_query($sql6)
			or die("Error with query 6: " . mysql_error());
		while ($row6 = mysql_fetch_array($res6))
		{
			$uid[] = $row6['user_id'];
		}
		
		//Before the scorers, ycards and rcards entries are deleted, they need to be tallied for FH
		//Scorers
		$fsql3 = "SELECT * FROM scorers WHERE report_id = '" . $_POST['reportid'] . "'";
		$fres3 = mysql_query($fsql3)
			or die("Error with FH query 1: " . mysql_error());
		
		while ($frow3 = mysql_fetch_array($fres3))
		{
			$scorers[] = $frow3['user_id'];
		}
		$scorervalues = array_count_values($scorers);
		
		//YCards
		$fsql4 = "SELECT * FROM ycards WHERE report_id = '" . $_POST['reportid'] . "'";
		$fres4 = mysql_query($fsql4)
			or die("Error with FH query 1: " . mysql_error());
		
		while ($frow4 = mysql_fetch_array($fres4))
		{
			$ycards[] = $frow4['user_id'];
		}
		//RCards
		$fsql5 = "SELECT * FROM rcards WHERE report_id = '" . $_POST['reportid'] . "'";
		$fres5 = mysql_query($fsql5)
			or die("Error with FH query 1: " . mysql_error());
		
		while ($frow5 = mysql_fetch_array($fres5))
		{
			$rcards[] = $frow5['user_id'];
		}
		
		// FANTASY HOCKEY
		// May not look like much but it is!
		$minus = 1;
		if ($friendly == 0) // No points scored for friendly matches
		{
			$points = array_map("calcScore", $uid);
			// Calculates the points awarded to each team
			CalcTeamPoints();
		}
		
		// Reset the arrays
		$scorers = array();
		$scorervalues = array();
		$ycards = array();
		$rcards = array();
		
		// Now - re-add the new stuff
		$report = myAddSlashes(nl2br(trim($_POST['report'])));
		$motm = trim($_POST['motm']);
		$dotd = trim($_POST['dotd']);
		$hscore = myAddSlashes(trim($_POST['hscore']));
		$oscore = myAddSlashes(trim($_POST['oscore']));
		$scorers = substr($_POST['scorers'],1);
		$scorers = array_slice(split(",",$scorers),1);
		$scorervalues = array_count_values($scorers);
		$ycards = substr($_POST['ycards'],1);
		$ycards = array_slice(split(",",$ycards),1);
		$rcards = substr($_POST['rcards'],1);
		$rcards = array_slice(split(",",$rcards),1);
		
		$sql = "UPDATE `playedmatches` SET home_score = '".$hscore. 
					"', opp_score = '".$oscore."' ".
					"WHERE match_id = '" . $_POST['id'] . "'";
					
		$sql1 = "UPDATE `matchreports` SET `text` = '". $report ."', ".
				"`motm` = '". $motm . "', ".
				"`dotd` = '". $dotd . "' WHERE `report_id` = '" . $_POST['reportid'] . "'";
				
		// deletes all users currently associated with scoring in that game
		$deletescorers = "DELETE FROM scorers " .
						"WHERE report_id = '" . $_POST['reportid'] . "'";
						
		// deletes all users currently associated with scoring in that game
		$deleteycards = "DELETE FROM ycards " .
						"WHERE report_id = '" . $_POST['reportid'] . "'";
						
		// deletes all users currently associated with scoring in that game
		$deletercards = "DELETE FROM rcards ".
						"WHERE report_id = '" . $_POST['reportid'] . "'";
		
		//adds the new scorers into scorers
		if ($scorers[0] != '')
		{
			$addscorers = "INSERT INTO `scorers` (`report_id` , `user_id`) VALUES ";
			for($a =0;$a<count($scorers);$a++)
			{
				$addscorers = $addscorers . "(" ."'" . $_POST['id'] . "', " ."'" . $scorers[$a] . "'),";
			}
			$addscorers = substr($addscorers,0,(strlen($addscorers)-1));
		}
		
		//adds the new naughty players into ycards
		if ($ycards[0] != '')
		{
			$addycards = "INSERT INTO `ycards` (`report_id` , `user_id`) VALUES ";
			for($a =0;$a<count($ycards);$a++)
			{
				$addycards = $addycards . "(" ."'" . $_POST['id'] . "', " ."'" . $ycards[$a] . "'),";
			}
			$addycards = substr($addycards,0,(strlen($addycards)-1));
		}
		
		//adds the new extremely naughty players into rcards
		if ($rcards[0] != '')
		{
			$addrcards = "INSERT INTO `rcards` (`report_id` , `user_id`) VALUES ";
			for($a =0;$a<count($rcards);$a++)
			{
				$addrcards = $addrcards . "(" ."'" . $_POST['id'] . "', " ."'" . $rcards[$a] . "'),";
			}
			$addrcards = substr($addrcards,0,(strlen($addrcards)-1));
		}
			
		if (isset($sql) && (!empty($sql)))
		{
			$result = mysql_query($sql)
				or die("Invalid query: " . mysql_error());
			$result1 = mysql_query($sql1)
				or die("Invalid query1: " . mysql_error());
			$result2 = mysql_query($deletescorers)
				or die("Invalid query deletescorers : " . mysql_error());
			$result3 = mysql_query($deleteycards)
				or die("Invalid query deleteycards : " . mysql_error());
			$result4 = mysql_query($deletercards)
				or die("Invalid query deletercards : " . mysql_error());
			if ($scorers[0] != '')
			{
				$result5 = mysql_query($addscorers)
					or die("Invalid query addscorers: " . mysql_error());
			}
			if ($ycards[0] != '')
			{
				$result6 = mysql_query($addycards)
					or die("Invalid query addycards: " . mysql_error());
			}
			if ($rcards[0] != '')
			{
				$result7 = mysql_query($addrcards)
					or die("Invalid query addrcards: " . mysql_error());
			}
			
			// FANTASY HOCKEY 2
			// May not look like much but it is!
			$minus = 0;
			if ($friendly == 0) // No points scored for friendly matches
			{
				$points = array_map("calcScore", $uid);
				
				// Calculates the points awarded to each team
				CalcTeamPoints();
			}
			
			// LOG SUBMISSION
			$logdata = 	'User edited match report with report_id '. $_POST['id'];
			submitlog($logdata);
		}
		header('location:../memberpages.php?Page=matchreports');
		ob_end_flush();
	break;
	
	case 'arc':
		$ids = split(",",$_POST['IDs']);
		
		for ($i=0; $i<sizeof($ids); $i++)
		{
			if ($_POST[$ids[$i]] == 'on')
			{
				$query = "UPDATE playedmatches SET `archived` = 1 WHERE `report_id` = '". $ids[$i] ."'";
				$res = mysql_query($query)
					or die(mysql_error());
			}
			else
			{
				$query = "UPDATE playedmatches SET `archived` = 0 WHERE `report_id` = '". $ids[$i] ."'";
				$res = mysql_query($query)
					or die(mysql_error());
			}
		}
		$succ = urlencode('Successfully Archived Reports');
		if($_POST['next'] != '')
			header('location:../memberpages.php?Page=matchreports&succ='.$succ.'&next='.$_POST['next']);
		else
			header('location:../memberpages.php?Page=matchreports&succ='.$succ);
	break;
}
?>