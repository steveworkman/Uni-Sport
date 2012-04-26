<?php 
if (SEC_LVL == 1 || SEC_LVL == 2)
{
	switch ($_GET['Action'])
	{
		case "add":
			$smarty->assign('pageTitle','Upload Newsletter');
			$smarty->assign('formLink','./commit/commitnewsletter.php?Action=upload');
			$smarty->assign('error',urldecode($_GET['error']));
			$smarty->display('addnewsletter.tpl');
		break;
	
		case "edit":
			$smarty->assign('pageTitle','Edit Newsletter');
			$smarty->assign('formLink','./commit/commitnewsletter.php?Action=edit');
			$smarty->assign('error',urldecode($_GET['error']));
			$data = getNewsletter($_GET['id']);
			switch (SEC_LVL)
			{
				case "2":
					if ($data['author_id'] != USR_ID)
					{
						throw_error('USER');
						break;
					}
					
				case "1":
					$smarty->assign('data',$data);
					$smarty->display('editnewsletter.tpl');
			}
		break;
		
		case "delete":
			$smarty->assign('pageTitle','Delete Newsletter');
			$smarty->assign('formLink','./commit/commitnewsletter.php?Action=delete');
			$smarty->assign('error',urldecode($_GET['error']));
			$data = getNewsletter($_GET['id']);
			switch (SEC_LVL)
			{
				case "2":
					if ($data['author_id'] != USR_ID)
					{
						throw_error('USER');
						break;
					}
					
				case "1":
					$smarty->assign('data',$data);
					$smarty->display('deletenewsletter.tpl');
			}
		break;
	
		default:
			$smarty->assign('pageTitle','Newsletters');
			$smarty->assign('formLink','./commit/commitnewsletter.php?Action=arc');
			if(SEC_LVL == 1)
				$id = 0;
			else
				$id = USR_ID;
			if($_GET['arc'] == 1)
				$arc = 1;
			else
				$arc = 0;
			$data = getNewsletterList($id,$arc);
			
			$id = '';
			for ($a=0; $a<sizeof($data); $a++)
			{
				$id .= $data[$a]['id'] . ",";
			}
			$id = substr($id,0,(strlen($id)-1));
			$smarty->assign('data',$data);
			$smarty->assign('ids',$id);
			if($_GET['arc'] == 1)
				SmartyPaginate::setUrl('adminpages.php?Page=newslettermenu&arc=1');
			else
				SmartyPaginate::setUrl('adminpages.php?Page=newslettermenu');
			SmartyPaginate::assign($smarty); // For pagination
			$smarty->display('listnewsletters.tpl');
			SmartyPaginate::disconnect();
	}
}
else
{
	throw_error('AUTH');
}
?>