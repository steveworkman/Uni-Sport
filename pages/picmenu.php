<?php
switch ($_GET['Action'])
{
	case "upload":
		$smarty->assign('error',urldecode($_GET['error']));
		$smarty->assign('id',$_GET['id']);
		$smarty->display('uploadpictures.tpl');
	break;

	case "edit":
		$smarty->assign('error',urldecode($_GET['error']));
		if(SEC_LVL == 1)
			$uid = 0;
		else
			$uid = USR_ID;
		$data = getPictures($_GET['id'],$uid);
		
		// Check that they're not trying to edit someone else's album
		if($data[0]['album_type'] == 3 && $data[0]['user_id'] != $USR_ID && SEC_LVL != 1)
			throw_error('USER');
		$smarty->assign('album',$data[0]);
		$smarty->assign('pictures',$data[1]);
		$smarty->assign('pic_ids',$data[2]);
		$smarty->display('editalbum.tpl');
	break;
	
	case "delete":
		if(SEC_LVL == 1)
			$uid = 0;
		else
			$uid = USR_ID;
		$data = getPictures($_GET['id'],$uid);
		// Check that they're not trying to edit someone else's album
		if($data[0]['album_type'] == 3 && $data[0]['user_id'] != $USR_ID && SEC_LVL != 1)
			throw_error('USER');
		$smarty->assign('album',$data[0]);
		$smarty->display('deletealbum.tpl');
	break;
	
	case 'add':
		$smarty->assign('error',urldecode($_GET['error']));
		$types = array('3'=>'Personal','1'=>'Event','2'=>'Match');
		$smarty->assign('types',$types);
		$smarty->display('addalbum.tpl');
	break;
	
	default:
		if(SEC_LVL == 1)
			$id = 0;
		else
			$id = USR_ID;
		
		// Get match albums
		$matchalbums = getMatchAlbums($arc);
		$smarty->assign('matchalbums',$matchalbums);
		// Get event albums
		$eventalbums = getEventAlbums($arc);
		$smarty->assign('eventalbums',$eventalbums);
		// Get user albums
		$useralbums = getUserAlbums($uid,1);
		$smarty->assign('useralbums',$useralbums);
		
		$smarty->assign('succ',urldecode($_GET['succ']));
		if($_GET['arc'] == 1)
			SmartyPaginate::setUrl('memberpages.php?Page=picmenu&arc=1');
		else
			SmartyPaginate::setUrl('memberpages.php?Page=picmenu');
		SmartyPaginate::assign($smarty); // For pagination
		$smarty->display('listalbums.tpl');
		SmartyPaginate::disconnect();
	}
?>