<div id="feature"> 
	<div class="left" style="width:{$data.boxw}px">
    <a href="{$data.path}" class="thickbox" title="{$data.alt}" style="display:block"><img src="{$data.thumb}" alt="{$data.alt}" title="{$data.alt}" width="{$data.imgw}" height="{$data.imgh}" /></a>
    <p style="font-size:86%">
    {$data.tags}
	<br/><em>Click to view full screen</em>
    </p>
    </div>
    <h2>Welcome to {$clubname}</h2> 
        <strong>Upcoming matches:</strong>
        <ul>
        {section name="matches" loop=$matches}
            <li><a href="{$matches[matches].link}">{$matches[matches].name} on {$matches[matches].date|date_format}</a></li>
        {sectionelse}
            <li><em>There are no upcoming matches</em></li>
        {/section}
        </ul>
        <strong>Next Event:</strong>
        <ul>
        {section name="events" loop=$events}
        	<li><a href="{$events[events].link}">{$events[events].name}</a></li>
        {sectionelse}
        	<li><em>There are no upcoming events</em></li>
        {/section}
        </ul>
        <strong>Birthdays:</strong><br/>
        <span class="bday">
        {section name=bday loop=$bdays}
         	{if $smarty.section.bday.last}
            <a href="{$bdays[bday].link}">{$bdays[bday].name}</a>
            {else}
            	<a href="{$bdays[bday].link}">{$bdays[bday].name}</a>,
            {/if}
        {sectionelse}
            <em>There are no birthdays today</em>
        {/section}
        </span>
</div> 