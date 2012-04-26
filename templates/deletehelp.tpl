<div id="main">
	<div id="content">
    	<div class="center"><h1>{$pageTitle}</h1></div>
        <div class="center">
			<p>
        	<strong>{$help.name}</strong>
	        </p>
	        <p>
	        	<strong>Description: </strong>{$help.text}
	        </p>
        	<p>
        	Would you like to delete this help page?<br />
            <form action="{$formLink}" method="post">
                <input name="yes" type="submit" value="Yes" />
                <input name="id" type="hidden" value="{$help.id}"/>
            </form>
            <form action="./adminpages.php?Page=help" method="post">
                <input name="no" type="submit" value="No"/>
            </form>
            </p>
        </div>
    </div>