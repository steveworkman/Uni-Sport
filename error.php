<?php
define('CURR_PAGE', 'home');
define('PAGE_TITLE','Error');
$css = array();
$js = array();
include('inc/unsecure_page.inc.php');
include('inc/indexfunctions.inc.php');
include('inc/header.inc.php');
include('inc/sidebar.inc.php');
switch($_GET['type'])
{
	case 'hack':
		$smarty->assign('title','Hacking Attempt Detected');
		$smarty->assign('text','Ooh, you naughty little munchkin! I saw that!<br />Your hacking attempt has been recorded. DO NOT try it again');
		submitlog('Hacking Attempt Detected');
		$smarty->display('error.tpl');
	break;
	
	case 'auth':
		$smarty->assign('title','Authentication Failed');
		$smarty->assign('text',"Oops, you don't appear to have the right security level to access that area<br /><br />For some areas of this site, you need to be logged in. Try the box on the left<br /><br />Give the administrator a bell if you think this is wrong.");
		$smarty->display('error.tpl');
	break;
	
	case 'user':
		$smarty->assign('title','Incorrect User');
		$smarty->assign('text',"Oh my, it looks like you're trying to edit or delete something you didn't create in the first place!<br /><br />Unless you're an admin, that's a big no no round here. Use the links to take you back from whence you came");
		$smarty->display('error.tpl');
	break;
	
	case '404':
		$smarty->assign('title','Computer says no');
		$smarty->assign('text',"Oh no! You've wandered off the beaten path!<br /><br />Never mind, look around for the right link or use the big links at the top to start again");
		$smarty->display('error.tpl');
	break;
	
	case '401':
		$smarty->assign('title','Authorisation Required');
		$smarty->assign('text',"It seems like you'll go no further from here, unless you know the password!<br /><br />Refresh the page to try again");
		$smarty->display('error.tpl');
	break;
	
	case '403':
		$smarty->assign('title','Forbidden');
		$smarty->assign('text',"Well, now you're in trouble! You've found a forbidden area.<br /><br />Quick! use the links to get back before you're spotted!");
		$smarty->display('error.tpl');
	break;
	
	case '500':
		$smarty->assign('title','Server Problems');
		$smarty->assign('text',"This is one of those, it's not you, it's me, moments.<br /><br />We're very sorry that the server has thrown a wobbly, we'll get a new hamster for the wheel in a short while.");
		$smarty->display('error.tpl');
	break;
	
	default:
		$smarty->assign('title','Error');
		$smarty->assign('text',"Well done, you've caused a generic error. Either we don't have a name for it yet or you've done so many things wrong we can't count any more<br /><br />If you'd like to let your administrator know how you caused such a thing, we'll name it after you");
		$smarty->display('error.tpl');
	break;
}
include ('inc/sidebar2.inc.php');
include ('inc/footer.inc.php');
?>