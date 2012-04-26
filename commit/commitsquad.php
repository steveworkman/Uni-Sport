<?php
ob_start();
include('../inc/commitfunctions.inc.php');
include('../inc/connect.inc.php');
include('../inc/secure_page.inc.php');
	
switch ($_GET['Action'])
{
	case "add":
		$error = '';
		//input validation
		$name = myAddSlashes(trim($_POST['name']));
		$desc = myAddSlashes(trim($_POST['desc']));
		$captain = trim($_POST['captain']);
		// Get the squad and put them into an array
		$squad = array();
		for($i=1; $i<$_POST['playernum']; $i++)
		{
			$squad[] = $_POST[$i];
		}
		if (empty($desc))
		{
			$error .= "Please+enter+a+squad+description%21%0D%0A";
		}
		if (empty($name))
		{
			$error .= "Please+enter+a+name+for+the+squad%21%0D%0A";
		}
		
		if (empty($error))
		{
			$sql = "INSERT INTO `squads` (`name` , `description`, `captain`) VALUES (" .
						"'" . $name . "', " .
						"'" . $desc . "', ".
						"'" . $captain . "')";
		}
		else
		{
			header("location:../adminpages.php?Page=squads&Action=add&error=" . urlencode($error));
			ob_end_flush();
		}
		if (isset($sql) && (!empty($sql)))
		{
			$result = mysql_query($sql)
				or die("Invalid query: " . mysql_error());
			$squadid = mysql_insert_id();
			
			$sql1 = "INSERT INTO `user_squad` (`squad_id` , `user_id`) VALUES ";
			for($a=0;$a<count($squad);$a++)
			{
				$sql1 = $sql1 . "(" ."'" . $squadid . "', " ."'" . $squad[$a] . "'),";
			}
			$sql1 = substr($sql1,0,(strlen($sql1)-1));
			
			if (isset($sql) && (empty($error)))
			{
			$result1 = mysql_query($sql1)
				or die("Invalid query: " . mysql_error());
			}
			
			// LOG SUBMISSION
			$logdata = 	'User added squad with squad_id '.$squadid;
			submitlog($logdata);
		}
		header("location:../adminpages.php?Page=squads");
	break;
	
	case "delete":
		$error = '';
		
		/* squads prove to be a difficult thing to deal with when deleting, especially if a squad has already played and is being 
		 * referred to in the playedmatches table. Therefore, a squad is never actually deleted, it is simply moved to the SquadHistory 
		 * table and any references to it in playedmatch_user and playedmatches are updated from there.
		 * This also means that when deleting a match report, it has to be checked whether the squad is still user_active or not. If not, then 
		 * the squad will have to be moved back into squads again.
		 * oh joy!
		 */
		
		// first, get the details of the squad about to be deleted
		$sql1 = "SELECT * FROM squads WHERE squad_id = '" . $_POST['id'] . "'";
		$res1 = mysql_query($sql1)
			or die("Error in query 1: " . mysql_error());
		$row1 = mysql_fetch_array($res1);
		$squadid = $row1['squad_id'];
		$name = $row1['name'];
		$name = ereg_replace("'", "\'", $name);
		$desc = $row1['description'];
		$desc = ereg_replace("'", "\'", $desc);
		$captain = $row1['captain'];
		
		// secondly, put that squad into squadhistory
		$sql2 = "INSERT INTO squadhistory (`squad_id`, `name`, `description`, `captain`) VALUES ( " .
				"'" . $squadid . "', " .
				"'" . $name . "', " .
				"'" . $desc . "', " .
				"'" . $captain . "')";
		$res2 = mysql_query($sql2)
			or die("Error in query 2: " . mysql_error());
		
		// thirdly, delete any references to that squad in the matches table
		$sql3 = "DELETE FROM matches WHERE squad_id = '" . $_POST['id'] . "'";
		$res3 = mysql_query($sql3)
			or die("Error in query 3: " . mysql_error());
		
		// fourthly, delete any references in match_squad
		$sql4 = "DELETE FROM match_squad WHERE squad_id = '" . $_POST['id'] . "'";
		$res4 = mysql_query($sql4)
			or die("Error in query 4: " . mysql_error());
		
		// then, delete any references in usersquad
		$sql5 = "DELETE FROM user_squad WHERE squad_id = '" . $_POST['id'] . "'";
		$res5 = mysql_query($sql5)
			or die("Error in query 5: " . mysql_error());
		
		// and finally delete the squad itself
		$sql6 = "DELETE FROM squads " .
				"WHERE squad_id = '" . $_POST['id'] . "' " .
				"LIMIT 1";
		$res6 = mysql_query($sql6)
			or die("Error in query 6: " . mysql_error());
			
		/* most of the "hard work" is actually done in readreports, matchreports, gallery and fixturescalendar
		 * because they have to determine whether a squad is user_active or if it actually refers to one in
		 * the squadhistory table.
		 */
		 
		// LOG SUBMISSION
		$logdata = 'User deleted squad with squad_id '.$_POST['id'];
		submitlog($logdata);
		header("location:../adminpages.php?Page=squads");
	break;

	case "edit":
		$error = '';
		//input validation
		$name = myAddSlashes(trim($_POST['name']));
		$desc = myAddSlashes(trim($_POST['desc']));
		$squad = array();
		for($i=1; $i<$_POST['playernum']; $i++)
		{
			if($_POST[$i] != '' && $_POST['sel'.$i] != '')
				$squad[] = $_POST[$i];
		}
		$captain = trim($_POST['captain']);
		if (count($squad) < 2)
		{
		$error .= "A+squad+must+contain+more+than+1+member%21%0D%0A";
		}
		if (empty($desc))
		{
			$error .= "Please+enter+a+description%21%0D%0A";
		}
		if (empty($name))
		{
			$error .= "Please+enter+a+name+for+the+squad%21%0D%0A";
		}
		if (empty($error))
		{
			// updates the squad's name and description
			$sql = "UPDATE `squads` SET `name` = '". $name ."', ".
					"`description` = '". $desc . "' WHERE `squad_id` = '" . $_POST['id'] . "'";
					
			// deletes all users currently associated with that squad in usersquad
			$deletesquad = "DELETE FROM user_squad " .
				"WHERE squad_id = '" . $_POST['id'] . "'";
			
			//adds the new set of users back in to usersquad
			$addsquad = "INSERT INTO `user_squad` (`squad_id` , `user_id`) VALUES ";
			for($a=0; $a<count($squad); $a++)
			{
				$addsquad = $addsquad . "(" ."'" . $_POST['id'] . "', " ."'" . $squad[$a] . "'),";
			}
			$addsquad = substr($addsquad,0,(strlen($addsquad)-1));
		}
		else
		{
			header("location:../adminpages.php?Page=squads&amp;Action=add&amp;id=".$_POST['id']."&amp;error=" . urlencode($error));
			ob_end_flush();
		}
		if (isset($sql) && (!empty($sql)))
		{
		
			$result1 = mysql_query($sql)
				or die("Invalid query1: " . mysql_error());
			$result2 = mysql_query($deletesquad)
				or die("Invalid query2: " . mysql_error());
			$result3 = mysql_query($addsquad)
				or die("Invalid query3: " . mysql_error());
			
			/*
			 * Oh dear, you don't know how much of a pratt I feel. I have spent 3 hours and a lot of mental effort
			 * over this bit of code and you've already written it further down the page!!!
			 * However, I decided that my code was better cos it keeps people's availability too
			 */
			
			// get *JUST* the matches that the squad is associated with
				$sql4 = "SELECT match_id FROM match_squad WHERE squad_id = '" . $_POST['id'] . "'";
				$res4 = mysql_query($sql4)
					or die("Error with sql4: " . mysql_error());
				while ($row4 = mysql_fetch_array($res4))
				{
					$onlymatches[] = $row4['match_id'];
				}
								
			// if there are no matches associated with this squad then ignore the next bit completely
			if (mysql_num_rows($res4) != 0)
			{
				$onlymatches = array_unique($onlymatches);
				
				require_once "../classes/class.MatchSquadData.php";
				
				//selects the matchid, user_id and available from matchessquad
				$sql2 = "SELECT match_id, user_id, available FROM match_squad " .
						"WHERE squad_id = '" . $_POST['id'] . "'";
				$res2 = mysql_query($sql2)
					or die("error in query sql2: " . mysql_error());
				
				while ($row2 = mysql_fetch_array($res2))
				{
					// put the results into MatchSquadData objects
					$msd[] = new MatchSquadData($row2['match_id'], $row2['user_id'], $row2['available']);
				}
				
				// finds the users that are still selected from the last time
				for ($b=0; $b<sizeof($squad); $b++)
				{
					// bummer, gotta loop thru $msd now too, the object will still save horrible code later, and that's what
					// the function does anyway!!!
					for ($c=0; $c<sizeof($msd); $c++)
					{
						$msdobject = '';
						$msdobject = $msd[$c];
						if ($squad[$b] == $msdobject->getuserid())
						{
							// these 3 arrays are all in alignment so i don't need a new MSD object
							$match_st[] = $msdobject->getmatchid();
							$user_st[] = $msdobject->getuserid();
							$avail_st[] = $msdobject->getavailability();
						}
					}
				}
				if (!empty($user_st))
				{
					// remove the people who are still there from the new list
					for ($d=0; $d<sizeof($squad); $d++)
					{
						if (in_array($squad[$d],$user_st))
						{
							$squad[$d] = '-1';
						}
					}
				}

				//if $squad is not empty then it carries on, if tis empty, then it stops
				$squadunique = array_unique($squad);
				if (sizeof($squadunique) != 1)
				{
				
					// delete the old data from match_squad
					$sql3 = "DELETE FROM match_squad WHERE squad_id = '" . $_POST['id'] . "'";
					$res3 = mysql_query($sql3)
						or die("Error in query sql3: " . mysql_error());
											
					
					$addmatchsquad = "INSERT INTO `match_squad` (`user_id` , `squad_id`, `match_id`, `available`) VALUES ";
					// add back in all of the MSD object ones as long as the MSD arrays aren't empty
					if (!empty($user_st))
					{
						for($e=0; $e<sizeof($match_st); $e++)
						{
							$addmatchsquad = $addmatchsquad . "('" . $user_st[$e] . "', '" . $_POST['id'] . "', " . "'" . $match_st[$e] . "', '" . $avail_st[$e] . "'),";
						}
					}
					
					// append to that the new people
					// each new person is added to every match that the squad is associated with
					for ($f=0; $f<sizeof($onlymatches); $f++)
					{
						for($g=1; $g<sizeof($squad); $g++)
						{
							if ($squad[$g] != -1)
							{
								$addmatchsquad = $addmatchsquad . "('" . $squad[$g] . "', '" . $_POST['id'] . "', " . "'" . $onlymatches[$f] . "', '-1'),";
							}
						}
					}
					$addmatchsquad = substr($addmatchsquad,0,(strlen($addmatchsquad)-1));
					
					// commit this mofo of a query to the db
					$res5 = mysql_query($addmatchsquad)
						or die("Error with the big query sql5: " . mysql_error());
				}
			}
			// LOG SUBMISSION
			$logdata = 'User edited squad with squad_id '.$_POST['id'];
			submitlog($logdata);
		}
	header("location:../adminpages.php?Page=squads");
}
?>