/*** Uni-Sport.org Slideshow JS		***/
/*** Author: Steven Workman			***/
/*** Created on: 24th August 2007 	***/
/*** Last updated: 24th August 2007	***/

// This stuff is for the carousel
function mycarousel_itemLoadCallback(carousel, state)
{
	if (state != 'init'){return;}
	$.post('./ajax/getpictures.php',{
		album_id: $("#album_id").val(),
		user_id: $("#user_id").val()
		}, function(data) {
        mycarousel_itemAddCallback(carousel, carousel.first, carousel.last, data);
	});
}

function mycarousel_itemAddCallback(carousel, first, last, data)
{
    // Simply add all items at once and set the size accordingly.
	// items array is: id, thumb, alt, width, height
    var items = data.split('|');
	carousel.size(items.length/5);
	var j=0;
    for (i = 0; i < (items.length/5); i++) {
		// Create an object from HTML
		var html = $(mycarousel_getPicHTML(items[j],items[j+1],items[j+2],items[j+3],items[j+4]));
		
        carousel.add(i+1, html);
		j = j+5;
    }
}

// This code is for displaying a preview picture
function displayPreview(id, url, alt, width, height)
{
	var html = $(my_getThickboxHTML(url, alt, width, height));
	// Apply thickbox
	tb_init(html);
	// Put the picture in the box
	$("#currpic").html(html);
	// Put the comment in
	$("#comment").html(alt);
	// Set the pic_id
	$("#pic_id").val(id);
	// Get the tags
	$.post('./ajax/gettags.php',{
		   pic_id: id
		   }, function(data) {
			$("#tags").html(data);
	});
}
/*
 * Item html creation helper. Creates link for thickbox
 */
function my_getThickboxHTML(url, alt, width, height)
{
	if(height !== '')
	{return '<a href="'+url+'" title="'+alt+'"><img src="'+url+'" width="'+width+'" height="'+height+'" alt="'+alt+'" /></a>';}
	else
	{return '<a href="'+url+'" title="'+alt+'"><img src="'+url+'" width="'+width+'" alt="'+alt+'" /></a>';}
}
/**
 * Item html creation helper. Creates link to put into #pic
 */
function mycarousel_getPicHTML(id, url, alt, width, height)
{
    var url_m = url.replace('/thumbs', '');
    return "<a href=\""+url_m+"\" title=\""+alt+"\" onclick=\"displayPreview('"+id+"','"+url_m+"','"+alt+"','"+width+"','"+height+"');return false;\"><img src=\""+url+"\" width=\"75\" height=\"75\" alt=\""+alt+"\" /></a>";
}
$(document).ready(function(){
	$('#mycarousel').jcarousel({
		visible: 7,
        itemLoadCallback: {onBeforeAnimation:mycarousel_itemLoadCallback}
    });
	
	// This is for the tagging input box
	function formatItem(row) {
		return row[0];
	}
	
	function findValueCallback(event, data, formatted) {
		$(this).val(''); // Clear input
		$.post('./ajax/submittag.php', {
			   pic_id: $("#pic_id").val(),
			   user_id: data[1],
			   username: data[0]
			   }, function(data) {
				   
				   if(data !== '')
				   {
					   $("#tags").append(data);
				   }
		});
	}
	$("#taginput").autocomplete("ajax/searchpeople.php", {
		delay: 150,
		mustMatch: true,
		autoFill: true,
		formatItem: formatItem,
		extraParams: {arc:0}
	});
	$("#taginput").result(findValueCallback);
});