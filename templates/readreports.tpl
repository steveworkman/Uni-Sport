<div id="main">
	<div id="content">
    	<div align="center">
        	<h1>Match Reports</h1>
            <p>
            	<strong>Select a match report</strong>
                <form id="reportForm" name="reports" action="readreports.php" method="post">
                    <select name="reports" id="reportSelect">
                        {html_options values=$matchValues output=$matchOptions selected=$matchesSelect}
                    </select>
                </form>
            </p>
         </div>
         <div id="report">
            {if $report != ''}
            	{include file="report.tpl"}
            {/if}
        </div>
    </div>