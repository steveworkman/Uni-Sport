/*** Uni-Sport.org Reports JS		***/
/*** Author: Steven Workman			***/
/*** Created on: 17th August 2007 	***/
/*** Last updated: 17th August 2007	***/

// This is the v4 code to switch out the select more easily

$(document).ready(function(){
	$("#match").change(function(){
		$("#reportDetails").SlideOutLeft("slow",function(){
			$.get("./reportdetails.inc.php", {
				  match_id: $("#match").val(),
				  ajax: 1
				  }, function(response){
					  setTimeout("finishAjax('"+escape(response)+"')", 0);
					});
			});
	});
});
function finishAjax(response)
{
	$("#reportDetails").html(unescape(response));
	$("#reportDetails").SlideInRight("slow");
}

// Most of this code is legacy stuff from v3 but it could be converted to jQuery
function addItScorer() 
{ 
  var text = document.reports.members[document.reports.members.selectedIndex].text; 
  var val = document.reports.members[document.reports.members.selectedIndex].value; 
  addOption = new Option(text,val);
  document.reports.squ.options[document.reports.squ.length++] = addOption;
} 
function removeItScorer() 
{ 
  var text = document.reports.squ[document.reports.squ.selectedIndex].text; 
  var val = document.reports.squ[document.reports.squ.selectedIndex].value; 
  addOption = new Option(text,val);
  document.reports.squ.remove(document.reports.squ.selectedIndex);
}
function addItYCard() 
{ 
  var text = document.reports.members2[document.reports.members2.selectedIndex].text; 
  var val = document.reports.members2[document.reports.members2.selectedIndex].value; 
  addOption = new Option(text,val);
  document.reports.ycard.options[document.reports.ycard.length++] = addOption; 
  document.reports.members2.remove(document.reports.members2.selectedIndex);
} 
function removeItYCard() 
{ 
  var text = document.reports.ycard[document.reports.ycard.selectedIndex].text; 
  var val = document.reports.ycard[document.reports.ycard.selectedIndex].value; 
  addOption = new Option(text,val);
  document.reports.members2.options[document.reports.members2.length++] = addOption; 
  document.reports.ycard.remove(document.reports.ycard.selectedIndex);
}
function addItRCard() 
{ 
  var text = document.reports.members3[document.reports.members3.selectedIndex].text; 
  var val = document.reports.members3[document.reports.members3.selectedIndex].value; 
  addOption = new Option(text,val);
  document.reports.rcard.options[document.reports.rcard.length++] = addOption; 
  document.reports.members3.remove(document.reports.members3.selectedIndex);
} 
function removeItRCard() 
{ 
  var text = document.reports.rcard[document.reports.rcard.selectedIndex].text; 
  var val = document.reports.rcard[document.reports.rcard.selectedIndex].value; 
  addOption = new Option(text,val);
  document.reports.members.options[document.reports.members.length++] = addOption; 
  document.reports.rcard.remove(document.reports.rcard.selectedIndex);
}

function submitForm()
{
//document.squadForm.squad.value = "";
for (var i=0; i < document.reports.squ.length; i++)
{	
	document.reports.scorers.value = document.reports.scorers.value + "," + document.reports.squ[i].value;
}
for (var i=0; i < document.reports.ycard.length; i++)
{	
	document.reports.ycards.value = document.reports.ycards.value + "," + document.reports.ycard[i].value;
}
for (var i=0; i < document.reports.rcard.length; i++)
{	
	document.reports.rcards.value = document.reports.rcards.value + "," + document.reports.rcard[i].value;
}
//document.squadForm.submit();
}