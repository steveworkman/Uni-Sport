<div id="main">
	<div id="content">
    	<div align="center"><h1>Edit Match Report</h1></div>
        <form name="reports" action="./commit/commitmatchreport.php?Action=edit" method="post" onSubmit="submitForm()">
        	<p align="center">
                <strong>Match</strong><br />
                <em>{$match->squadName} v {$match->opposition} {$match->friendly} on {$match->date|date_format} {$match->home}</em>
            </p>
        	{include file="reportdetails.tpl"}
    </div>