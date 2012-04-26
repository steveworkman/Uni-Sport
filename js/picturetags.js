/*** Uni-Sport.org pictureTags JS	***/
/*** Author: Steven Workman			***/
/*** Created on: 25th August 2007 	***/
/*** Last updated: 25th August 2007	***/

$(document).ready(function(){
						   
	function formatItem(row) {
		return row[0];
	}
	
	function findValueCallback(event, data, formatted) {
		var it = $("<li>").text(data[0]).attr('id',data[1]);
		it.append('<a href="#" class="removeable" id="'+data[1]+'">[remove]</a>');
		$(this).next().next().append(it);
		// Clear the input box
		$(this).val('');
	}
	$(".ac input").autocomplete("ajax/searchpeople.php", {
		delay: 150,
		mustMatch: true,
		autoFill: true,
		formatItem: formatItem
	});
	$(".ac input").result(findValueCallback);
	
	// This is called Event delegation, rather than using handlers which don't work
	// with AJAX content
	$('.ac').click(function(event) {
	   if ($(event.target).is('.removeable')) {
			removeTag($(event.target).attr('id'));
	   }
	   return false;
 	});
	
	function removeTag(id)
	{
		$("li #"+id).remove();
	}
	$("#editalbum").submit( function() {
		var ids = $('#pic_ids').val().split(',');
		for(var i=0; i<ids.length; i++)
		{
			var str = "";
			$.each($("#list"+ids[i]+" li"), function() {
				str = str+$(this).attr('id')+',';
			});
			$("#hidden_tag"+ids[i]).val(str);
		}
 	});
});

