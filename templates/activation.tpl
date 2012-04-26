<div id="main">
	<div id="content">
    	<div class="center"><h1>Activation</h1></div>
        <form action="./commit/commitactivation.php" method="post">
            <p>
                The following people are awaiting activation
            </p>
            <table>
                <th colspan="5">Accounts Awaiting Activation</th>
                <tr>
                    <th>NickName</th><th>Real Name</th><th>Email</th><th>Approve Account</th><th>Deny Account</th>
                </tr>
                {foreach from=$inactive item=member}
                <tr class="{cycle values="bg1,bg2"}">
                    <td>{$member.name}</td>
                    <td>{$member.fname|capitalize} {$member.lname|capitalize}</td>
                    <td><a href="mailto:{$member.email}"><img src="./img/email.gif" alt="{$member.email}" title="{$member.email}"/></a></td>
                    <td><input type="checkbox" name="a{$member.id}"/></td>
                    <td><input type="checkbox" name="d{$member.id}"/></td>
                </tr>
                {foreachelse}
                <tr>
                    <td colspan="5">There are no accounts awaiting activation</td>
                </tr>
                {/foreach}
                <tr>
                </tr>
            </table>
            <input type="hidden" value="{$pid}" name="Activates"/>
            <p>
                <input type="submit" value="Submit" />
            </p>
        </form>
    </div>