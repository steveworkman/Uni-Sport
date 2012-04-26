<div id="main">
	<div id="content">
    	<div align="center"><h1>Confirm Transfer</h1></div>
        <p>
        You wish to transfer <strong>{$pname}</strong> for <strong>{$sname}</strong>. After this transfer your budget will be <span style="color:red">&pound;{$final_budget}m</span>.
        </p>
        <p>
        <form name="transfer" action="./fhockey/committransfer.php" method="post">
        <div align="center"><input type="submit" value="Confirm Transfer" />
        <input type="hidden" name="tid" value="{$tid}" />
        <input type="hidden" name="pid" value="{$pid}" />
        <input type="hidden" name="id" value="{$id}" />
        <input type="hidden" name="fb" value="{$final_budget}" />
        </form>
        <form name="notransfer" action="./fhockey.php?Page=transfers" method="get">
        <input type="submit" value="Cancel Transfer" /></form>
        </div>
        </p>
    </div>