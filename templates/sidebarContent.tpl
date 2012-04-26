<div class="sidebarContent">
{if $obj->nohide == 0}
	{if $obj->hidden == 0}
	<h3 class="headerShown" id="{$obj->id}">{$obj->title}</h3>
	<div class="content">
	{else}
	<h3 class="headerHidden" id="{$obj->id}">{$obj->title}</h3>
	<div class="content" style="display:none">
	{/if}
{else}
	<h3 class="header">{$obj->title}</h3>
    <div class="content">
{/if}
        <ul>
            {if $obj->error == ''}
                {foreach from=$obj->data item=data}
                    <li><a {if $data.id != ''}id="{$data.id}"{/if} href="{$data.link}" {if $data.class != ''}class="{$data.class}"{/if}>{if $data.new == 1}<span class="highlight">{/if}{$data.text}{if $data.new == 1}</span><img src="{$NEW_IMG}" alt="New" />{/if}</a></li>
                {/foreach}
            {else}
                <li>{$obj->error}</li>
            {/if}
        </ul>
    </div>
</div>