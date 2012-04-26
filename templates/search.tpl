<div id="main">
	<div id="content">
    	<div align="center"><h1>Search Results</h1></div>
        {if !isset($nostr)}
        {foreach from=$data item=list}
        <h2>{$list[0]}</h2>
        <p>
        	{foreach name=search from=$list[1] item=item}
            {if $smarty.foreach.search.first}<ul style="list-style:none; margin-left:10px">{/if}
            <li><a href="{$item.link}">{$item.name}</a>
            {if $smarty.foreach.search.last}</ul>{/if}
            {foreachelse}
            There are no results for that search. Please try again
            {/foreach}
        </p>
        {foreachelse}
        <p>
        	No results in this category
        </p>
        {/foreach}
        {else}
        <p class="center">
        	You've not entered a query, please use the box below to do so.
        </p>
        <p>
        	<form action="search.php" method="get" class="center">
            <input type="text" name="search"/>
            <input type="submit" value="Search"/>
            </form>
        </p>
        {/if}
    </div>