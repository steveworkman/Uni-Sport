<div id="main">
	<div id="content">
    	<div class="center"><h1>Upload Avatar</h1></div>
        <div class="error">{$error}</div>
        <form method="post" action="./commit/commitavatar.php" enctype="multipart/form-data" />
        	<fieldset>
            	<legend>Avatar</legend>
                <ol>
                	<li><img src="{$avatar}" alt="{$name}" /><br/><input name="image" type="file" /></li>
                    <li><input name="submit" type="submit" value="Upload Picture" /></li>
                </ol>
                <input name="uid" type="hidden" value="{$id}" />
            </fieldset>
		</form>
    </div>