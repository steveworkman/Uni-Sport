<?php /* Smarty version 2.6.18, created on 2007-08-18 04:04:23
         compiled from addinfopage.tpl */ ?>
<div id="main">
	<div id="content">
    	<div align="center"><h1>Add Information Page</h1></div>
        <p>
			<form action="./commit/commitinfo.php?action=add" method="post">
			<fieldset>
            	<legend>Page Details</legend>
                <ol>
                	<li><label for="title">Title</label><input name="title" type="text"/></li>
                    <li><label for="seq">Sequence Number</label><input name="seq" type="text"/></li>
                    <li><label for="text">Text</label><textarea name="text" cols="45" rows="20"></textarea></li>
                </ol>
                <p align="center">
					<input name="submit" type="submit" value="Submit" />
                </p>
			</fieldset>
			</form>
		</p>
    </div>