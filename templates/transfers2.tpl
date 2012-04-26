<script language="javascript" type="text/javascript" src="./ajax/ajax.js"></script>
<script language="javascript" type="text/javascript" src="./ajax/transfers.js"></script>
<div id="main">
	<div id="content">
    	<div align="center"><h1>Transfers</h1></div>
        
        <p>
        Please select a player to replace <strong>{$pname}</strong>
        </p>
        <p>
			You currently have <span style="color:red">&pound;{$remaining_cash}m</span> to spend.
        {if $error != ''}
        	<br/>
        	<div class="error">{$error}</div>
        </p>
        {else}
        	Therefore you can buy the following players:
        </p>
        <div id="lists" style="width:40%; float:left;">
            <p>
            <form name="fhockey" action="#" method="post" onsubmit="return false;">
            <select name="GKM" size=10 onFocus="getProfile(document.fhockey.GKM[document.fhockey.GKM.selectedIndex].value, {$tid}, {$pid}, {$pos})" onchange="getProfile(document.fhockey.GKM[document.fhockey.GKM.selectedIndex].value, {$tid}, {$pid}, {$pos})">
            {foreach from=$players item=player}
            	<option value="{$player.id}">{$player.name} (&pound;{$player.value}m)</option>
            {/foreach}
            </select>
            </form>
            </p>
            <p>
                <strong><a href="./fhockey.php">Cancel this transfer</a></strong>
            </p>
        </div>
        <div id="profile" style="width:55%; float:right; margin-left: 2px; vertical-align:top;">
        </div>
        {/if}
    </div>