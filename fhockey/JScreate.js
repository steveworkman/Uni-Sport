function checkLimits(field, limit)
{
	//alert(field.length+', '+limit);
	if (field.length == limit)
		return false;
	else
		return true;
}

function addItGK() 
  {
	  if (checkLimits(document.fhockey.GKS, 1))
	  {
		  var text = document.fhockey.GKM[document.fhockey.GKM.selectedIndex].text; 
		  var val = document.fhockey.GKM[document.fhockey.GKM.selectedIndex].value; 
		  addOption = new Option(text,val);
		  document.fhockey.GKS.options[document.fhockey.GKS.length++] = addOption; 
		  document.fhockey.GKM.remove(document.fhockey.GKM.selectedIndex);
	  }
  } 
  function removeItGK() 
  { 
	  var text = document.fhockey.GKS[document.fhockey.GKS.selectedIndex].text; 
	  var val = document.fhockey.GKS[document.fhockey.GKS.selectedIndex].value; 
	  addOption = new Option(text,val);
	  document.fhockey.GKM.options[document.fhockey.GKM.length++] = addOption; 
	  document.fhockey.GKS.remove(document.fhockey.GKS.selectedIndex);
  }
  function addItDF() 
  {
	  if (checkLimits(document.fhockey.DFS, 4))
	  {
		  var text = document.fhockey.DFM[document.fhockey.DFM.selectedIndex].text; 
		  var val = document.fhockey.DFM[document.fhockey.DFM.selectedIndex].value; 
		  addOption = new Option(text,val);
		  document.fhockey.DFS.options[document.fhockey.DFS.length++] = addOption; 
		  document.fhockey.DFM.remove(document.fhockey.DFM.selectedIndex);
	  }
  } 
  function removeItDF() 
  { 
	  var text = document.fhockey.DFS[document.fhockey.DFS.selectedIndex].text; 
	  var val = document.fhockey.DFS[document.fhockey.DFS.selectedIndex].value; 
	  addOption = new Option(text,val);
	  document.fhockey.DFM.options[document.fhockey.DFM.length++] = addOption; 
	  document.fhockey.DFS.remove(document.fhockey.DFS.selectedIndex);
  }
  function addItMF() 
  {
	  if (checkLimits(document.fhockey.MFS, 4))
	  {
		  var text = document.fhockey.MFM[document.fhockey.MFM.selectedIndex].text; 
		  var val = document.fhockey.MFM[document.fhockey.MFM.selectedIndex].value; 
		  addOption = new Option(text,val);
		  document.fhockey.MFS.options[document.fhockey.MFS.length++] = addOption; 
		  document.fhockey.MFM.remove(document.fhockey.MFM.selectedIndex);
	  }
  } 
  function removeItMF() 
  { 
	  var text = document.fhockey.MFS[document.fhockey.MFS.selectedIndex].text; 
	  var val = document.fhockey.MFS[document.fhockey.MFS.selectedIndex].value; 
	  addOption = new Option(text,val);
	  document.fhockey.MFM.options[document.fhockey.MFM.length++] = addOption; 
	  document.fhockey.MFS.remove(document.fhockey.MFS.selectedIndex);
  }
  function addItFW() 
  {
	  if (checkLimits(document.fhockey.FWS, 2))
	  {
		  var text = document.fhockey.FWM[document.fhockey.FWM.selectedIndex].text; 
		  var val = document.fhockey.FWM[document.fhockey.FWM.selectedIndex].value; 
		  addOption = new Option(text,val);
		  document.fhockey.FWS.options[document.fhockey.FWS.length++] = addOption; 
		  document.fhockey.FWM.remove(document.fhockey.FWM.selectedIndex);
	  }
  } 
  function removeItFW() 
  { 
	  var text = document.fhockey.FWS[document.fhockey.FWS.selectedIndex].text; 
	  var val = document.fhockey.FWS[document.fhockey.FWS.selectedIndex].value; 
	  addOption = new Option(text,val);
	  document.fhockey.FWM.options[document.fhockey.FWM.length++] = addOption; 
	  document.fhockey.FWS.remove(document.fhockey.FWS.selectedIndex);
  }

function submitForm()
{
	for (var i=0; i < document.fhockey.GKS.length; i++)
	{	
		document.fhockey.GKs.value = document.fhockey.GKs.value + "," + document.fhockey.GKS[i].value;
	}
	for (var i=0; i < document.fhockey.DFS.length; i++)
	{	
		document.fhockey.DFs.value = document.fhockey.DFs.value + "," + document.fhockey.DFS[i].value;
	}
	for (var i=0; i < document.fhockey.MFS.length; i++)
	{	
		document.fhockey.MFs.value = document.fhockey.MFs.value + "," + document.fhockey.MFS[i].value;
	}
	for (var i=0; i < document.fhockey.FWS.length; i++)
	{	
		document.fhockey.FWs.value = document.fhockey.FWs.value + "," + document.fhockey.FWS[i].value;
	}
	rem = 50-curspent;
	document.fhockey.budget.value = rem.toPrecision(3);
}