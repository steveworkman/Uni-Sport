<div id="main">
	<div id="content">
    	<div align="center"><h1>Delete Album</h1></div>
            <p>
                <strong>Album Name: </strong>{$album.album_name}
            </p>
            <p>
                <strong>Created By: </strong>{$album.username|default:'Auto-generated'}
            </p>
            <p>
                <strong>Date: </strong>{$album.date|date_format}
            </p>
            <p>
                Here should be a slideshow preview of the album
            </p>
            <p align="center">
            	<em>Are you sure you want to delete this album? Doing so deletes all pictures associated with it</em>
				<form action="./commit/commitalbum.php?action=delete" method="post">
					<input name="yes" type="submit" value="Yes"/>
					<input name="id" type="hidden" value="{$album.album_id}"/>
                </form>
				<form action="memberpages.php?Page=picmenu" method="post">
					<input name="no" type="submit" value="No"/>
                </form>
            </p>
    </div>