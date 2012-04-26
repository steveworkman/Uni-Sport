// JavaScript Document
curspent = 0.0;
function getProfile(id)
{
	var query = 'id='+id;
	xmlhttpPost('./ajax/getfhockeyprofile.php', query, 'displayProfile', '1');
}

function getValue(id, field, limit, neg)
{
	if (checkLimits(field, limit))
	{
		var query = 'id='+id+'&neg='+neg;
		xmlhttpPost('./ajax/getfhockeyvalue.php', query, 'calcBudget', '1');
	}
}

function calcBudget(res)
{
	var remaining = document.getElementById('remaining');
	var spent = document.getElementById('spent');
	
	//Reset the fields
	remaining.innerHTML = '';
	spent.innerHTML = '';
	
	value = parseFloat(res.getElementsByTagName('root')[0].childNodes[0].firstChild.data);
	neg = res.getElementsByTagName('root')[0].childNodes[1].firstChild.data;
	if (neg == 0)
		curspent = curspent+value;
	else
		curspent = curspent-value;
	
	var rem = 50-curspent;
	rem = rem.toPrecision(3);
	var colour = '';
	if(curspent > 50)
	{
		colour = 'red';
		document.fhockey.Submit.disabled = true;
	}
	else
	{
		colour = 'green';
		// check for all 11 players
		if ((document.fhockey.GKS.length + document.fhockey.DFS.length + document.fhockey.MFS.length + document.fhockey.FWS.length) == 11)
			document.fhockey.Submit.disabled = false;
	}
	
	remaining.innerHTML = '<span style="color:'+colour+';">&pound;'+rem+'m</span>';
	spent.innerHTML = '<span style="color:'+colour+';">&pound;'+curspent+'m</span>';
}

function displayProfile(res)
{
	// Dump the current profile, if any
	var profile = document.getElementById('profile');
	profile.innerHTML = '';
	
	// Add the new shizzle
	// First, get the variables
	var root = res.getElementsByTagName('root')[0].childNodes;
	var id = root[0].firstChild.data;
	var username = root[1].firstChild.data;
	if (root[2].firstChild != null) {
		var fname = root[2].firstChild.data;
	}
	else { var fname = ''; }
	if (root[3].firstChild != null) {
		var lname = root[3].firstChild.data;
	}
	else { var lname = ''; }
	if (root[4].firstChild != null) {
		var dob = root[4].firstChild.data;
	}
	else { var dob = ''; }
	if (root[5].firstChild != null) {
		var value = root[5].firstChild.data;
	}
	else { var value = '0'; }
	if (root[6].firstChild != null) {
		var points = root[6].firstChild.data;
	}
	else { var points = '0'; }
	if (root[7].firstChild != null) {
		var goals = root[7].firstChild.data;
	}
	else { var goals = ''; }
	if (root[8].firstChild != null) {
		var avatar = root[8].firstChild.data;
	}
	else { var avatar = ''; }
	if (root[9].firstChild != null) {
		var position = root[9].firstChild.data;
	}
	else {var position = ''; }
	if (root[10].firstChild != null) {
		var side = root[10].firstChild.data;
	}
	else {var side = ''; }
	// Create the output
	var output = '<table class="tbl" cellpadding="2" cellspacing="2" >';
	output = output + '<tr><td><table cellpadding="2" cellspacing="2">';
	output = output + '<tr><td><strong>Nickname</strong></td><td><strong>'+username+'</strong></td></tr>';
	output = output + '<tr><td><strong>Real Name</strong></td><td>'+fname+' '+lname+'</td></tr>';
	output = output + '<tr><td><strong>Date of Birth</strong></td><td>'+dob+'</td></tr></table></td>';
	output = output + '<td><center><img src="'+avatar+'" alt="'+username+'" border="0" /></center></td></tr>';
	output = output + '<tr><td><strong>Fantasy Points</strong></td><td>&pound;'+value+'m</td></tr>';
	output = output + '<tr><td><strong>Fantasy Points</strong></td><td>'+points+'</td></tr>';
	output = output + '<tr><td><strong>Goals Scored</strong></td><td>'+goals+'</td></tr>';
	output = output + '<tr><td><strong>Favoured Playing Position</strong></td><td>'+side+' '+position+'</td></tr></table>';
	profile.innerHTML = output;
}