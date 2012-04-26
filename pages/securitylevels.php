<?php
	if($_SESSION['shef_hockey_user_securitylevel'] == 1)
	{
?>
		<center>
		<h2>Securitly Levels</h2></center>
		<p>
		Below are the usergroups on the forums. These group ids need to be assigned to a security level so that proper access rights occur in the main site.<br /><br />
		It should be noted that the "masses" are not assigned to a group and their security level is "4"<br /><br />
		The top two groups: <strong>Anonymous</strong> and <strong>Admin</strong> should not be set to a security level as these groups are for single people only i.e. a "guest" user called anonymous and the board's creator<br /><br />
		Old boys and girls have a separate field called "archived" which can be set from the manage members page or individually on their own profiles</p>
		<p>
		<div style="width:40%; float:right"><table cellpadding="2" cellspacing="2" border="1">
		<tr><th>Group Name</th><th>Group ID</th></tr>
		<?php
		//Need to get the current groups available
		$gquery = "SELECT group_id, group_name FROM groups";
		$gres = mysql_query($gquery)
			or die(mysql_error());
		while ($grow = mysql_fetch_array($gres))
		{
			echo "<tr>";
				echo "<td>".$grow['group_name']."</td>";
				echo "<td>".$grow['group_id']."</td>";
			echo "</tr>";
		}
		?>
		</table></div>
		<div style="width:60%; float:left">
		<form action="./commit/commitsecuritylevels.php" method="post">
		<table cellpadding="2" cellspacing="2" border="0">
		<?php
			// Need to get the current set levels
			$sq = "SELECT * FROM securitylevels";
			$sres = mysql_query($sq)
				or die(mysql_error());
			
			while ($srow = mysql_fetch_array($sres))
			{
				echo "<tr>";
					echo "<td><strong>".$srow['name']."</strong></td>";
					echo "<td><input type=\"text\" name=\"".$srow['securitylevel_id']."\" value=\"".$srow['group_id']."\" size=\"2\" /></td>";
				echo "</tr>";
			}
		?>
		</table>
		</div>
		<input name="submit" type="submit" value="Submit" />
		</form>
		</p>
	<?php
	}
	else
	{
		echo "You are not authorised to access this function";
	}
?>