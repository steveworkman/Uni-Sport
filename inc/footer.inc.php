<?php
// Code to find how long it took to render
$round = 3; // The number of decimal places to round the micro time to.
$m_time = explode(" ",microtime());
$m_time = $m_time[0] + $m_time[1];
$endtime = $m_time;
$totaltime = ($endtime - $starttime);
$smarty->assign('rendertime', round($totaltime,$round));

// any informational constants
$smarty->assign('webmaster', 'webmaster@domain.com');
$smarty->cache_lifetime = 0;
$smarty->display('footer.tpl');
?>