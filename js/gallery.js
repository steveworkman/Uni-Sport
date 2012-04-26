/*** Uni-Sport.org gallery JS		***/
/*** Author: Steven Workman			***/
/*** Created on: 22nd August 2007 	***/
/*** Last updated: 22nd August 2007	***/

$(document).ready(function(){
	$("#showing").change(function(){
		$("#gallery").SlideOutDown("slow",function(){
			$.get("./getalbums.php", {
				  type: $("#showing").val(),
				  next: $("input#selnext").val(),
				  ajax: 1
				  }, function(response){
					  setTimeout("finishAjaxUp('"+escape(response)+"')", 0);
				});
				resetIndex();	
			});
		return false;	
	});
	$("#next a").click(function(){
		$("#gallery").SlideOutLeft("slow",function(){
			$.get("./getalbums.php", {
				  type: $("#showing").val(),
				  next: $("#currindex").val(),
				  ajax: 1
				  }, function(response){
					  setTimeout("finishAjaxRight('"+escape(response)+"')", 0);
					});
			});
			updateIndex(1);
			return false;
	});
	$("#prev a").click(function(){
		$("#gallery").SlideOutRight("slow",function(){
			$.get("./getalbums.php", {
				  type: $("#showing").val(),
				  next: $("#currindex").val(),
				  ajax: 1
				  }, function(response){
					  setTimeout("finishAjaxLeft('"+escape(response)+"')", 0);
					});
			});
			updateIndex(0);
			return false;
	});
	return false;
});

function finishAjaxRight(response)
{
	$("#gallery").html(unescape(response));
	$("#gallery").SlideInRight("slow");
}
function finishAjaxLeft(response)
{
	$("#gallery").html(unescape(response));
	$("#gallery").SlideInLeft("slow");
}
function finishAjaxUp(response)
{
	$("#gallery").html(unescape(response));
	$("#gallery").SlideInDown("slow");
}
function updateIndex(increase)
{
	var increment = parseInt($("#increment").val());
	var currindex = parseInt($("#currindex").val());
	if(increase == 1)
	{$("#currindex").val(currindex+increment);}
	else
	{$("#currindex").val(currindex-increment);}
}
function resetIndex()
{
	$("#currindex").val(1);
}