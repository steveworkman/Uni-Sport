<div id="main">
	<div id="content">
    	<div align="center"><h1>{$album.album_name}</h1></div>
    	{if isset($error)}
        <p>
        	{$error}
        </p>
        {else}
        <div align="right" style="padding-right:5px"><a href="./gallery.php">Back to Gallery</a></div>
        <p>
            <div id="currpic">
            	<a href="{$currpath}" title="{$curralt}" class="thickbox"><img src="{$currpath}" alt="{$curralt}" width="{$imgwidth}" {if !empty($imgheight)}height="{$imgheight}"{/if} title="{$curralt}"/></a>
            </div>
            <p id="comment" style="font-size:86%;">
            	{$curralt}
            </p>
            <p id="tags" style="font-size:86%">
            	{$currtags}
            </p>
            <p style="font-size:86%">
            	Tag people in this photo: <form onsubmit="return false;"><input type="text" id="taginput"/></form>
            </p>
            <ul id="mycarousel" class="jcarousel-skin-ie7"></ul>
            <div class="center">
            <table width="100%">
                <tr>
                    <td>Title: {$album.album_name}</td>
                    <td>Created by: {if $album.user_id == -1}{$album.username}{else}<a href="./viewprofile.php?action=view&uid={$album.user_id}">{$album.username}</a>{/if}</td>
                </tr>
                <tr>
                    <td>Type: {$album.type_name}</td>
                    <td>Date: {$album.date|date_format}</td>
                </tr>
            </table>
            </div>
        </p>
        <form>
        	{if isset($user_id)}<input type="hidden" id="user_id" value="{$user_id}"/>
            {else}<input type="hidden" id="album_id" value="{$album.album_id}"/>{/if}
            <input type="hidden" id="pic_id" value="{$currpicid}"/>
        </form>
        {/if}
    </div>