<div id="main">
	<div id="content">
    	<div align="center"><h1>Upload Pictures</h1></div>
        {if isset($error)}
        <div class="error">{$error}</div>
        {/if}
        <form name="upform" action="./commit/commitpicture.php?Action=upload" method="post" enctype="multipart/form-data">
            <fieldset>
                <legend>Upload</legend>
                <ol>
                    <li>
                        <label for="filename">Select Files</label>
                        <input name="filename" type="file" class="multi limit-5 accept-jpg|gif|png"/>
                    </li>
                    <li><span class="red">This input will take up to 5 pictures at once. Remember, the more pictures you upload the longer it will take!</span></li>
                    <li>
                        <input type="submit" name="submit" value="Upload Pictures"/>
                        <input type="reset" name="submit2" value="Reset form"/>
                    </li>
                </ol>
            </fieldset>
        	<input type="hidden" name="id" value="{$id}"/>
        </form>
    </div>