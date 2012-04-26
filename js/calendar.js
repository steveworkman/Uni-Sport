/*** Uni-Sport.org Calendar JS		***/
/*** Author: Steven Workman			***/
/*** Created on: 13th July 2007 	***/
/*** Last updated: 13th  July 2007 	***/

$(document).ready(function(){
	$("#toggle").click(function(){
		$("#calendar .arc").toggle();
		$("#calendar .arc").Highlight(1000, '#ff9');
		
		var curr = $(this);
		var ref = '';
		if(curr.is('.show'))
		{
			curr.removeClass('show');
			curr.addClass('hide').empty().append('Show archived members');
			ref = $("#calendar #navleft").attr("href");
			$("#calendar #navleft").attr("href", ref.slice(0, -1)+'0');
			ref = $("#calendar #navright").attr("href");
			$("#calendar #navright").attr("href", ref.slice(0, -1)+'0');
		}
		else
		{
			curr.removeClass('hide');
			curr.addClass('show').empty().append('Hide archived members');
			ref = $("#calendar #navleft").attr("href");

			$("#calendar #navleft").attr("href", ref.slice(0, -1)+'1');
			ref = $("#calendar #navright").attr("href");
			$("#calendar #navright").attr("href", ref.slice(0, -1)+'1');
		}
		return false;
	});
});