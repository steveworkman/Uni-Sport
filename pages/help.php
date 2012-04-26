<?php
if(SEC_LVL == 1)
{
	switch($_GET['action'])
	{
		case 'add':
			$smarty->assign('formLink','./commit/commithelp.php?Action=add');
			$smarty->assign('pageTitle','Add Help Page');
			$smarty->assign('error',urldecode($_GET['error']));
			$smarty->display('addhelp.tpl');
		break;
		
		case 'edit':
			$data = getHelpPage($_GET['id']);
			$smarty->assign('error',urldecode($_GET['error']));
			if(empty($data))
				$smarty->assign('error','No help page found');
			$smarty->assign('help',$data);
			$smarty->assign('formLink','./commit/commithelp.php?Action=edit');
			$smarty->assign('pageTitle','Edit Help Page');
			$smarty->display('addhelp.tpl');
		break;
		
		case 'delete':
			$smarty->assign('help',getHelpPage($_GET['id']));
			$smarty->assign('formLink','./commit/commithelp.php?Action=delete');
			$smarty->assign('pageTitle','Delete Help Page');
			$smarty->display('deletehelp.tpl');
		break;
		
		default:
			SmartyPaginate::setLimit(20);
			$data = array();
			$data = getHelpPages();
			$smarty->assign('data',$data);
			SmartyPaginate::setUrl('adminpages.php?Page=help');
			SmartyPaginate::assign($smarty); // For pagination
			$smarty->display('listhelp.tpl');
			SmartyPaginate::disconnect();
		break;
	}
}
else
	throw_error('AUTH');
?>