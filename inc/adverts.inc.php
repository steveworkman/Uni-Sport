<?php
if(!$smarty->is_cached('adverts.tpl')) {
	// Adverts not cached. Retrieve data
	$aq = "SELECT * FROM adverts ORDER BY sequence";
	$ares = mysql_query($aq)
  		or die(mysql_error());
	$ads = array();
	while($arow = mysql_fetch_array($ares))
	{
		$ads[] = array('link'=>$arow['link'], 'img'=>$arow['path'], 'alt'=>$arow['alt']);
	}
	$smarty->assign('adverts', $ads);
}
?>