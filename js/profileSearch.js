/*** Uni-Sport.org profileSearch JS	***/
/*** Author: Steven Workman			***/
/*** Created on: 14th July 2007 	***/
/*** Last updated: 14th  July 2007 	***/

$(document).ready(function(){
	function formatItem(row) {
		return row[0];
	}
	
	function formatResult(row) {
		return row[0];
	}
	function displayMiniProfile(event, data, formatted) {
		$("#profile").SlideOutRight("slow",function(){
		$.post("getminiprofile.php", {
			   id: data[1]
			   }, function(response){
				   setTimeout("finishAjax('"+escape(response)+"')", 0);
			});
		});
	}
$("#profileSearch").autocomplete("ajax/searchpeople.php", {
		delay: 150,
		width: 260,
		formatItem: formatItem,
		formatResult: formatResult,
		selectFirst: false
	});
$("#profileSearch").result(displayMiniProfile, function() {
		$(this).prev().search();
	});
});
function finishAjax(response)
{
	$("#profile").html(unescape(response));
	$("#profile").SlideInRight("slow");
}