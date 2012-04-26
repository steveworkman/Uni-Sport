<?php
define('CURR_PAGE', 'home');
define('PAGE_TITLE','Help');
include('inc/unsecure_page.inc.php');
include('inc/indexfunctions.inc.php');
include('inc/header.inc.php');
include('inc/sidebar.inc.php');

// Get the help details out of the DB
$smarty->assign('help',getHelpPages());
$smarty->display('help.tpl');
include ('inc/sidebar2.inc.php');
include ('inc/footer.inc.php');
?>