<div id="main">
	<div id="content">
    	{include file="feature.tpl" data=$data matches=$matches bdays=$birthdays}
        {section name="news" loop=$stories}
        	{include file="newsStory.tpl" story=$stories[news]}
        {/section}
        <a href="news.php" style="float:right; margin:0 5px 0 0; display:block;">Looking for the news?</a>
        <div class="clear"></div>
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