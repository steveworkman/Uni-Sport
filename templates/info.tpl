<div id="main">
	<div id="content">
		<div class="center"><h1>{$title|default:"Information"}</h1></div>
        {if $text != ''}
        	{$text}
        {else}
        	<ul style="list-style:none;" class="center">
            	{foreach from=$links item=link}
                <li><a href="{$link.link}">{$link.text}</a></li>
            	{/foreach}
            </ul>
        {/if}
    </div>