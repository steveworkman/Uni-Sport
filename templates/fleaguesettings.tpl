<div id="main">
	<div id="content">
    	<div align="center"><h1>Fantasy League Settings</h1></div>
        <form action="./commit/commitfhockey.php" method="post">
        <fieldset>
        	<legend>Controls</legend>
            <ol>
            	<li>
                	<input type="submit" name="pos" value="{$pos}" />
        			<input type="hidden" name="position" value="{$lockpos}" />
                </li>
                <li>
                	<input type="submit" name="sign" value="{$sign}" />
        			<input type="hidden" name="signup" value="{$locksign}" />
                </li>
            </ol>
        </fieldset>
        </form>
    </div>