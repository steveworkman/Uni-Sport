{if $profile->error == ''}
<div class="right">
	{if isset($profile->fb_id)}
    <a href="{$profile->link}"><img src="{$profile->avatar}" alt="{$profile->username}"/></a>
    {else}
    <a href="{$profile->link}"><img src="{$profile->avatar}" alt="{$profile->username}" width="{$profile->imgwidth}" height="{$profile->imgheight}"/></a>
    {/if}
</div>
<p>
    <strong>Nickname:</strong> {$profile->username}<br />
    <strong>Favoured Position:</strong> {$profile->side} {$profile->position}<br />
    <strong>Fantasy League Points:</strong> {$profile->points}<br />
    <strong>Goals:</strong> {$profile->goals}<br />
    <strong>Quote:</strong> {$profile->quote|truncate:70:"..."}<br />
    <a href="{$profile->link}">View full profile</a>
</p>
{else}
<p>
	{$profile->error}
</p>
{/if}