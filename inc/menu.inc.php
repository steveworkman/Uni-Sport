<?php
/* This is a 'context-sensitive' menu,
 * based upon the current PageID, it switches
 * to display the correct links
 * Outputs to a sidebarContent template using a
 * sidebarContent object.
 */
$content = new SidebarContent("Menu");
$data = array();
$pagename = '';
// This code find the name of the page
$pagenamearray =  explode('/', $_SERVER['SCRIPT_NAME']);
for ($i=0; $i<sizeof($pagenamearray); $i++)
{
	$strlen = strlen($pagenamearray[$i]);
	if (substr($pagenamearray[$i],($strlen-4),$strlen) == '.php')
	{
		$pagename = substr($pagenamearray[$i],0,($strlen-4));
	}
}
$admin = array();
$admin[] = array('link'=>'adminpages.php?Page=managemembers',
								'text'=>'Manage Members');
$admin[] = array('link'=>'adminpages.php?Page=log',
				'text'=>'Security Log');
$admin[] = array('link'=>'adminpages.php?Page=activationmenu',
				'text'=>'Activation Menu');
$admin[] = array('link'=>'adminpages.php?Page=settings',
				'text'=>'Site Settings');
$admin[] = array('link'=>'adminpages.php?Page=ads',
				'text'=>'Adverts');
$admin[] = array('link'=>'adminpages.php?Page=infopages',
				'text'=>'Information Pages');
$admin[] = array('link'=>'adminpages.php?Page=fhockey',
				'text'=>'Fantasy League');
$admin[] = array('link'=>'adminpages.php?Page=help',
				'text'=>'Help Pages');
 
 // Main switch
 switch($pagename)
 {
 	// Case for Fantasy Hockey Index
 	case 'fhockey':
		// check if user already has a team
		if(USR_ID != '')
		{
			$fq = 'SELECT team_id FROM fteams WHERE user_id = '.USR_ID;
			$fres = mysql_query($fq)
				or die(mysql_error());
			if (USR_LOGGED != '' && mysql_num_rows($fres) == 0)
			{
				$data[] = array('link'=>'./fhockey.php?Page=create',
								'text'=>'Create a Team');
			}
			else
			{
				$data[] = array('link'=>'./fhockey.php?Page=myteam',
								'text'=>'My Team');
				$data[] = array('link'=>'./fhockey.php?Page=transfers',
								'text'=>'Transfers');
			}
		}
		
		$data[] = array('link'=>'./fhockey.php?Page=rules',
						'text'=>'Rules');
		$data[] = array('link'=>'./fhockey.php?Page=prizes',
						'text'=>'Prizes');
	break;
	
		
 	// Case for administrative pages
 	case 'adminpages':
		// Switch again on the inner page
		switch($_GET['Page'])
		{
			// Case for all Admin Menu pages
			case 'managemembers':
				$data[] = array('link'=>'adminpages.php?Page=managemembers&amp;action=add',
								'text'=>'Add Member');
				$data = array_merge($data, $admin);
			break;
			
			case 'ads':
				$data[] = array('link'=>'adminpages.php?Page=ads&amp;action=add',
								'text'=>'Add Advert');
				$data = array_merge($data, $admin);
			break;
			
			case 'infopages':
				$data[] = array('link'=>'adminpages.php?Page=infopages&amp;action=add',
								'text'=>'Add Info Page');
				$data = array_merge($data, $admin);
			break;
			
			case 'help':
				$data[] = array('link'=>'adminpages.php?Page=help&amp;action=add',
								'text'=>'Add Help Page');
				$data = array_merge($data, $admin);
			break;
			
			case 'admin':
			case 'log':
			case 'settings':
			case 'fhockey':
			case 'activationmenu':
				$data = $admin;
			break;
			
			
			// Case for squad pages
			case 'matches':
				$data[] = array('link'=>'adminpages.php?Page=matches&Action=add',
								'text'=>'Create a Match');
				$data[] = array('link'=>'adminpages.php?Page=matches',
								'text'=>'Match List');
				if($_GET['all'] == 0 || empty($_GET['all']))
				{
					$data[] = array('link'=>'adminpages.php?Page=matches&next='.$_GET['next'].'&all=1',
									'text'=>'Show All Matches');
				}
				else
				{
					$data[] = array('link'=>'adminpages.php?Page=matches&next='.$_GET['next'],
									'text'=>'Show Unplayed Matches');
				}
			break;
			
			
			// Case for squad pages
			case 'squads':
				$data[] = array('link'=>'adminpages.php?Page=squads&Action=add',
								'text'=>'Create a Squad');
				$data[] = array('link'=>'adminpages.php?Page=squads',
								'text'=>'Squad List');
			break;
			
			
			// Case for newsletter pages
			case 'newslettermenu':
				$data[] = array('link'=>'adminpages.php?Page=newslettermenu&Action=add',
								'text'=>'Upload a Newsletter');
				$data[] = array('link'=>'adminpages.php?Page=newslettermenu',
								'text'=>'Newsletter List');
				if($_GET['arc'] == 0 || empty($_GET['arc']))
				{
					$data[] = array('link'=>'adminpages.php?Page=newslettermenu&next='.$_GET['next'].'&arc=1',
									'text'=>'Show Archived Newsletters');
				}
				else
				{
					$data[] = array('link'=>'adminpages.php?Page=newslettermenu&next='.$_GET['next'],
									'text'=>'Hide Archived Newsletters');
				}
			break;
			
			// Case for news pages
			case 'news':
				$data[] = array('link'=>'adminpages.php?Page=news&Action=add',
								'text'=>'Write A Story');
				$data[] = array('link'=>'adminpages.php?Page=news',
								'text'=>'News Story List');
				if($_GET['arc'] == 0 || empty($_GET['arc']))
				{
					$data[] = array('link'=>'adminpages.php?Page=news&next='.$_GET['next'].'&arc=1',
									'text'=>'Show Archived Stories');
				}
				else
				{
					$data[] = array('link'=>'adminpages.php?Page=news&next='.$_GET['next'],
									'text'=>'Hide Archived Stories');
				}
			break;
			
			// Case for Fantasy league news pages
			case 'fnews':
				$data[] = array('link'=>'adminpages.php?Page=fnews&Action=add',
								'text'=>'Write A Story');
				$data[] = array('link'=>'adminpages.php?Page=fnews',
								'text'=>'News Story List');
				if($_GET['arc'] == 0 || empty($_GET['arc']))
				{
					$data[] = array('link'=>'adminpages.php?Page=fnews&next='.$_GET['next'].'&arc=1',
									'text'=>'Show Archived Stories');
				}
				else
				{
					$data[] = array('link'=>'adminpages.php?Page=fnews&next='.$_GET['next'],
									'text'=>'Hide Archived Stories');
				}
			break;
			
			// Case for events pages
			case 'events':
				$data[] = array('link'=>'adminpages.php?Page=events&Action=add',
								'text'=>'Create an Event');
				$data[] = array('link'=>'adminpages.php?Page=events',
								'text'=>'Events List');				
				if($_GET['arc'] == 0 || empty($_GET['arc']))
				{
					$data[] = array('link'=>'adminpages.php?Page=events&next='.$_GET['next'].'&arc=1',
									'text'=>'Show Archived Events');
				}
				else
				{
					$data[] = array('link'=>'adminpages.php?Page=events&next='.$_GET['next'],
									'text'=>'Hide Archived Events');
				}
			break;
		}
	
	break;
	
	
	// Case for regular member pages
	case 'memberpages':
		// Switch again on the inner page
		switch($_GET['Page'])
		{
			// Case for match report pages
			case 'matchreports':
				$data[] = array('link'=>'memberpages.php?Page=matchreports&Action=add',
								'text'=>'Write A Match Report');
				$data[] = array('link'=>'memberpages.php?Page=matchreports',
								'text'=>'Match Reports List');
				if($_GET['arc'] == 0 || empty($_GET['arc']))
				{
					$data[] = array('link'=>'memberpages.php?Page=matchreports&next='.$_GET['next'].'&arc=1',
									'text'=>'Show Archived Matches');
				}
				else
				{
					$data[] = array('link'=>'memberpages.php?Page=matchreports&next='.$_GET['next'],
									'text'=>'Hide Archived Matches');
				}
			
			break;
			
			// Case for match report pages
			case 'picmenu':
				$data[] = array('link'=>'memberpages.php?Page=picmenu&Action=add',
								'text'=>'Create an Album');
				$data[] = array('link'=>'memberpages.php?Page=picmenu',
								'text'=>'Album List');
			break;
			
			// Case for userdetail pages
			case 'userdetails':
				if(SEC_LVL == 1 || USR_ID == $id)
				{
					$data[] = array('link'=>'memberpages.php?Page=userdetails&Action=edit&user_id='.$id,
									'text'=>'Edit Profile');
				}
			break;
		
			// Default page
			default:
				$data = getInformation();
			break;
		}
	break;
 
	
	// Below are all the 'public' pages. i.e. those that do not require login
	
	// Case for viewing a non-played event
	case 'matchdetails':
		if (USR_LOGGED != '' && !empty($match->squad_id))
		{
			$data[] = array('link'=>'memberpages.php?Page=matchreports&Action=add&matchid='.$_GET['match_id'],
							'text'=>'Add a match report for this match');
			$data[] = array('link'=>'squadstatus.php?id='.$_GET['match_id'].'&height=300&width=300',
							'text'=>'Squad Status',
							'class'=>'thickbox');
			if(SEC_LVL == 3 || SEC_LVL == 1)
			{
				$data[] = array('link'=>'adminpages.php?Page=matches&Action=add',
								'text'=>'Add a match');
				if(($match->captain.id == USR_ID || SEC_LVL == 1))
				{
					$data[] = array('link'=>'adminpages.php?Page=matches&Action=edit&id='.$match->match_id,
								'text'=>'Edit this match');
				}
			}
		}
		$data = array_merge($data, getInformation());
	break;
	
	
	// Case for viewing an event
	case 'viewevent':
		if (USR_LOGGED != '' && !empty($_GET['event_id']))
		{
			/*$data[] = array('link'=>'#',
							'text'=>'Add pictures to this event');*/
			if (SEC_LVL <= 3)
			{
				$data[] = array('link'=>'adminpages.php?Page=events&Action=add',
								'text'=>'Add an event');
				if ((USR_ID == $event->author_id || SEC_LVL == 1) && !empty($event['name']))
				{
					$data[] = array('link'=>'adminpages.php?Page=events&Action=edit&id='.$_GET['event_id'],
									'text'=>'Edit this event');
				}
			}
		}
		$data = array_merge($data, getInformation());
	break;
	
	
	// Case for viewing a news article
	case 'newsdetails':
		if(USR_LOGGED != '' && SEC_LVL < 3)
		{
			$data[] = array('link'=>'adminpages.php?Page=news&Action=add',
							'text'=>'Add News');
			if((SEC_LVL == 1 || USR_ID == $story['author_id']) && $_GET['article_id'] != '')
			{
				$data[] = array('link'=>'adminpages.php?Page=news&Action=edit&id='.$_GET['article_id'],
							'text'=>'Edit Story');
			}
		}
		$data = array_merge($data, getInformation());
	break;
	
	
	// Case for viewing a profile
	case 'viewprofile':
		if((SEC_LVL == 1 || USR_ID == $id) && $_GET['uid'] != '')
		{
			$data[] = array('link'=>'memberpages.php?Page=userdetails&Action=edit&user_id='.$id,
							'text'=>'Edit Profile');
		}
		$data = array_merge($data, getInformation());
	break;
 
 
	// Case for viewing a match report
	case 'matches':
		if(USR_LOGGED != '')
		{
			$data[] = array('link'=>'memberpages.php?Page=matchreports&Action=add',
							'text'=>'Add a match report');
			
			if ((SEC_LVL == 1 || USR_ID == $report->author.id) && !empty($report->match_id))
			{
				$data[] = array('link'=>'memberpages.php?Page=matchreports&Action=edit&id='.$report->id,
								'text'=>'Edit this match report');
			}
			/*if (!empty($_GET['report_id']))
			{
				$data[] = array('link'=>'#',
								'text'=>'Add a picture to this album');
			}*/
		}
		else
			$data = array_merge($data, getInformation());
	break;
	
	
	// Case for calendar
	case 'calendar':
		if (empty($_GET['arc']))
		{	// If the last letter of the request is a p
			if(substr($_SERVER['REQUEST_URI'],strlen($_SERVER['REQUEST_URI'])-1,1) == 'p') 
			{
				$link = $_SERVER['REQUEST_URI'].'?arc=1';
			}
			else
				$link = $_SERVER['REQUEST_URI'].'&amp;arc=1';
			$arctoggle = 'Show';
			
		}
		else if($_GET['arc'] == 0)
		{
			$arctoggle = 'Show';
			$link = substr($_SERVER['REQUEST_URI'], 0, strlen($_SERVER['REQUEST_URI'])-1).'1';
		}
		else
		{
			$arctoggle = 'Hide';
			$link = substr($_SERVER['REQUEST_URI'], 0, strlen($_SERVER['REQUEST_URI'])-1).'0';
		}
		$data[] = array('link'=>$link,
						'text'=>$arctoggle.' archived members',
						'id'=>'toggle');
						
		if (SEC_LVL < 3 && $USR_LOGGED != '')
			$data[] = array('link'=>'adminpages.php?Page=events&Action=add',
							'text'=>'Add an event');
		if(USR_LOGGED != '')
			$data[] = array('link'=>'memberpages.php?Page=matchreports&Action=add',
							'text'=>'Add a match report');
		break;
	
	
	// The following all include the 'getInformation' links
	case 'register':
		$data[] = array('link'=>'http://www.facebook.com',
						'text'=>'Facebook');
		$data = array_merge($data, getInformation());
	break;
	
	
	// Case for information pages
	case 'information':
		if(USR_LOGGED != '' && SEC_LVL == 1)
		{
			$data[] = array('link'=>'adminpages.php?Page=infopages&action=add',
							'text'=>'Add an information page');
			$data[] = array('link'=>'adminpages.php?Page=infopages',
							'text'=>'Edit these pages');
		}
	default:
		$data = array_merge($data, getNewsLinks());
		$content->title = 'News';
	break;
 }
 $content->data = $data;
 $content->nohide = 1; // Disables the menu from being hidden!
 $smarty->assign('menu', $content);
?>