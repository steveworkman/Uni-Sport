<?php
define('CURR_PAGE', 'home');
define('PAGE_TITLE','Events');
$css = array();
$js = array();
include('inc/unsecure_page.inc.php');
include('inc/indexfunctions.inc.php');
include('inc/header.inc.php');
include('inc/sidebar.inc.php');
		
$event = getEvent($_GET['event_id']);
$smarty->assign('event',$event);
$smarty->display('viewevent.tpl');

include ('inc/sidebar2.inc.php');
include ('inc/footer.inc.php');
?>