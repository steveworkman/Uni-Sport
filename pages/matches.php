<?php
include('classes/class.Match.php');

/*
 * Gets the squads and their names for selects
 * Returns array('id'=>'name');
 */
function getSquads()
{
	$squadquery = 'SELECT squad_id, name FROM squads ORDER BY name';
	$squadresults = mysql_query($squadquery)
		or die(mysql_error());
	$squads = array();
	while ($squadrow = mysql_fetch_array($squadresults))
	{
		$squads[$squadrow['squad_id']] = $squadrow['name'];
	}
	return $squads;
}

if (SEC_LVL == 1|| SEC_LVL == 3)
{
	switch ($_GET['Action'])
	{
		case "add":
			$smarty->assign('error',urldecode($_GET['error']));
			$smarty->assign('pageTitle','Add Match');
			$smarty->assign('formLink','./commit/commitmatch.php?Action=add');
			$smarty->assign('squads',getSquads());
			$home = array('1'=>'Home','0'=>'Away');
			$smarty->assign('home',$home);
			$smarty->display('addmatch.tpl');
		break;
		
		case "edit":
			$smarty->assign('error',urldecode($_GET['error']));
			$smarty->assign('pageTitle','Edit Match');
			$smarty->assign('formLink','./commit/commitmatch.php?Action=edit');
			$smarty->assign('squads',getSquads());
			$match = new Match($_GET['id']);
			$home = array('1'=>'Home','0'=>'Away');
			$smarty->assign('home',$home);
			if($match->friendly == 1)
				$smarty->assign('friendly', 'checked=checked');
			$match->desc = br2nl($match->desc);
			$smarty->assign('match',$match);
			$smarty->display('addmatch.tpl');
		break;
				
		case "delete":
			$smarty->assign('match',new Match($_GET['id']));
			$smarty->display('deletematch.tpl');
		break;
						
		default:
			$allText = '';
			if($_GET['all'] != 1)
				$allText = 'WHERE m.date >= CURRENT_DATE ';
			$e_query = 'SELECT m.match_id ' .
						'FROM matches AS m '.
						$allText.
						'ORDER BY m.date DESC';
						
			$e_result = mysql_query($e_query)
				or die(mysql_error());
			if (mysql_num_rows($e_result) == 0)
			{
				$smarty->assign('error','There are currently no matches yet to be played in the database<br/>Click "Show All Matches" to see all matches without match reports');
				SmartyPaginate::setTotal(0);
				$smarty->display('listmatches.tpl');
				break;
			}
			else
			{
				$matches = array();
				while ($e_row = mysql_fetch_array($e_result))
				{
					$matches[] = new Match($e_row['match_id']);
				}
			}
			SmartyPaginate::setTotal(count($matches));
			$matches = array_slice($matches, SmartyPaginate::getCurrentIndex(),SmartyPaginate::getLimit());
			$smarty->assign('matches',$matches);
			if($_GET['all'] == 1)
				SmartyPaginate::setUrl('adminpages.php?Page=matches&all=1');
			else
				SmartyPaginate::setUrl('adminpages.php?Page=matches');
			SmartyPaginate::assign($smarty); // For pagination
			$smarty->display('listmatches.tpl');
			SmartyPaginate::disconnect();
	}
}
else
{
	throw_error('AUTH');
}
?>