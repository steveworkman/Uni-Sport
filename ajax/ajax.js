// JavaScript Document
// Girder's AJAX Framework (GAF)
/***********************************
The following code is shamelessly copied from
http://www.onlamp.com/pub/a/onlamp/2005/05/19/xmlhttprequest.html?CMP=ILC-S60H73598977&ATT=2225
Courtesy of O'Reilly's.
It has also been somewhat "modified" to produce more readable code and display loading images
************************************/

function xmlhttpPost(strURL, strSubmit, strResultFunc, xml)
{
	var xmlHttpReq = false;
	// Mozilla/Safari
	if (window.XMLHttpRequest) {
			xmlHttpReq = new XMLHttpRequest();
			if (xmlHttpReq.overrideMimeType) 
			{
				xmlHttpReq.overrideMimeType('text/xml');
			}
	}
	// IE 5/6
	else if (window.ActiveXObject) 
	{
		try {
				xmlHttpReq = new ActiveXObject("Msxml2.XMLHTTP");
			} catch (e)
			{
				try {
					xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");
				} catch (e) {}
			}
	}
	xmlHttpReq.open('POST', strURL, true);
	xmlHttpReq.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	xmlHttpReq.onreadystatechange = function()
	{
		if (xmlHttpReq.readyState == 4)
		{
			if (xml == '1')
			{
				var strResponse = xmlHttpReq.responseXML;
			}
			else
			{
				strResponse = xmlHttpReq.responseText;
			}
           switch (xmlHttpReq.status)
		   {
			   // Page-not-found error
			   case 404:
					   alert('Error: Not Found. The requested URL ' + 
							   strURL + ' could not be found.');
					   break;
			   // Display results in a full window for server-side errors
			   case 500:
					   handleErrFullPage(strResponse);
					   break;
			   default:
					   // Call the desired result function
						eval(strResultFunc + '(strResponse);');
					   break;
           }
   		}
	}
xmlHttpReq.send(strSubmit);
}

function handleErrFullPage(strIn)
{
	var errorWin;

	// Create new window and display error
	try {
			errorWin = window.open('', 'errorWin');
			errorWin.document.body.innerHTML = strIn;
	}
	// If pop-up gets blocked, inform user
	catch(e) {
			alert('An error occurred, but the error message cannot be' +
					' displayed because of your browser\'s pop-up blocker.\n' +
					'Please allow pop-ups from this Web site.');
	}
}