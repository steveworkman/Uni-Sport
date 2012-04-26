/*** Uni-Sport.org Sliding Sidebar JS 	***/
/*** Author: Steven Workman				***/
/*** Created on: 11rd July 2007 		***/
/*** Last updated: 18th August 2007 	***/

$(document).ready(function(){
	// For normal sidebars
	$(".sidebarContent h3").not('.header').click(function(){
		var curr = $(this);
		if(curr.is('.headerShown')) {
			curr.next().slideUp("slow");
			curr.removeClass('headerShown').addClass('headerHidden');
			ajaxHide(curr.attr('id'),1);
		}
		else {
			curr.next().slideDown('slow');
			curr.removeClass('headerHidden').addClass('headerShown');
			ajaxHide(curr.attr('id'),0);
		}
		return false;
	});
	// To show/hide old/new login
	$("#changelogin").click(function(){
		$("#oldlogin").slideToggle("normal");
		return false;
	});
	
});
function ajaxHide(hid,hidden) {
	$.post("./ajax/hideshow.php", {id: hid, hide: hidden});
}