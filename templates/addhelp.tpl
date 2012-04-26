<div id="main">
	<div id="content">
    	<div class="center"><h1>{$pageTitle}</h1></div>
        <form id="userform" action="{$formLink}" method="post">
        	<fieldset>
            	<legend>Help Page</legend>
                <div class="error">{$error}</div>
                <ol>
                	<li><label for="head"><em>Title</em></label>
                	<input name="name" type="text" value="{$help.name}"></input>
                    </li>
                	<li><label for="text"><em>Description</em></label>
                	<textarea name="text" cols="50" rows="20">{$help.text}</textarea>
                    </li>
					<li><label for="youtube"><em>Youtube Link</em></label>
                	<input name="youtube" type="text" value="{$help.youtube_link}" />
                    </li>
                    <li>
                	<input name="Submit" type="submit" value="Submit" />
                    </li>
                </ol>
          	</fieldset>	
            <input type="hidden" name="id" value="{$help.id}"/>
        </form>
    </div>