<div id="sidebar1">
	{include file="login.tpl" login=$login}
    {*Loop through sidebar contents from the objects*}
    {section name=sbcontent loop=$content}
        {include file='sidebarContent.tpl' obj=$content[sbcontent]}
    {/section}
     <div class="sidebarContent">
     {if $profile->hidden == 0}
        <h3 class="headerShown" id="miniprofile">Random Profile</h3>
        <div class="content">
     {else}
     	<h3 class="headerHidden" id="miniprofile">Random Profile</h3>
        <div class="content" style="display:none">
     {/if}
            {include file='miniprofile.tpl' profile=$profile}
            <a href="{$viewmemberslink}">View all our members</a>
        </div>
     </div>
</div>