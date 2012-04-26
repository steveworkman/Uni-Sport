<?php
// load Smarty library
require('smarty/Smarty.class.php');
require('smarty/SmartyPaginate.class.php');

class smarty_connect extends Smarty 
{
   function smarty_connect()
   {
        // Class Constructor. 
        // These automatically get set with each new instance.
		$this->Smarty();
		
		$this->template_dir = 'templates';
		$this->config_dir ='config';
		$this->compile_dir = 'smarty/templates_c';
		$this->cache_dir ='smarty/cache';
		
		$this->assign('app_name', 'USEv4');
		$this->caching = 0;
		$this->compile_check = true;
   }
}
$smarty = new smarty_connect;
SmartyPaginate::connect();
SmartyPaginate::setLimit(15);
SmartyPaginate::setPrevText('Previous');
SmartyPaginate::setNextText('Next');
?>