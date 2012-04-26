<div id="main">
	<div id="content">
    	<div align="center"><h1>Manage Members</h1></div>
        <form action="./commit/commitmanagemembers.php" method="post">
        <table>
        	<tr><th>Delete?</th><th>Nickname</th> <th>Real Name</th> <th>Contact</th> <th>DOR</th><th>Archive?</th></tr>
            {foreach from=$members item=member}
            <tr class="{cycle values="bg1,bg2"}">
            	<td><input name="del_{$member->uid}" type="checkbox" /></td>
            	<td><a href="userdetails.php?action=view&uid={$member->id}">{$member->username}</a></td>
                <td>{$member->fname|capitalize} {$member->lname|capitalize}</td>
                <td>
                	<a href="mailto:{$member->email}"><img src="./img/email.gif" alt="{$member->email}" title="{$member->email}"/></a>
                    <img src="./img/phone.gif" alt="{$member->phone}" title="{$member->phone}"/>
                </td>
                <td>{$member->regdate|date_format}</td>
                <td><input name="arc_{$member->uid}" type="checkbox" {if $member->archived == '1'}checked="checked"{/if}/></td>
            </tr>
            {/foreach}
            <tr>
				<td><input name="submit" type="submit" value="Delete" /></td>
				<td colspan="4">&nbsp;</td>
				<td><input name="submit" type="submit" value="Archive" /></td>
			</tr>
			<tr>
                <td colspan="6">
                {* display pagination info *}
                {paginate_middle}
                </td>
            </tr>
        </table>
        <input type="hidden" value="{$ids}" name="ids"/>
        <input type="hidden" value="{$next}" name="next"/>
        </form>
    </div>