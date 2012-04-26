{if isset($error)}
<div class="error">{$error}</div>
{else}
<table class="gallery">
	<tr>
    	{section loop=3 name=toprow}
        <td>{if isset($albums[toprow].id)}<a href="gallery.php?Page=gallery&album_id={$albums[toprow].id}"><img src="{$albums[toprow].cover}" alt="{$albums[toprow].album_name}" id="{$albums[toprow].id}" width="150px" /></a><br/><a href="gallery.php?Page=gallery&album_id={$albums[toprow].id}">{$albums[toprow].album_name} ({$albums[toprow].pic_count})</a>{else}&nbsp;{/if}</td>
        {/section}
    </tr>
    <tr>
    	{section loop=6 name=bottomrow start=3}
        <td>{if isset($albums[bottomrow].id)}<a href="gallery.php?Page=gallery&album_id={$albums[bottomrow].id}"><img src="{$albums[bottomrow].cover}" alt="{$albums[bottomrow].album_name}" id="{$albums[bottomrow].id}" width="150px" /></a><br/><a href="gallery.php?Page=gallery&album_id={$albums[bottomrow].id}">{$albums[bottomrow].album_name} ({$albums[bottomrow].pic_count})</a>{else}&nbsp;{/if}</td>
        {/section}
    </tr>
</table>
{/if}