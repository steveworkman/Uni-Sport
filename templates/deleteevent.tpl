<div id="main">
	<div id="content">
    	<div align="center"><h1>{$pageTitle}</h1></div>
        <p>
        	<strong>Title: </strong>{$event.name}
        </p>
		<p>
        	<strong>Created By: </strong><a href="./viewprofile.php?action=view&amp;uid={$event.author_id}">{$event.author}</a>
        </p>
        <p>
        	<strong>Date: </strong>{$event.date|date_format}
        </p>
        <p>
        	<strong>Time: </strong>{$event.date|date_format:'%I:%M %p'}
        </p>
        <p>
        	<strong>Description</strong><br/>
            {$event.desc}
        </p>
        <div align="center">
        	<p>
        	Would you like to delete this event<br />
            <form action="./commit/commitevent.php?Action=delete" method="post">
                <input name="yes" type="submit" value="Yes" />
                <input name="id" type="hidden" value="{$event.id}"/>
            </form>
            <form action="./adminpages.php?Page=events" method="post">
                <input name="no" type="submit" value="No"/>
            </form>
            </p>
        </div>
    </div>