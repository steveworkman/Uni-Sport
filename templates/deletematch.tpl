<div id="main">
	<div id="content">
    	<div align="center"><h1>Delete Match</h1></div>
        <p>
        	<strong>Match: </strong>{$match->squadName} v {$match->opposition} on {$match->date|date_format} {$match->home} {if $match->friendly == 'Yes'}(Friendly){/if}
        </p>
        <p>
        	<strong>Match Details</strong><br/>
            {$match->desc}
        </p>
        <div align="center">
        	<strong>Delete this match?</strong>
            <form action="./commit/commitmatch.php?Action=delete" method="post">
				<input name="id" type="hidden" value="{$match->match_id}"/>
				<input name="yes" type="submit" value="Yes"/>
            </form>
			<form action="adminpages.php?Page=matches" method="post">
				<input name="no" type="submit" value="No"/>
            </form>
        </div>
    </div>