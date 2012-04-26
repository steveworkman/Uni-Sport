<?php
define('CURR_PAGE', 'fantasy');
define('PAGE_TITLE','Fantasy League');
$css = array();
$css[] = 'css/forms.css';
$js = array();
include('inc/unsecure_page.inc.php');
include('inc/indexfunctions.inc.php');
include('inc/picfunctions.inc.php');
include ('./fhockey/functions.inc.php');
include ('./fhockey/constants.inc.php');
include('inc/header.inc.php');
include('fhockey/sidebar.inc.php');

switch($_GET['Page'])
{
	case 'create':
		include("./fhockey/create.php");
	break;
	
	case 'rules':
		include("./fhockey/rules.php");
	break;
	
	case 'prizes':
		include("./fhockey/prizes.php");
	break;
	
	case 'myteam':
		include("./fhockey/myteam.php");
	break;
	
	case 'table':
		include("./fhockey/table.php");
	break;
	
	case 'transfers':
		include("./fhockey/transfers.php");
	break;
		
	default:
		include("./fhockey/index.php");
	break;
}

if ($_GET['Page'] != 'create')
	include('inc/sidebar2.inc.php');
include('inc/footer.inc.php');
?>