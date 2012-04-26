/*** Uni-Sport.org Activation JS	***/
/*** Author: Steven Workman			***/
/*** Created on: 16th August 2007 	***/
/*** Last updated: 16th August 2007	***/

$(document).ready(function(){
	$("#pending").click(function(){
		$("#data").SlideOutLeft("slow",function(){
			$.get("./pending.php", {
				  ajax: 1
				  },function(response){
					  setTimeout("finishAjax('"+escape(response)+"')", 0);
				});
			});
	return false;
	});
	$("#inactive").click(function(){
		$("#data").SlideOutLeft("slow",function(){
			$.get("./inactive.php", {
				  ajax: 1
				  },function(response){
					  setTimeout("finishAjax('"+escape(response)+"')", 0);
				});
			});
	return false;
	});
});
function finishAjax(response)
{
	$("#data").html(unescape(response));
	$("#data").SlideInRight("slow");
}