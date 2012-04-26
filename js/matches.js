/*** Uni-Sport.org Matches JS		***/
/*** Author: Steven Workman			***/
/*** Created on: 14th July 2007 	***/
/*** Last updated: 14th  July 2007 	***/

$(document).ready(function(){
	$("#reportSelect").change(function(){
		$("#report").SlideOutLeft("slow",function(){
			$.get("./report.inc.php", {
				  report_id: $("#reportSelect").val()
				  }, function(response){
					  setTimeout("finishAjax('"+escape(response)+"')", 0);
					});
			});
	});
});
function finishAjax(response)
{
	$("#report").html(unescape(response));
	$("#report").SlideInRight("slow");
}