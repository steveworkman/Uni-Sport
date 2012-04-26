<div id="main">
	<div id="content">
		{if $story.headline != ''}
		<div class="center"><h1>{$story.headline}</h1></div>
		{include file="newsStory.tpl" story=$story}
		{else}
		<div class="center"><h1>No Story selected</h1></div>
		<p>
			Oops, there's no story for that ID! Tell the administrator
		</p>
		{/if}
	</div>