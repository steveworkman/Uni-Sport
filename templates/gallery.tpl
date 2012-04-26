<div id="main">
	<div id="content">
    	<div align="center"><h1>Picture Albums</h1></div>
        <div id="pics">
            <p>
                <form action="#" method="get" style="padding-left:10px;">
                Showing <select id="showing">
                            {html_options options=$showing selected=$type}
                        </select>
                        <input type="hidden" id="selnext" value="{$next}"/>
                        <input type="hidden" id="increment" value="{$increment}"/>
                        <input type="hidden" id="currindex" value="{$next|default:1}"/>
                </form>
            </p>
            <div id="gallery">
        	{include file='albums.tpl'}
            </div>
            <div class="left" id="prev"><a href="gallery.php?type={$type}&next={$previd}">{$paginate.prev_text}</a></div>
			<div class="right" id="next"><a href="gallery.php?type={$type}&next={$nextid}">{$paginate.next_text}</a></div>
        </div>
    </div>