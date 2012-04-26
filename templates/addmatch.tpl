<div id="main">
	<div id="content">
    	<div class="center"><h1>{$pageTitle}</h1></div>
        <div class="error">{$error}</div>
        <form name="matchesform" action="{$formLink}" method="post">
            <fieldset>
                <legend>Match Details</legend>
                <ol>
                    <li>
                    	<label for="opposition">Opposition</label>
                        <input name="opposition" type="text" value="{$match->opposition}"/>
                    </li>
                    <li>
                    	<label for="squad">Squad</label>
                        {html_options name="squad" options=$squads selected=$match->squad_id}
                    </li>
                    <li>
                    	<label for="home">Home/Away</label>
                        {html_options name="home" options=$home selected=$match->home_id}
                    </li>
                    <li>
                    	<label for="friendly">Friendly?</label>
                        <input name="friendly" type="checkbox" {$friendly}/>
                    </li>
                    <li>
                    	<label for="date">Date</label>
                        {html_select_date prefix="date" end_year="+2" time=$match->date}
                    </li>
                    <li>
                    	<label for="meet">Meet Time</label>
                        {html_select_time prefix="meet" display_seconds=0 minute_interval=15 use_24_hours=false time=$match->meettime}
                    </li>
                    <li>
                    	<label for="start">Start Time</label>
                        {html_select_time prefix="start" display_seconds=0 minute_interval=15 use_24_hours=false time=$match->pushback}
                    </li>
                    <li>
                    	<label for="details">Match Details</label>
                        <textarea name="details" cols="50" rows="20">{$match->desc}</textarea>
                    </li>
                </ol>
                <p>
                	<input name="submit" type="submit" value="{$pageTitle}"/>
                    <input name="id" type="hidden" value="{$match->match_id}"></input>
                </p>
            </fieldset>
        </form>
    </div>