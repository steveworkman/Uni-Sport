<div id="main">
	<div id="content">
    	<div class="center"><h1>{$pageTitle}</h1></div>
        {if isset($error)}
        <div class="error">{$error}</div>
        {/if}
        <form name="squadForm" action="{$formLink}" method="post">
            <fieldset>
                <legend>Squad Details</legend>
                <ol>
                    <li>
                        <label for="name">Squad Name:</label>
                        <input name="name" type="text" value="{$squadData.squad_name}" />
                    </li>
                    <li>
                        <label for="desc">Description</label>
                        <textarea name="desc" cols="25" rows="10">{$squadData.squad_desc}</textarea>
                    </li>
                </ol>
            </fieldset>
            <fieldset>
                <legend>Squad</legend>
                <a href="#" id="addplayer">Click to add another player</a>
                <ol id="squadlist">
                	{section name=squad loop=$playernum start=1}
                    <li>
                    	<label for="sel{$smarty.section.squad.index}">Player {$smarty.section.squad.index}</label>
                        <input type="text" id="sel{$smarty.section.squad.index}" name="sel{$smarty.section.squad.index}" value="{$squad[squad].name}" />
                        <input type="hidden" id="{$smarty.section.squad.index}" name="{$smarty.section.squad.index}" value="{$squad[squad].id}" />
                    </li>
                    {/section}
                    {section name=hidden loop=$remain start=$remstart}
                    <li id="list{$smarty.section.hidden.index}" class="nodisplay">
                    	<label for="sel{$smarty.section.hidden.index}">Player {$smarty.section.hidden.index}</label>
                        <input type="text" id="sel{$smarty.section.hidden.index}" name="sel{$smarty.section.hidden.index}"/>
                        <input type="hidden" id="{$smarty.section.hidden.index}" name="{$smarty.section.hidden.index}"/>
                    </li>
                    {/section}
                </ol>
                <ol>
                	<li><input type="submit" value="{$buttonText}" id="submit"/></li>
                </ol>
            </fieldset>
            <input name="captain" type="hidden" value="{$USR_ID}"/>
            <input name="playernum" type="hidden" id="playernum" value="{$playernum}"/>
            <input name="id" type="hidden" value="{$squadData.squad_id}"/>
        </form>
        
    </div>