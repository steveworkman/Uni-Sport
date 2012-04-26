// JavaScript Document
function getProfile(id, tid, pid, pos)
{
	var query = 'id='+id+'&tid='+tid+'&pos='+pos+'&pid='+pid;
	xmlhttpPost('./ajax/gettransferprofile.php', query, 'displayProfile', '1');
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
	if (root[11].firstChild != null) {
		var tid = root[11].firstChild.data;
	}
	else {var tid = ''; }
	if (root[12].firstChild != null) {
		var pid = root[12].firstChild.data;
	}
	else {var pid = ''; }
	if (root[13].firstChild != null) {
		var pos = root[13].firstChild.data;
	}
	else {var pos = ''; }
	// Create the output
	var output = '<table class="tbl" cellpadding="2" cellspacing="2" >';
	output = output + '<tr><td><table cellpadding="2" cellspacing="2">';
	output = output + '<tr><td><strong>Nickname</strong></td><td><strong>'+username+'</strong></td></tr>';
	output = output + '<tr><td><strong>Real Name</strong></td><td>'+fname+' '+lname+'</td></tr>';
	output = output + '<tr><td><strong>Date of Birth</strong></td><td>'+dob+'</td></tr></table></td>';
	output = output + '<td><center><img src="'+avatar+'" alt="'+username+'" border="0" /></center></td></tr>';
	output = output + '<tr><td><strong>Value</strong></td><td>&pound;'+value+'m</td></tr>';
	output = output + '<tr><td><strong>Current Points</strong></td><td>'+points+'</td></tr>';
	output = output + '<tr><td><strong>Goals Scored</strong></td><td>'+goals+'</td></tr>';
	output = output + '<tr><td><strong>Favoured Playing Position</strong></td><td>'+side+' '+position+'</td></tr>';
	output = output + '<tr><td colspan="2" align="center"><strong><a href="./fhockey.php?Page=transfers&tid='+tid+'&pid='+pid+'&pos='+pos+'&id='+id+'&pg=3">Select this player</a></strong></td></tr></table>';
	profile.innerHTML = output;
}