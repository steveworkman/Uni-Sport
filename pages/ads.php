<?php
if(SEC_LVL == 1)
{
	switch($_GET['action'])
	{
		case "add":
			$smarty->display('addadvert.tpl');
		break;
		
		default:
			// Need to get the current set levels
			$sq = "SELECT * FROM adverts WHERE ad_id > 0 ORDER BY sequence";
			$sres = mysql_query($sq)
				or die(mysql_error());
			$id = '';
			$adverts = array();
			while ($srow = mysql_fetch_array($sres))
			{
				$adverts[] = array('id'=>$srow['ad_id'],
									'alt'=>$srow['alt'],
									'link'=>$srow['link'],
									'seq'=>$srow['sequence'],
									'src'=>$srow['path']);
				$id .= $srow['ad_id'] . ",";
			}
			$id = substr($id,0,(strlen($id)-1));
			$smarty->assign('adverts',$adverts);
			$smarty->assign('ids',$id);
			$smarty->display('listadverts.tpl');
		break;
	}
}
else
{
	throw_error('AUTH');
}
?>