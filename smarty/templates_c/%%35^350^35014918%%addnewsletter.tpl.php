<?php /* Smarty version 2.6.18, created on 2007-08-24 13:27:27
         compiled from addnewsletter.tpl */ ?>
<div id="main">
	<div id="content">
    	<div align="center">
        	<h1><?php echo $this->_tpl_vars['pageTitle']; ?>
</h1>
            <form action="<?php echo $this->_tpl_vars['formLink']; ?>
" method="post" enctype="multipart/form-data">
            <fieldset>
                <legend>Upload</legend>
                <div class="error"><?php echo $this->_tpl_vars['error']; ?>
</div>
                <ol>
                    <li><label for="title"><em>Newsletter Title</em></label>
                    <input name="title" type="text" size="55" /></li>
                    <li><label for="filename"><em>File Location</em></label>
                    <input name="filename" type="file" /></li>
                    <em>Newsletter can be uploaded in .txt, .doc, .pdf, .xls or .rtf formats only</em><br />
                    <p><input type="submit" name="submit" value="Submit"></input>
                        <input type="reset" name="submit2" value="Reset form"></input></p>
                </ol>
            </fieldset>
            </form>
        </div>
    </div>