<div id="main">
	<div id="content">
    	<div class="center"><h1>Check Matches</h1></div>
        {foreach from=$matches item=match}
        <form action="./commit/commitavailable.php" method="post" >
            <table width="100%">
            <tr>
              <td><h2>{$match->squadName} vs {$match->opposition}</h2>
              <strong>On</strong> <em>{$match->date|date_format}</em> <strong>Captain:</strong> <em><a href="{$match->captain.link}">{$match->captain.name}</a></em> 
              <strong>Meet:</strong> <em>{$match->meettime|date_format:'%H:%M'}</em> <strong>PushBack:</strong> <em>{$match->pushback|date_format:'%H:%M'}</em></td>
                <td align="center"><a href="squadstatus.php?id={$match->match_id}&height=300&width=300" class="thickbox"> Squad Status</a><br /></td>
            </tr>
                <tr><td>{$match->desc}</td>
                <td align="center">
                    {html_options name='available' options=$availabilities selected=$match->availability}
                  <input type="submit" name="submit" value="Confirm" /></td>
                </tr>
                
              </table>		 
			<input name="match" type="hidden" value="{$match->match_id}" />
			<input name="squad" type="hidden" value="{$match->squad_id}" />
			<input name="user" type="hidden" value="{$USR_ID}" />
        </form>
        <hr size="4" noshade />
        {foreachelse}
            {$error}
        {/foreach}
    </div>