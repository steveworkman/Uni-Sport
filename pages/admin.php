<?php
if (SEC_LVL == 1)
	$smarty->display('admin.tpl');
else
	throw_error('AUTH');
?>