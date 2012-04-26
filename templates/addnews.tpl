<div id="main">
	<div id="content">
    	<div class="center"><h1>{$pageTitle}</h1></div>
        <form id="userform" action="{$formLink}" method="post">
        	<fieldset>
            	<legend>News Story</legend>
                <div class="error">{$error}</div>
                <ol>
                	<li><label for="head"><em>Headline</em></label>
                	<input name="head" type="text" value="{$article.headline}"></input>
                    </li>
                	<li><label for="category"><em>Category</em></label>
                	{html_options name="category" options=$cats selected=$article.cat_id}
                	</li>
                	<li><label for="text"><em>Story</em></label>
                	<textarea name="text" cols="50" rows="20">{$article.text}</textarea>
                    </li>
                    <li>
                	<input name="Submit" type="submit" value="Submit" />
                    </li>
                </ol>
          	</fieldset>	
            <input type="hidden" name="id" value="{$article.id}"/>
            <input type="hidden" name="author_id" value="{$article.author_id}"/>
            <input type="hidden" name="date" value="{$article.date}" />
        </form>
    </div>