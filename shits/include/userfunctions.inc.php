<?php
// this contains misc functions for the user menu
	function getlinks($securitylevel)
	{		
		//cascading switch returning the links appropriate for each security level
		switch ($securitylevel)
		{
			case "1":
				$adminlinks =<<<EOD
					<a href="admin.php">Admin Menu </a>
EOD;
			case "2":
				$committeelinks =<<<EOD
					<a href="news.php">News Menu </a>
					<a href="events.php">Events Menu </a>
					<a href="newslettermenu.php">Newsletter Menu </a>
					
EOD;
			$query = "SELECT UserGroup FROM users WHERE user_id = '" . $_SESSION['shef_hockey_user_id'] . "'";
			$result = mysql_query($query)
				or die(mysql_error());
			$row = mysql_fetch_array($result);
			if ($row['UserGroup'] == 6)
			{	
				$committeelinks .= "<a href=\"matches.php\">Fixtures Menu </a>";
			}
			
			case "3":
				$tclinks =<<<EOD
					<a href="matches.php">Fixtures Menu </a>
					<a href="squads.php">Squad Menu </a>
					
EOD;
			case "5":
			
			case "4":
				$links =<<<EOD
					<div id="headlines">
						<a href="index.php">Home</a>
						<a href="userdetails.php?Action=edit">Modify User Details </a>
						<a href="matchreports.php">Match Reports </a>
						<a href="pictures.php">Picture Menu </a>
						<a href="distributionlists.php">My Email Lists </a>
						<a href="email.php">Send Email </a>						
EOD;
						
						
			if ($securitylevel != "5")
			{
				  $memberlinks =<<<EOD
					<a href="checkmatches.php">Check Your Fixtures </a> 
EOD;
			}
		}
		echo $links;
		if ($securitylevel == 4)
		{
			echo $memberlinks;
		}
		if ($securitylevel == 2)
		{
			echo $memberlinks;
			echo $committeelinks;
		}
		if ($securitylevel == 3)
		{
			echo $memberlinks;
			echo $tclinks;
		}
		if ($securitylevel == 1)
		{
			echo $memberlinks . "" . $committeelinks . "" . $tclinks . "" . $adminlinks;
		}
		$logout = "<a href=\"index.php?logout=1\">Logout </a></div>";
		echo $logout;
	}			
?>