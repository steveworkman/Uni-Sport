<div class="story">
    {if $in_story != '1'}
	<h2><a href="{$story.link}">{$story.headline}</a></h2>
	{/if}
    <em>By <a href="{$story.userLink}">{$story.author}</a> on {$story.date|date_format} in {$story.cat}</em>
    <p>{$story.text}</p>
</div>