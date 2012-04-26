<div id="adverts">
	<h3 class="header">Our Sponsors</h3>
    <ul>
    	{section name=ads loop=$adverts}
        	<li><a href="{$adverts[ads].link}"><img src="{$adverts[ads].img}" alt="{$adverts[ads].alt|default:"advert" 	}" width="90%" /></a></li>
        {/section}
    </ul>
    <div class="center">
        {include file='googlesidebar.htm'}
    </div>
</div>