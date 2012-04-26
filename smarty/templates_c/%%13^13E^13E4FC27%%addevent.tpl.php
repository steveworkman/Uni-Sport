<?php /* Smarty version 2.6.18, created on 2007-08-18 03:08:44
         compiled from addevent.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_select_date', 'addevent.tpl', 13, false),array('function', 'html_select_time', 'addevent.tpl', 16, false),)), $this); ?>
<div id="main">
	<div id="content">
    	<div align="center"><h1><?php echo $this->_tpl_vars['pageTitle']; ?>
</h1></div>
        <form id="userform" action="<?php echo $this->_tpl_vars['formLink']; ?>
" method="post">
        	<fieldset>
            	<legend>Event Details</legend>
                <div class="error"><?php echo $this->_tpl_vars['error']; ?>
</div>
                <ol>
                	<li><label for="head"><em>Title</em></label>
                	<input name="head" type="text" value="<?php echo $this->_tpl_vars['event']['name']; ?>
"></input>
                    </li>
                	<li><label for="date"><em>Date</em></label>
                	<?php echo smarty_function_html_select_date(array('end_year' => "+2",'time' => $this->_tpl_vars['event']['date']), $this);?>

                	</li>
                    <li><label for="time"><em>Time</em></label>
                	<?php echo smarty_function_html_select_time(array('display_seconds' => 0,'minute_interval' => 15,'use_24_hours' => false,'time' => $this->_tpl_vars['event']['date']), $this);?>

                	</li>
                	<li><label for="text"><em>Description</em></label>
                	<textarea name="text" cols="50" rows="20"><?php echo $this->_tpl_vars['event']['desc']; ?>
</textarea>
                    </li>
                    <li>
                	<input name="Submit" type="submit" value="Submit" />
                    </li>
                </ol>
          	</fieldset>	
            <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['event']['id']; ?>
" />
        </form>
    </div>