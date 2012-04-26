<?php

if (SEC_LVL == 1 || SEC_LVL == 2)
{
	switch ($_GET['Action'])
	{
		case "add":
			$smarty->assign('pageTitle','Write News Story');
			$smarty->assign('formLink','./commit/commitfnews.php?Action=add');
			$smarty->assign('error',urldecode($_GET['error']));
			// Get the categories
			$catquery = "SELECT * FROM newsarticlecategories";
			$catresults = mysql_query($catquery)
					or die(mysql_error());
			$cats = array();
			while($catrow = mysql_fetch_array($catresults))
			{
				$cats[$catrow['category_id']] = $catrow['name'];
			}		
			$smarty->assign('cats',$cats);
			$smarty->display('addnews.tpl');
		break;
			
		case "delete":
			$article = getFNewsArticle($_GET['id']);
			$smarty->assign('page',$_GET['Page']);
			switch (SEC_LVL)
			{
				case "2":
					if ($article['author_id'] != USR_ID)
					{
						throw_error('USER');
						break;
					}
						
				case "1":
					$smarty->assign('article',$article);
					$smarty->display('deletenews.tpl');
			}
		break;
				
		case "edit":
			$smarty->assign('pageTitle','Edit News Story');
			$smarty->assign('formLink','./commit/commitfnews.php?Action=edit');
			$smarty->assign('error',urldecode($_GET['error']));
			
			$article = getFNewsArticle($_GET['id']);
			
			switch (SEC_LVL)
			{					
				case "2":
					if ($article['author_id'] != USR_ID)
					{
						throw_error('USER');
						break;
					}
					
				case "1":
					// Get the categories
					$catquery = "SELECT * FROM newsarticlecategories";
					$catresults = mysql_query($catquery)
							or die(mysql_error());
					$cats = array();
					while($catrow = mysql_fetch_array($catresults))
					{
						$cats[$catrow['category_id']] = $catrow['name'];
					}
					$smarty->assign('cats',$cats);
					$article['text'] = br2nl($article['text']);
					$smarty->assign('article',$article);
					// We re-use addnews as it's the same layout
					$smarty->display('addnews.tpl');
			}
		break;
				
		default:
			if(SEC_LVL == 1)
				$id = 0;
			else
				$id = USR_ID;
			if($_GET['arc'] == 1)
				$arc = 1;
			else
				$arc = 0;	
			SmartyPaginate::setLimit(20);
			$data = array();
			$data = getFNews(0,$id, $arc);
			// For archiving IDs
			$id = '';
			for($i=0; $i<sizeof($data);$i++)
			{
				$id .= $data[$i]['id'].',';
			}
			$smarty->assign('ids',$id);
			$smarty->assign('data',$data);
			$smarty->assign('pageTitle','Fantasy League News');
			$smarty->assign('page','fnews');
			$smarty->assign('formLink','./commit/commitfnews.php?Action=arc');
			if($_GET['arc'] == 1)
				SmartyPaginate::setUrl('adminpages.php?Page=fnews&arc=1');
			else
				SmartyPaginate::setUrl('adminpages.php?Page=fnews');
			SmartyPaginate::assign($smarty); // For pagination
			$smarty->display('listnews.tpl');
			SmartyPaginate::disconnect();
		break;
	}
}
else
{
	throw_error('AUTH');
}
?>