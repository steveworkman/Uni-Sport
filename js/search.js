/*** Uni-Sport.org Search JS		***/
/*** Author: Steven Workman			***/
/*** Created on: 30th August 2007 	***/
/*** Last updated: 30th August 2007	***/

$(document).ready(function(){
	function formatItem(row) {
		return row[1];
	}
	
	function formatResult(row) {
		return row[1];
	}
	function gotoPage(event, data, formatted) {
		window.location = data[0];
	}
	$("#search").autocomplete("ajax/sitesearch.php", {
		delay: 150,
		formatItem: formatItem,
		formatResult: formatResult,
		selectFirst: false
	});
	$("#search").result(gotoPage);
});