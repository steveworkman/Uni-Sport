<?php
// TODO
// Commit, especially checking the date works
// Archives
// Error pages
if (SEC_LVL == 1 || SEC_LVL == 2)
{
	switch ($_GET['Action'])
	{
		case 'add':
			$smarty->assign('pageTitle','Create Event');
			$smarty->assign('formLink','./commit/commitevent.php?Action=add');
			$smarty->assign('error',urldecode($_GET['error']));
			$smarty->display('addevent.tpl');
		break;
		
		case "edit":
			$smarty->assign('pageTitle','Edit Event');
			$smarty->assign('formLink','./commit/commitevent.php?Action=edit');
			$smarty->assign('error',urldecode($_GET['error']));
			$event = getEvent($_GET['id']);

			switch (SEC_LVL)
			{
				case "2":
					if ($event['author_id'] != USR_ID)
					{
						throw_error('AUTH');
						break;
					}

				case "1":
					$event['desc'] = stripslashes(br2nl($event['desc']));
					$smarty->assign('event',$event);
					// See news.php for explaination of code re-use
					$smarty->display('addevent.tpl');
			}	
				
		break;
				
		case "delete":
			$smarty->assign('pageTitle','Delete Event');
			$event = getEvent($_GET['id']);
			switch (SEC_LVL)
			{
				case "2":
					if ($event['author_id'] != USR_ID)
					{
						throw_error('AUTH');
						break;
					}
				case "1":
					$event['desc'] = stripslashes($event['desc']);
					$smarty->assign('event',$event);
					$smarty->display('deleteevent.tpl');
			}
		break;
				
		default:
			$smarty->assign('pageTitle','Events');
			$smarty->assign('formLink','./commit/commitevent.php?Action=arc');
			if(SEC_LVL == 1)
				$id = 0;
			else
				$id = USR_ID;
			if($_GET['arc'] == 1)
				$arc = 1;
			else
				$arc = 0;
			$events = getEvents(0,$id,$arc);
			$id = '';
			for ($a=0; $a<sizeof($events); $a++)
			{
				$id .= $events[$a]['id'] . ",";
			}
			$id = substr($id,0,(strlen($id)-1));
			$smarty->assign('events',$events);
			$smarty->assign('ids',$id);
			if($_GET['arc'] == 1)
				SmartyPaginate::setUrl('adminpages.php?Page=events&arc=1');
			else
				SmartyPaginate::setUrl('adminpages.php?Page=events');
			SmartyPaginate::assign($smarty); // For pagination
			$smarty->display('listevents.tpl');
			SmartyPaginate::disconnect();
		break;	
		}
	}
else
{
	throw_error('AUTH');
}
?>