<div id="main">
	<div id="content">
		<div class="center"><h1>Help!</h1></div>
        <p>
			Want to know more about the site? Do you need to know how to add a match report, add some news or post in the forums?<br/>
			This page will show you how to do all this and more. Have a look at the tutorial videos, and if you have any questions, ask the webmaster.
		</p>
		{foreach from=$help item=hel}
		<h3>{$hel.name}</h3>
		<p>
			{$hel.text}
		</p>
		<p class="center">
			<a href="youtube.php?link={$hel.youtube_link}&amp;height=365&amp;width=425" class="thickbox" title="{$hel.name} video"><img src="http://img.youtube.com/vi/{$hel.youtube_link}/3.jpg" alt="{$hel.name}" title="{$hel.name} video" /></a>
		</p>
		{/foreach}
    </div>