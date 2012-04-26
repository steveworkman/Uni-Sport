<?php
function checkmatches($uid)
{
	$query = "SELECT Available, Date FROM match_squad LEFT JOIN matches ON matches.match_id = match_squad.match_id " .
				"WHERE match_squad.user_id = '" . $_SESSION['shef_hockey_user_id'] . "' " .
				"AND Available = '-1' " .
				"AND Date >= NOW()";
	$res = mysql_query($query)
		or die(mysql_error());
	$mcount = mysql_num_rows($res);
	if ($mcount == 0)
	{
		echo '';
	}
	else
	{
		echo "<h6>You have been selected for " . $mcount . " match(es)</h6>";
	}
}
?>

<div class="search">
  <?php
  	if ($_COOKIE['username'] != '' || $_COOKIE['user_password'] != '')
	{
		if ((!isset($_GET['logout'])) || ($_GET['logout'] != 1))
		{
		$loginquery = 	"SELECT users.user_id, users.username, users.UserGroup, users.user_password, " .
						"users.user_active, usergroups.SecurityLevel, users.StayLoggedIn FROM users, usergroups " .
						"WHERE users.username = '" . $_COOKIE['username']. "'" .
						"AND users.user_password = '" . $_COOKIE['user_password'] . "' " .
						"AND usergroups.UserGroupID = users.UserGroup";
		$loginresult = mysql_query($loginquery)
			or die(mysql_error());
			
			if (mysql_num_rows($loginresult) == 1)
			{
				$loginrow = mysql_fetch_array($loginresult);
				$uid = $loginrow['user_id'];
				$securitylvl = $loginrow['SecurityLevel'];
				$usrgrp = $loginrow['UserGroup'];
				
				// Set Session
				$_SESSION['shef_hockey_user_id'] = $uid;
				$_SESSION['shef_hockey_user_logged'] = $loginrow['username'];
				$_SESSION['user_user_password'] = $_POST['userpass'];
				$_SESSION['user_group'] = $usrgrp;
				$_SESSION['shef_hockey_user_securitylevel'] =  $securitylvl;
				
				echo "<td>Welcome back " . $_SESSION['shef_hockey_user_logged'] . "</td>";
				//checkmatches($_SESSION['shef_hockey_user_id']);
				echo "<a href=\"index.php?logout=1\">Log Out</a>";
			}
		}
	}
	if (isset($_POST['Submit']))
  	{
  		$loginquery = 	"SELECT users.user_id, users.username, users.UserGroup, users.user_password, " .
						"users.user_active, usergroups.SecurityLevel, users.StayLoggedIn FROM users, usergroups " .
						"WHERE users.username = '" . $_POST['username']. "'" .
						"AND users.user_password = '" . $_POST['userpass'] . "' " .
						"AND usergroups.UserGroupID = users.UserGroup";
		$loginresult = mysql_query($loginquery)
			or die(mysql_error());
			
		if (mysql_num_rows($loginresult) == 1)
		{
			$loginrow = mysql_fetch_array($loginresult);
			if ($loginrow['user_active'] == 0)
			{
				?>
			<h6>Your user account is not yet user_active. Please contact the administrator</h6>
			
			<form action="index.php" method="post">
				Username:
				<input name="username" type="text" size="10"></input>
				Password:
				<input name="userpass" type="user_password" size="10"></input> 
				<input name="redirect" type="hidden" value="<?php echo $_POST['redirect']; ?>">
				<input name="Submit" type="submit" value="Login  "></input>
	  		</form>
		<?php
			}
			else
			{
				$uid = $loginrow['user_id'];
				$securitylvl = $loginrow['SecurityLevel'];
				$usrgrp = $loginrow['UserGroup'];
				
				// Set Session
				$_SESSION['shef_hockey_user_id'] = $uid;
				$_SESSION['shef_hockey_user_logged'] = $loginrow['username'];
				$_SESSION['user_user_password'] = $_POST['userpass'];
				$_SESSION['user_group'] = $usrgrp;
				$_SESSION['shef_hockey_user_securitylevel'] =  $securitylvl;
				
				// Set Cookies (if set in db)
				if ($loginrow['StayLoggedIn'] == 1)
				{
					setcookie('username', $loginrow['username'], time() + 60 * 60 * 24 * 365);
					setcookie('user_password', $_POST['userpass'], time() + 60 * 60 * 24 * 365);
				}
				
				echo "<h3>Welcome back " . $_SESSION['shef_hockey_user_logged'] . "</h3>";
				//checkmatches($_SESSION['shef_hockey_user_id']);
				echo "<a href=\"index.php?logout=1\">Log Out</a>";
			}
		}
		else
		{
			?>
			<h6>Invalid Username and/or user_password</h6><br />
			<form action="index.php" method="post">
				Username: 
				<input name="username" type="text" size="10"></input> 
				Password: 
				<input name="userpass" type="user_password" size="10"></input> 
				<input name="redirect" type="hidden" value="<?php echo $_POST['redirect']; ?>">
				<input name="Submit" type="submit" value="Login  "></input>
	  		</form>
		<?php
		}
	}
	else
	{
		if ((isset($_GET['logout'])) || ($_GET['logout'] == 1))
		{
			// Empty session
			$_SESSION['shef_hockey_user_id'] = "";
			$_SESSION['shef_hockey_user_logged'] = "";
			$_SESSION['user_user_password'] = "";
			$_SESSION['user_group'] = "";
			$_SESSION['shef_hockey_user_securitylevel'] = "";
			
			// Empty Cookies
			setcookie('username', '', time()-60);
			setcookie('user_password', '', time()-60);
			?>
			Thanks for visiting
			<?php
		}
		if ($_SESSION['shef_hockey_user_logged'] != "" && $_COOKIE['username'] == '' && $_COOKIE['user_password'] == '')
		{
			echo "<h3>Welcome back " . $_SESSION['shef_hockey_user_logged'] . "</h3>";
			//checkmatches($_SESSION['shef_hockey_user_id']);
			echo "<a href=\"index.php?logout=1\">Log Out</a>";
		}
		else
		{
			if (isset($_GET['redirect']))
			{
				$redirect = $_GET['redirect'];
			}
			else
			{
				$redirect = "index.php";
			}
			if ($_COOKIE['username'] == '' && $_COOKIE['user_password'] == '')
			{
				?>
				<form action="index.php" method="post">
					Username: 
					<input name="username" type="text" size="10"> 
					Password:
					<input name="userpass" type="user_password" size="10"> 
					<input name="redirect" type="hidden" value="<?php echo $_POST['redirect']; ?>">
					<input name="Submit" type="submit" value="Login  ">
				</form>
				<?php
			}
			if (((isset($_GET['logout'])) || ($_GET['logout'] == 1)) && ($_COOKIE['username'] != '' && $_COOKIE['user_password'] != ''))
			{
				?>
				<form action="index.php" method="post">
					Username:
					<input name="username" type="text" size="10"> 
					Password:
					<input name="userpass" type="user_password" size="10"> 
					<input name="redirect" type="hidden" value="<?php echo $_POST['redirect']; ?>">
					<input name="Submit" type="submit" value="Login  ">
				</form>
				<?php
			}
		}
	}
	?>
</div>