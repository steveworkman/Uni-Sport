<div id="main">
	<div id="content">
    	<div align="center"><h1>{$pageTitle}</h1>
        <p>
        	<strong>Title: </strong>{$data.title}
        </p>
		<p>
        	<strong>Uploaded by: </strong><a href="./viewprofile.php?action=view&amp;uid={$data.author_id}">{$data.author}</a> on {$data.date|date_format}
        </p>
        <p>
        	<a href="{$data.path}">View Newsletter</a>
        </p>
        <p>
            Would you like to delete this newsletter?<br />
            <form action="./commit/commitnewsletter.php?Action=delete" method="post">
                <input name="yes" type="submit" value="Yes" />
                <input name="id" type="hidden" value="{$data.id}"/>
            </form>
            <form action="./adminpages.php?Page=newslettermenu" method="post">
                <input name="no" type="submit" value="No"/>
            </form>
        </p>
        </div>
    </div>