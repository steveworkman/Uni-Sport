<div id="main">
	<div id="content">
    	<div class="center"><h1>Add Advert</h1></div>
        <form action="./commit/commitads.php?action=add" method="post" enctype="multipart/form-data">
        	<fieldset>
            	<legend>Advert Details</legend>
                <ol>
                	<li><label for="title">Title</label><input name="title" type="text"/></li>
                    <li><label for="link">Hyperlink</label><input name="link" type="text"/></li>
                    <li><label for="seq">Sequence Number</label><input name="seq" type="text"/></li>
                    <li><label for="pic">Image</label><input name="pic" type="file"/></li>
                </ol>
                <p align="center">
                	<input name="submit" type="submit" value="Submit" />
                </p>
        	</fieldset>
        </form>
    </div>