<div id="main">
	<div id="content">
    	<div class="center"><h1>{$pageTitle}</h1></div>
        <form id="userform" action="{$formLink}" method="post">
        	<fieldset>
            	<legend>Event Details</legend>
                <div class="error">{$error}</div>
                <ol>
                	<li><label for="head"><em>Title</em></label>
                	<input name="head" type="text" value="{$event.name}"></input>
                    </li>
                	<li><label for="date"><em>Date</em></label>
                	{html_select_date end_year="+2" time=$event.date}
                	</li>
                    <li><label for="time"><em>Time</em></label>
                	{html_select_time display_seconds=0 minute_interval=15 use_24_hours=false time=$event.date}
                	</li>
                	<li><label for="text"><em>Description</em></label>
                	<textarea name="text" cols="50" rows="20">{$event.desc}</textarea>
                    </li>
                    <li>
                	<input name="Submit" type="submit" value="Submit" />
                    </li>
                </ol>
          	</fieldset>	
            <input type="hidden" name="id" value="{$event.id}" />
        </form>
    </div>