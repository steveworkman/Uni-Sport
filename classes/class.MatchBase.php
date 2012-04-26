<?php
/* Abstract class Matchbase */

abstract class MatchBase {

	public $match_id;
	public $squadName;
	public $opposition;
	public $date;
	public $home;
	public $home_id;
	public $friendly;
	public $captain;
	public $error;

	abstract public function getSquad();
	
	// Returns array('link', 'name') for a given UID. The link goes to their profile
	public function getName($uid)
	{
		$data = '';
		// get secondary details (like people's names instead of id's)
		$query = 'SELECT username, user_id FROM users WHERE user_id = '.$uid;
		$result = mysql_query($query)
			or die(mysql_error());
		if (mysql_num_rows($result) != 0)
		{
			$row = mysql_fetch_array($result);
			$data = array('link'=>'viewprofile.php?action=view&amp;uid='.$row['user_id'],
							'name'=>$row['username'],
							'id'=>$row['user_id']);
		}
		return $data;
	}
}
?>