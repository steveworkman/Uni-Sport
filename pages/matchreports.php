<?php
require('classes/class.MatchReport.php');
require('classes/class.Match.php');
switch ($_GET['Action'])
{
	case "add":
		// Get the matches without match reports
		$matchquery = 	'SELECT matches.match_id '.
						'FROM matches '.
						'ORDER BY matches.date DESC';
		$matchresult = mysql_query($matchquery)
			or die(mysql_error());
		$error = '';
		if (mysql_num_rows($matchresult) == 0)
		{
			$error = 'There are currently no matches to write reports for';
		}
		else
		{
			// List the matches
			$matches = array();
			while ($match_row = mysql_fetch_array($matchresult))
			{
				$matches[] = new Match($match_row['match_id']);
			}
			$smarty->assign('matches',$matches);
			// Gets the report details
			include('reportdetails.inc.php');
		} //end "no matches available" if
		$smarty->assign('error',$error);
		$smarty->display('writereport.tpl');
	break;
		
	// Case for editing a match report
	case "edit":
		$currmatch = new MatchReport($_GET['id']);
		$error = '';		
		switch (SEC_LVL)
		{
			default:
				if ($currmatch->author['id'] != USR_ID)
				{
					$error = 'You did not write this match report and therefore cannot edit it';
					break;
				}
			// If it didn't break, it'll cascade into the admin box that doesn't take that check
			case "1":
				$squad = $currmatch->getSquad();
				$scorers = $currmatch->getScorers();
				$ycards = $currmatch->getYellowCards();
				$rcards = $currmatch->getRedCards();
				
				// Gotta remove the people who already have cards
				$ycardsquad = array();
				for($i=0; $i<sizeof($squad);$i++)
				{
					$remove = false;
					for($j=0;$j<sizeof($ycards);$j++)
					{
						if($squad[$i]['id'] == $ycards[$j]['id'])
							$remove = true;
					}
					if(!$remove)
						$ycardsquad[] = $squad[$i];
				}
				$rcardsquad = array();
				for($i=0; $i<sizeof($squad);$i++)
				{
					$remove = false;
					for($j=0;$j<sizeof($rcards);$j++)
					{
						if($squad[$i]['id'] == $rcards[$j]['id'])
							$remove = true;
					}
					if(!$remove)
						$rcardsquad[] = $squad[$i];
				}
				// Convert <br/> to \n in the report
				$currmatch->report = br2nl($currmatch->report);
				
				$smarty->assign('match',$currmatch);
				$smarty->assign('squad',$squad);
				$smarty->assign('scorers',$scorers);
				$smarty->assign('ycards',$ycards);
				$smarty->assign('rcards',$rcards);
				$smarty->assign('ycardsquad',$ycardsquad);
				$smarty->assign('rcardsquad',$rcardsquad);
				
				$smarty->display('editreport.tpl');
		}
	break;
				
	case "delete":
		$match = new MatchReport($_GET['id']);
		
		if ($match->author.id != USR_ID && SEC_LVL != 1)
		{
			$smarty->assign('error','You did not write this match report and therefore cannot delete it');
		}
		$smarty->assign('match',$match);
		$smarty->display('deletereport.tpl');
	break;
			
	default:
		/* Now that everything is in classes, all you need to do is find the IDs of the matches
		 * and let the class get the details
		 */
		 // This bit allows for archived matches to be specified
		 $arctext = '';
		 if($_GET['arc'] == 0)
		 {
		 	$arctext = 'AND pm.archived = 0 ';
		 }
		$matches = array();
		if (SEC_LVL == 1)
		{
			$query = 'SELECT m.report_id FROM matchreports AS m, playedmatches AS pm '.
						'WHERE m.report_id = pm.report_id '.
						$arctext.
						'ORDER BY pm.date DESC';
		}
		else
		{
			$query = 'SELECT m.report_id FROM matchreports AS m, playedmatches AS pm '.
					'WHERE m.user_id = '.USR_ID.' '.
					'AND m.report_id = pm.report_id '.
					$arctext.
					'ORDER BY pm.date DESC';
		}
		$result = mysql_query($query)
			or die(mysql_error());
		
		if (mysql_num_rows($result) == 0)
			$smarty->assign('error','You have not yet written any match reports');
		while ($row = mysql_fetch_array($result))
		{
			$matches[] = new MatchReport($row['report_id']);
		}
		SmartyPaginate::setTotal(count($matches));
		$matches = array_slice($matches, SmartyPaginate::getCurrentIndex(),SmartyPaginate::getLimit());
		// So that archiving works
		$id = '';
		for($i=0; $i<sizeof($matches);$i++)
		{
			$id .= $matches[$i]->id.',';
		}
		$smarty->assign('matches',$matches);
		$smarty->assign('next',$_GET['next']);
		$smarty->assign('succ',urldecode($_GET['succ']));
		$smarty->assign('ids',$id);
		if($_GET['arc'] == 1)
			SmartyPaginate::setUrl('memberpages.php?Page=matchreports&arc=1');
		else
			SmartyPaginate::setUrl('memberpages.php?Page=matchreports');
		SmartyPaginate::assign($smarty); // For pagination
		$smarty->display('listreports.tpl');
		SmartyPaginate::disconnect();
	break;
}
?>