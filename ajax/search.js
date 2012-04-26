// JavaScript Document
/**************************************************************
** This is an AJAX enabled function set for Searching
** The Set includes functions for searching people and pictures
***************************************************************/

function SearchPeople(str)
{
	// Pass the search string to AJAX, give it to the displayPeople function
	if (str.length > 0)
	{
		var query = 'str='+str;
		xmlhttpPost('./ajax/searchpeople.php', query, 'displayPeople', '1');
	}
	else
	{
		document.getElementById('results').innerHTML = 'No Matches Found';
	}
}

function displayPeople(res)
{
	// Remove any text currently there
	var results = document.getElementById('results');
	results.innerHTML = '';
	
	// Add the new shizzle
	var root = res.getElementsByTagName('root')[0];
	var output = '';
	for( var i = 0; i<root.childNodes.length; i++)
	{
		var namechild = root.childNodes[i].getElementsByTagName('name')[0].firstChild;
		var valuechild = root.childNodes[i].getElementsByTagName('value')[0].lastChild;
		output = output+'<span class="sTag" onclick="getMiniProfile('+valuechild.data+');" >'+namechild.data+'</span><br />';
	}
	if (output == '')
	{
		results.innerHTML = 'No Matches Found';
	}
	else
	{
		results.innerHTML = output;
	}
}

function getMiniProfile(id)
{
	var query = 'id='+id;
	xmlhttpPost('./ajax/getminiprofile.php', query, 'displayMiniProfile', '1');
}

function displayMiniProfile(res)
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
		var quote = root[5].firstChild.data;
	}
	else { var quote = ''; }
	if (root[6].firstChild != null) {
		var avatar = root[6].firstChild.data;
	}
	else { var avatar = ''; }
	if (root[7].firstChild != null) {
		var position = root[7].firstChild.data;
	}
	else { var position = ''; }
	if (root[8].firstChild != null) {
		var side = root[8].firstChild.data;
	}
	else {var side = ''; }
	
	// Create the output
	var output = '<table class="tbl" cellpadding="2" cellspacing="2" >';
	output = output + '<tr><td><table cellpadding="2" cellspacing="2">';
	output = output + '<tr><td><strong>Nickname</strong></td><td><strong>'+username+'</strong></td></tr>';
	output = output + '<tr><td><strong>Real Name</strong></td><td>'+fname+' '+lname+'</td></tr>';
	output = output + '<tr><td><strong>Date of Birth</strong></td><td>'+dob+'</td></tr></table></td>';
	output = output + '<td><center><img src="'+avatar+'" alt="'+username+'" border="0" /></center></td></tr>';
	output = output + '<tr><td><strong>Quote</strong></td><td>'+quote+'</td></tr>';
	output = output + '<tr><td><strong>Favoured Playing Position</strong></td><td>'+side+' '+position+'</td></tr>';
	output = output + '<tr><td colspan="2"><center><a href="viewprofile.php?action=view&uid='+id+'">View full profile</a></center></td></tr></table>';
	profile.innerHTML = output;
}