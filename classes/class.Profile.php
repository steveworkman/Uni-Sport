<?php
/* Profile Class */
class Profile {
	public $uid, $username, $fname, $lname, $email, $dob, $male;
	public $quote, $degree, $position, $side, $phone, $occ, $interests, $active, $avatar;
	public $fh_value, $fh_points, $fh_team;
	public $regdate, $posts, $website, $location;
	public $aim, $icq, $yim, $msnm;
	public $archived, $view_email;
	public $side_id, $position_id, $gay, $sig, $cookie;
	
	// Retrieves their fantasy hockey team
	function getFantasyTeam()
	{
		$this->fh_team = '';
		$query = 'SELECT name FROM fteams WHERE user_id = '.$this->uid;
		$res = mysql_query($query)
			or die(mysql_error());
		if (mysql_num_rows($res) != 0)
		{
			$r = mysql_fetch_array($res);
			$this->fh_team = array('link'=>'./fhockey.php?Page=myteam&id='.$this->uid,
									'name'=>$r['name']);
		}
	}
	
	// Returns male or female
	function getSex()
	{
		if(isset($this->fb_id) && !isset($this->fb_error))
			return $this->male;
		else if($this->male == 1)
			return 'Male';
		else
			return 'Female';
	}
	
	// Retrieves the status of the locks on the fantasy hockey config
	function getFHLocks()
	{
		$lq = 'SELECT * FROM fhockeyconfig WHERE name = "lockpositions"';
		$lres = mysql_query($lq)
			or die(mysql_error());
		$lrow = mysql_fetch_array($lres);
		return $lrow['value'];
	}
	
	// Returns the list of sides available - For forms
	function getSides()
	{
		$data = array();
		$sidequery = 'SELECT * FROM sides';
		$sideres = mysql_query($sidequery)
			or die(mysql_error());
		while ($siderow = mysql_fetch_array($sideres))
		{
			$data[$siderow['side_id']] = $siderow['name'];
		}
		return $data;
	}
	
	// Returns the list of positions available - For forms
	function getPositions()
	{
		$data = array();
		$sidequery = 'SELECT * FROM positions';
		$sideres = mysql_query($sidequery)
			or die(mysql_error());
		while ($siderow = mysql_fetch_array($sideres))
		{
			$data[$siderow['position_id']] = $siderow['name'];
		}
		return $data;
	}
}
?>