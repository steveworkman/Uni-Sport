<?php
if(SEC_LVL == 1)
{
	switch($_GET['action'])
	{
		case "add":
			$smarty->display('addinfopage.tpl');
		break;
		
		default:
			// Need to get the current set levels
			$sq = "SELECT * FROM infopages ORDER BY sequence";
			$sres = mysql_query($sq)
				or die(mysql_error());
			$id = '';
			$data = array();
			while ($srow = mysql_fetch_array($sres))
			{
				$data[] = array('id'=>$srow['page_id'],
								'title'=>$srow['title'],
								'text'=>$srow['text'],
								'seq'=>$srow['sequence']);
				$id .= $srow['page_id'] . ",";
			}
			$id = substr($id,0,(strlen($id)-1));
			$smarty->assign('ids',$id);
			$smarty->assign('pages',$data);
			$smarty->display('listinfopages.tpl');
	}
}
else
{
	throw_error('AUTH');
}
?>