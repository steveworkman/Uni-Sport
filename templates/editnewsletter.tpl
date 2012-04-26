<div id="main">
	<div id="content">
    	<div align="center">
        	<h1>{$pageTitle}</h1>
            <form action="{$formLink}" method="post">
            <fieldset>
                <legend>Edit</legend>
                <div class="error">{$error}</div>
                <ol>
                    <li><label for="title"><em>Newsletter Title</em></label>
                    <input name="title" type="text" size="55" value="{$data.title}" /></li>
                    <li>Uploaded by <a href="./viewprofile.php?action=view&amp;uid={$data.author_id}">{$data.author}</a>
                    on {$data.date|date_format}</li>
                </ol>
                <input name="id" type="hidden" value="{$data.id}" />
				<a href="{$data.path}">View Newsletter</a><br />
				<input name="submit" type="submit" value="Submit Changes" />
            </fieldset>
            </form>
        </div>
    </div>