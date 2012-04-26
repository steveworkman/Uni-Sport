<?php /* Smarty version 2.6.18, created on 2007-08-17 13:58:58
         compiled from addmatch.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'addmatch.tpl', 15, false),array('function', 'html_select_date', 'addmatch.tpl', 27, false),array('function', 'html_select_time', 'addmatch.tpl', 31, false),)), $this); ?>
<div id="main">
	<div id="content">
    	<div align="center"><h1><?php echo $this->_tpl_vars['pageTitle']; ?>
</h1></div>
        <div class="error"><?php echo $this->_tpl_vars['error']; ?>
</div>
        <form name="matchesform" action="<?php echo $this->_tpl_vars['formLink']; ?>
" method="post">
            <fieldset>
                <legend>Match Details</legend>
                <ol>
                    <li>
                    	<label for="opposition">Opposition</label>
                        <input name="opposition" type="text" value="<?php echo $this->_tpl_vars['match']->opposition; ?>
"/>
                    </li>
                    <li>
                    	<label for="squad">Squad</label>
                        <?php echo smarty_function_html_options(array('name' => 'squad','options' => $this->_tpl_vars['squads'],'selected' => $this->_tpl_vars['match']->squad_id), $this);?>

                    </li>
                    <li>
                    	<label for="home">Home/Away</label>
                        <?php echo smarty_function_html_options(array('name' => 'home','options' => $this->_tpl_vars['home'],'selected' => $this->_tpl_vars['match']->home_id), $this);?>

                    </li>
                    <li>
                    	<label for="friendly">Friendly?</label>
                        <input name="friendly" type="checkbox" <?php echo $this->_tpl_vars['friendly']; ?>
/>
                    </li>
                    <li>
                    	<label for="date">Date</label>
                        <?php echo smarty_function_html_select_date(array('prefix' => 'date','end_year' => "+2",'time' => $this->_tpl_vars['match']->date), $this);?>

                    </li>
                    <li>
                    	<label for="meet">Meet Time</label>
                        <?php echo smarty_function_html_select_time(array('prefix' => 'meet','display_seconds' => 0,'minute_interval' => 15,'use_24_hours' => false,'time' => $this->_tpl_vars['match']->meettime), $this);?>

                    </li>
                    <li>
                    	<label for="start">Start Time</label>
                        <?php echo smarty_function_html_select_time(array('prefix' => 'start','display_seconds' => 0,'minute_interval' => 15,'use_24_hours' => false,'time' => $this->_tpl_vars['match']->pushback), $this);?>

                    </li>
                    <li>
                    	<label for="details">Match Details</label>
                        <textarea name="details" cols="50" rows="20"><?php echo $this->_tpl_vars['match']->desc; ?>
</textarea>
                    </li>
                </ol>
                <p>
                	<input name="submit" type="submit" value="<?php echo $this->_tpl_vars['pageTitle']; ?>
"/>
                    <input name="id" type="hidden" value="<?php echo $this->_tpl_vars['match']->match_id; ?>
"></input>
                </p>
            </fieldset>
        </form>
    </div>