<div id="main">
	<div id="content">
    	{include file="feature.tpl" data=$data matches=$matches bdays=$birthdays}
        {section name="news" loop=$stories}
        	{include file="newsStory.tpl" story=$stories[news]}
        {/section}
        <p>
        	{if $paginate.size gt 1}
              {paginate_prev} Displaying stories {$paginate.first}-{$paginate.last} of {$paginate.total}  {paginate_next}
            {else}
              Displaying stories {$paginate.first} of {$paginate.total}.    
            {/if}
        </p>
    </div>