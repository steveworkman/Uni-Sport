<?php
include_once('inc/connect.inc.php');
include_once('smarty_connect.php');
include_once('classes/class.Match.php');
// Now, get the details for the match
$currmatch = '';
if(empty($_GET['match_id']) && !isset($_GET['match_id']))
{
    $currmatch = $matches[0];
}
else
{
	if($_GET['ajax'] == 1)
	{
		$currmatch = new Match($_GET['match_id']);
		$smarty->assign('match_id',$currmatch->match_id);
	}
	else
	{
		for($i=0; $i<sizeof($matches); $i++)
		{
			if($_GET['match_id'] == $matches[$i]->match_id)
			{
				$currmatch = $matches[$i];
				$smarty->assign('match_id',$currmatch->match_id);
				break;
			}
		}
	}
}
if($currmatch != '')
{
    $squad = $currmatch->getSquad();
    $smarty->assign('squad',$squad);
    // So that they match the rest of the template
    $smarty->assign('ycardsquad',$squad);
    $smarty->assign('rcardsquad',$squad);
}
else
{
    $error = 'No such match';
}
$smarty->assign('error',$error);
if($_GET['ajax'] == 1)
	$smarty->display('reportdetails.tpl');
?>
