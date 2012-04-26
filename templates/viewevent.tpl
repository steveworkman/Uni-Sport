<div id="main">
	<div id="content">
		{if $event.name != ''}
		<div class="center"><h1>{$event.name}</h1></div>
		<br/>
        <em>This event is happening on {$event.date|date_format}</em>
		<p>
			{$event.desc}
		</p>
        <p>
        	<em>Created By <a href="{$event.author_link}">{$event.author}</a></em>
        </p>
		{else}
			<div align="center"><h1>No Event Found</h1></div>
			<p>
				Oops, we've not found an event for that ID! Tell the administrator what happened.
			</p>
		{/if}
	</div>