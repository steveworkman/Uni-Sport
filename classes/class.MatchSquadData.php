<?php
/*
This is an object file for storing a piece of data containing a match_id, a UserID and a value marked Available.
It is only used once and very briefly in commitsquad.php however, it'll save me a lot of time cos the data manipulation
would be very server-heavy otherwise, and wouldn't always be right
*/

class matchsquaddata {
	var $matchid;
	var $userid;
	var $available;
	
	function matchsquaddata($mid, $uid, $avail)
	{
		$this->matchid = $mid;
		$this->userid = $uid;
		$this->available = $avail;
	}
	
	function getmatchid()
	{
		return $this->matchid;
	}
	
	function getuserid()
	{
		return $this->userid;
	}
	
	function getavailability()
	{
		return $this->available;
	}
}