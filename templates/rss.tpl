<div id="main">
	<div id="content">
    	<div align="center"><h1>RSS Feeds</h1></div>
        <h2>What is RSS?</h2>
        <p>
            RSS stands for Really Simple Syndication and is a quick and easy way of keeping up with events happening on your favorite websites. 
            RSS feeds can be read by RSS Readers (external pieces of software) or by modern internet browsers (like Mozilla FireFox) and supply 
            a list of links that are dynamically updated by the website as new content is added.
        </p>
        <h2>How do I get these feeds?</h2>
        <p>
            Point your RSS Reader to one of the links below and it will start picking up the feed. For FireFox, Opera, IE7 and Safari users, click the orange button in the address bar and select the correct feed.
        </p>
        <h2>What feeds do you supply?</h2>
        <p>
        	{foreach name=rss from=$feeds item=feed}
            {if $smarty.foreach.rss.first}{$clubname} currently supplies the following feeds:
            <ul style="list-style:none; padding-left:10px">
            {/if}
            	<li><a href="{$feed.link}" title="{$feed.title}">{$feed.title}</a></li>
            {if $smarty.foreach.rss.last}
            </ul>
            {/if}
            {foreachelse}
            There are no feeds available for this site
            {/foreach}
        </p>
    </div>