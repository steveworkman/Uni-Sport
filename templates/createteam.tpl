<script language="javascript" type="text/javascript" src="./fhockey/JScreate.js"></script>
<script language="javascript" type="text/javascript" src="./ajax/ajax.js"></script>
<script language="javascript" type="text/javascript" src="./ajax/fhockey.js"></script>
<div id="main">
	<div id="content" style="width:100%">
    	<div class="center"><h1>Create Your Fantasy Team</h1></div>
        {if $locked != ''}
        	{$locked}
        {else}
        <p>
        Create your own Fantasy Hockey Team here. Your budget is <strong>&pound;50 million</strong> with which you must buy 1 Goalkeeper, 4 Defenders, 4 Midfielders and 2 Forwards. All freshers are worth &pound;4 million (bargain!). A full set of rules can be found <a href="./fhockey.php?Page=rules">here</a>.</p>
        <p>
        When you are ready to submit your team click on the submit button below. You will have the oppertunity to make transfers during the season
        </p>
        <div id="lists" style="width:40%; float:left;">
			<p>
            <form name="fhockey" action="./fhockey/committeam.php" method="post">
            <strong>Team Name: </strong> <input type="text" name="name" />
            <br />
            
            {* Table for Goalkeepers *}
            <table class="tbl" width="179">
                <tr>
                	<th colspan="3">Goalkeepers</th>
                </tr>
                <tr>
                    <td width="79">
                    <select name="GKM" size=10 onFocus="getProfile(document.fhockey.GKM[document.fhockey.GKM.selectedIndex].value)" onchange="getProfile(document.fhockey.GKM[document.fhockey.GKM.selectedIndex].value)">
                    {foreach from=$GKs item=GK}
                    <option value="{$GK.id}">{$GK.name} (&pound;{$GK.value}m)</option>
                    {/foreach}
                    </select>
                    </td>
                    <td width="25"><input type="button" name="add" value="&gt;"  onClick="getValue(document.fhockey.GKM[document.fhockey.GKM.selectedIndex].value, document.fhockey.GKS, 1, 0); addItGK();">
                    <input name="Remove" type="button" value="&lt;" onClick="getValue(document.fhockey.GKS[document.fhockey.GKS.selectedIndex].value, document.fhockey.GKS, 2, 1); removeItGK();">
                    </td>
                    <td width="57">
                    <select name="GKS" size=10 multiple id="GKS" onFocus="getProfile(document.fhockey.GKS[document.fhockey.GKS.selectedIndex].value)" onchange="getProfile(document.fhockey.GKS[document.fhockey.GKS.selectedIndex].value)">
                    </select>
                    </td>
                </tr>
            </table>
             
            {* Table for Defenders *}
            <table class="tbl" width="179">
                <tr>
                    <th colspan="3">Defenders</th>
                </tr>
                <tr>
                    <td width="79">
                    <select name="DFM" size=10 onFocus="getProfile(document.fhockey.DFM[document.fhockey.DFM.selectedIndex].value)" onchange="getProfile(document.fhockey.DFM[document.fhockey.DFM.selectedIndex].value)">
                    {foreach from=$DFs item=DF}
                    <option value="{$DF.id}">{$DF.name} (&pound;{$DF.value}m)</option>
                    {/foreach}
                    </select>
                    </td>
                    <td width="25"><input type="button" name="add" value="&gt;"  onClick="getValue(document.fhockey.DFM[document.fhockey.DFM.selectedIndex].value, document.fhockey.DFS, 4, 0); addItDF();">
                    <input name="Remove" type="button" value="&lt;" onClick="getValue(document.fhockey.DFS[document.fhockey.DFS.selectedIndex].value, document.fhockey.DFS, 5, 1); removeItDF();">
                    </td>
                    <td width="57">
                    <select name="DFS" size=10 multiple id="DFS" onFocus="getProfile(document.fhockey.DFS[document.fhockey.DFS.selectedIndex].value)" onchange="getProfile(document.fhockey.DFS[document.fhockey.DFS.selectedIndex].value)">
                    </select>
                    </td>
               	</tr>
            </table>
            
            {* Table for Midfielders *}
            <table class="tbl" width="179">
                <tr>
                	<th colspan="3">Midfielders</th>
                </tr>
                <tr>
                	<td width="79">
                    <select name="MFM" size=10 onFocus="getProfile(document.fhockey.MFM[document.fhockey.MFM.selectedIndex].value)" onchange="getProfile(document.fhockey.MFM[document.fhockey.MFM.selectedIndex].value)">
                    {foreach from=$MFs item=MF}
                    <option value="{$MF.id}">{$MF.name} (&pound;{$MF.value}m)</option>
                    {/foreach}
                    </select>
                    </td>
                    <td width="25"><input type="button" name="add" value="&gt;"  onClick="getValue(document.fhockey.MFM[document.fhockey.MFM.selectedIndex].value, document.fhockey.MFS, 4, 0); addItMF();">
                    <input name="Remove" type="button" value="&lt;" onClick="getValue(document.fhockey.MFS[document.fhockey.MFS.selectedIndex].value, document.fhockey.MFS, 5, 1); removeItMF();">
                    </td>
                    <td width="57">
                    <select name="MFS" size=10 multiple id="MFS" onFocus="getProfile(document.fhockey.MFS[document.fhockey.MFS.selectedIndex].value)" onchange="getProfile(document.fhockey.MFS[document.fhockey.MFS.selectedIndex].value)">
                    </select>
                    </td>
                </tr>
            </table>
            
            {* Table for Forwards *}
            <table class="tbl" width="179">
                <tr>
                	<th colspan="3">Forwards</th>
                </tr>
                <tr>
                	<td width="79">
                    <select name="FWM" size=10 onFocus="getProfile(document.fhockey.FWM[document.fhockey.FWM.selectedIndex].value)" onchange="getProfile(document.fhockey.FWM[document.fhockey.FWM.selectedIndex].value)">
                    {foreach from=$FWs item=FW}
                    <option value="{$FW.id}">{$FW.name} (&pound;{$FW.value}m)</option>
                    {/foreach}
                    </select>
                    </td>
                    <td width="25"><input type="button" name="add" value="&gt;"  onClick="getValue(document.fhockey.FWM[document.fhockey.FWM.selectedIndex].value, document.fhockey.FWS, 2, 0); addItFW();">
                    <input name="Remove" type="button" value="&lt;" onClick="getValue(document.fhockey.FWS[document.fhockey.FWS.selectedIndex].value, document.fhockey.FWS, 3, 1); removeItFW();">
                    </td>
                    <td width="57">
                    <select name="FWS" size=10 multiple id="FWS" onFocus="getProfile(document.fhockey.FWS[document.fhockey.FWS.selectedIndex].value)" onchange="getProfile(document.fhockey.FWS[document.fhockey.FWS.selectedIndex].value)">
                    </select>
                    </td>
                </tr>
            </table>
        	</p>
            <p>
            <strong>Remaining Budget: </strong><div id="remaining"><span style="color:green">&pound;50m</span></div>
            <strong>Total Spent: </strong><div id="spent"><span style="color:green">&pound;0m</span></div>
            <input type="submit" name="Submit" value="Submit" onclick="submitForm();" disabled="disabled" />
            </p>
            <input name="GKs" type="hidden" value = " " />
            <input name="DFs" type="hidden" value = " " />
            <input name="MFs" type="hidden" value = " " />
            <input name="FWs" type="hidden" value = " " />
            <input name="budget" type="hidden" value = " " />
            </div>
        <div id="profile" style="width:55%; float:right; margin-left: 2px; vertical-align:top;">
            </div>
        </form>
        </div>
        {/if}
    </div>