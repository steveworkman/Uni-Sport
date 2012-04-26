<?php
	$picdata = getRandomPicture();
	$smarty->assign('data',$picdata);
	$smarty->assign('matches', getUpcomingMatches(0,0));
	$smarty->assign('events', getUpcomingEvents(3));
	$smarty->assign('birthdays', getBirthdays('', 1));
	$smarty->clear_cache('feature.tpl');
?>