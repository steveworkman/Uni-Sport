<?php
define('CURR_PAGE', 'home');
define('PAGE_TITLE','Terms and Conditions');
include('inc/unsecure_page.inc.php');
include('inc/indexfunctions.inc.php');
include('inc/header.inc.php');
include('inc/sidebar.inc.php');
$smarty->display('tnc.tpl');
include('inc/sidebar2.inc.php');
include('inc/footer.inc.php');
?>