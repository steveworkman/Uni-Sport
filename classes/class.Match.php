<?php
/* Class Match extends MatchBase */
require_once('class.MatchBase.php');

class Match extends MatchBase{

	public $meettime;
	public $pushback;
	public $squad_id;
	public $desc;
	public $availability;
	
	/*
	 * This is meant to be a sub-class of the matchreport to deal wiht matches that have not yet taken place
	 * Creates a match
	 */
	function __construct($id)
	{
		if(empty($id))
			return;
		$this->match_id = $id;
		// get the match/squad first, then get the squad members later
		$query = 'SELECT * FROM matches, squads, users '.
					'WHERE matches.match_id ='.$this->match_id.' '.
					'AND matches.squad_id = squads.squad_id '.
					'AND squads.captain = users.user_id';
		$result = mysql_query($query)
			or die(mysql_error());
			
		if(mysql_num_rows($result) == 0)
		{
			$this->error = 'No such match';
			return;
		}		
			
		$row = mysql_fetch_array($result); // Should be only one result
		$this->squadName = $row['name'];
		$this->squad_id = $row['squad_id'];
		$this->opposition = $row['opposition'];
		$this->date = $row['date'];
		$this->meettime = $row['meettime'];
		$this->pushback = $row['pushback'];
		$this->desc = $row['details'];
		
		if ($row['friendly'] == 0)
			$friendly = 'No';
		else
			$friendly = "Yes";
		$this->friendly = $friendly;
		
		$this->home_id = $row['home'];
		if ($row['home'] == 0)
			$home = "Away";
		else
			$home = "Home";
		$this->home = $home;
		
		$this->captain = $this->getName($row['captain']);
		$this->availability = -1;

	}
	
	/*
	 * Retrieves the squad for the current match
	 * Returns an array(array('link', 'name', 'id'))
	 */
	public function getSquad()
	{
		$data = array();
		
		if(empty($this->match_id) || empty($this->squad_id))
			return $data;
		
		//Get the names of the squad
		$squad_query = 'SELECT u.username, u.user_id FROM match_squad AS m, users AS u '.
						'WHERE m.squad_id = '.$this->squad_id.' '.
						'AND m.match_id ='.$this->match_id.' '.
						'AND m.user_id = u.user_id '.
						'ORDER BY u.username';
		$squad_result = mysql_query($squad_query)
			or die(mysql_error());
		while ($squad_row = mysql_fetch_array($squad_result))
		{
			$data[] = array('link'=>'viewprofile.php?action=view&amp;uid='.$squad_row['user_id'],
							'name'=>$squad_row['username'],
							'id'=>$squad_row['user_id']);
		}
		return $data;
	}
	
	
	/*
	 * Retrieves the availablity for this match for this User ID
	 * Returns 0 for no, 1 for yes, -1 for unknown
	 */
	function getAvailability($user_id)
	{
		$query = 'SELECT available FROM match_squad '.
					'WHERE match_id = '.$this->match_id.' '.
					'AND squad_id = '.$this->squad_id.' '.
					'AND user_id = '.$user_id;
		$res = mysql_query($query)
			or die(mysql_error());
		$row = mysql_fetch_array($res);
		$this->availability = $row['available'];
		return $this->availability;
	}
}
?>