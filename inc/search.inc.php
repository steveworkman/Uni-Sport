<table border="0" cellpadding="0">
<tr>
<td>
<?php 	if (empty($_SESSION['shef_hockey_user_logged']))
			echo "<a href=\"./forum/profile.php?mode=sendpassword\">Lost Password? </a>";
		else
			echo "&nbsp;";
?>
</td>
<td>
<form method="get" action="http://www.google.com/custom">
<input type="text"  name="q" size="10" maxlength="255" value="" />
          <input type="submit"  name="btnG" value="Search" />
          <input type="hidden" name="cof" value="L:http://www.sheffieldhockey.com/shef_logo.gif;AH:center;GL:0;" />
          <font size="-1">
          <input type="hidden" name="domains" value="www.sheffieldhockey.com" />
          <input type="hidden" name="sitesearch" value="www.sheffieldhockey.com" checked="checked" />
        </font>
</form>
</td>
</tr>
</table>