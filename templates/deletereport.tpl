<div id="main">
	<div id="content">
    	<div align="center"><h1>Delete Match Report</h1></div>
        <p>
        	<strong>Match: </strong>{$match->squadName} v {$match->opposition} on {$match->date|date_format} {$match->home} {if $match->friendly == 'Yes'}(Friendly){/if}
        </p>
        <p>
        	<strong>Score: </strong>{$match->score}
        </p>
		<p>
        	<strong>Written By: </strong><a href="{$match->author.link}">{$match->author.name}</a>
        </p>
        <p>
        	<strong>Man of the Match: </strong><a href="{$match->motm.link}">{$match->motm.name}</a>
        </p>
        <p>
        	<strong>Dick of the Day: </strong><a href="{$match->dotd.link}">{$match->dotd.name}</a>
        </p>
        <p>
        	<strong>Match Report</strong><br/>
            {$match->report}
        </p>
        <div align="center">
        	<strong>Delete this match report?</strong>
            <form action="./commit/commitmatchreport.php?Action=delete" method="post">
            <input name="yes" type="submit" value="Yes">
            <input name="reportid" type="hidden" value="{$match->id}"></input>
            <input name="matchid" type="hidden" value="{$match->match_id}"></input></form>
            <form action="memberpages.php?Page=matchreports" method="post">
            <input name="no" type="submit" value="No"></form>
        </div>
    </div>