// This is the overlabel jQuery code from
// http://scott.sauyet.com/thoughts/archives/2007/03/31/overlabel-with-jquery/
(function($){
$.fn.overlabel = function() {
    this.each(function(){
        var label = $(this);
	$("#"+(this.htmlFor || label.attr('for') || "ID-NOT-FOUND"))
		.focus(function(){ label.css("left", "-1000px"); })
		.blur(function(){ this.value || label.css("left", "0px"); })
		.trigger("focus").trigger("blur")
		.length && 
			label.addClass("overlabel-apply");
    });
}
})(jQuery);