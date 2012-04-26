<?php
// Login script
// Checks for an error thrown from the phpbb login
if(!empty($_GET['loginerror']) || $_GET['loginerror'] == 1)
	$smarty->assign('loginerror','There was an error logging you in. Please try again');

// Generates login menus
if (USR_LOGGED != '')
{
	$login = array();
	$login[] = checkmatches(USR_ID);
	if(SEC_LVL == 1)
		$login[] = checklogs();
	if(SEC_LVL <= 5)
	{
		if (!empty($login[0]))
			$login[] = array('sep'=>'sep','text'=>'Member Functions', 'hidden'=>'0');
		$login[] = array('link'=>'memberpages.php?Page=userdetails&Action=view',
						'text'=>'My Profile');
		if(USR_ARC == 0)
		{
			$login[] = array('link'=>'memberpages.php?Page=checkmatches',
							'text'=>'Check Matches');
		}
		$login[] = array('link'=>'memberpages.php?Page=matchreports',
						'text'=>'Match Reports');
		$login[] = array('link'=>'memberpages.php?Page=picmenu',
						'text'=>'Pictures');
	}
	if(SEC_LVL <= 2)
	{
		
		$login[] = array('sep'=>'sep', 'text'=>'Committee Menu', 'hidden'=>$status['committee'], 'id'=>'committee');
		$login[] = array('link'=>'adminpages.php?Page=news',
						'text'=>'News');
		$login[] = array('link'=>'adminpages.php?Page=events',
						'text'=>'Events');
		$login[] = array('link'=>'adminpages.php?Page=newslettermenu',
						'text'=>'Newsletters');
		$login[] = array('link'=>'adminpages.php?Page=fnews',
						'text'=>'Fantasy Hockey News');
	}
	if (SEC_LVL != 2 && SEC_LVL <= 3)
	{
		$login[] = array('sep'=>'sep', 'text'=>'Team Captain Menu', 'hidden'=>$status['captain'], 'id'=>'captain');
		$login[] = array('link'=>'adminpages.php?Page=squads',
						'text'=>'Squads');
		$login[] = array('link'=>'adminpages.php?Page=matches',
						'text'=>'Matches');
	}
	if(SEC_LVL <= 1)
	{
		$login[] = array('sep'=>'sep', 'text'=>'Admin Menu', 'hidden'=>$status['admin'], 'id'=>'admin');
		$login[] = array('link'=>'adminpages.php?Page=admin',
						'text'=>'Site Admin');
	}
}
else
{
	$login = 'false';
}
?>