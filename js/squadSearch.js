/*** Uni-Sport.org squadSearch JS	***/
/*** Author: Steven Workman			***/
/*** Created on: 6th August 2007 	***/
/*** Last updated: 20th August 2007	***/

$(document).ready(function(){
						   
	function formatItem(row) {
		return row[0]+" ("+row[2]+", "+row[4]+" "+row[3]+")";
	}
	
	function findValueCallback(event, data, formatted) {
		$(this).next().val(data[1]);
	}
	$("#squadlist input").autocomplete("ajax/searchpeople.php", {
		delay: 150,
		mustMatch: true,
		autoFill: true,
		formatItem: formatItem
	});
	$("#squadlist input").result(findValueCallback);
	$("a#addplayer").click(function() {
		var index = parseInt($("input#playernum").val());
		$("#squadlist #list"+index).show();
		$("input#playernum").val(index+1);
	return false;
	});
});