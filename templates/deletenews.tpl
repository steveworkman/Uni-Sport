<div id="main">
	<div id="content">
    	<div class="center"><h1>{$pageTitle}</h1></div>
        {include file="newsStory.tpl" story=$article}
        <div align="center">
        	<p>
        	Would you like to delete this news article?<br />
            <form action="./commit/commit{$page}.php?Action=delete" method="post">
                <input name="yes" type="submit" value="Yes" />
                <input name="id" type="hidden" value="{$article.id}"/>
            </form>
            <form action="./adminpages.php?Page={$page}" method="post">
                <input name="no" type="submit" value="No"/>
            </form>
            </p>
        </div>
    </div>