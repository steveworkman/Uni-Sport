<div id="main">
	<div id="content">
    	<div class="center">
        	<h1>{$pageTitle}</h1>
            <form action="{$formLink}" method="post" enctype="multipart/form-data">
            <fieldset>
                <legend>Upload</legend>
                <div class="error">{$error}</div>
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