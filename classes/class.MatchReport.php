<?php
/* Match Report Class */
require_once('class.MatchBase.php');

class MatchReport extends MatchBase {
	public $id;
	public $report;
	public $score;
	public $hscore;
	public $oscore;
	public $motm;
	public $dotd;
	public $author;
	public $time;
	public $arc;
	
	function __construct($id)
	{
		if(empty($id))
			return;
		$this->id = $id;
		$query = 'SELECT * FROM matchreports AS m, playedmatches AS p, squads AS s '.
				'WHERE m.report_id = '.$this->id.' '.
				'AND p.report_id = '.$this->id.' '.
				'AND s.squad_id = p.squad_id';
		$result = mysql_query($query)
			or die(mysql_error());
		if (mysql_num_rows($result) == 0)
		{
			$query2 = 'SELECT * FROM matchreports AS m, playedmatches AS p, squadhistory AS s '.
					'WHERE m.report_id = '.$this->id.' '.
					'AND p.report_id = '.$this->id.' '.
					'AND s.squad_id = p.squad_id';
		
		$result = mysql_query($query2)
			or die(mysql_error());
		}
		if(mysql_num_rows($result) == 0)
			return;
		$row = mysql_fetch_array($result); // Should be only one result
		$this->report = $row['text'];
		$this->squadName = $row['name'];
		$this->opposition = $row['opposition'];
		$this->date = $row['date'];
		$this->time = $row['time'];
		$this->hscore = $row['home_score'];
		$this->oscore = $row['opp_score'];
		$this->score = $row['home_score'].' - '.$row['opp_score'];
		
		if ($row['friendly'] == 0)
			$friendly = '';
		else
			$friendly = " (Friendly)";
		$this->friendly = $friendly;
		
		$this->home_id = $row['home'];
		if ($row['home'] == 0)
			$home = "Away";
		else
			$home = "At Home";
		$this->home = $home;
		
		$this->arc = $row['archived'];
		$this->motm = $this->getName($row['motm']);
		$this->dotd = $this->getName($row['dotd']);
		$this->author = $this->getName($row['user_id']);
		$this->captain = $this->getName($row['captain']);
		$this->match_id = $row['match_id'];
	}
	
	/*
	 * Retrieves the squad for the current match
	 * Returns an array(array('link', 'name', 'id'))
	 */
	public function getSquad()
	{
		$data = array();
		if(empty($this->match_id))
			return $data;
		//Get the names of the squad
		$squad_query = 'SELECT u.username, u.user_id FROM playedmatch_user AS p, users AS u '.
						'WHERE p.match_id = '.$this->match_id.' '.
						'AND p.user_id = u.user_id '.
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
	 * Retrieves the scorers for the current match with the number of goals scored alongside their name
	 * Returns an array (array('link','name'))
	 * For a list of scorers including duplicates, use getScorerList()
	 */
	function getFormattedScorers()
	{
		$data = array();
		// get the match scorers
		$scorer_query = 'SELECT u.username, u.user_id FROM users AS u, scorers AS s '.
						'WHERE s.report_id = '.$this->id.' '.
						'AND s.user_id = u.user_id';
		$scorer_result = mysql_query($scorer_query)
			or die(mysql_error());
		if (mysql_num_rows($scorer_result) != 0)
		{
			while ($scorer_row = mysql_fetch_array($scorer_result))
			{
				$scorer[] = $scorer_row['username'];
				$scorerid[] = $scorer_row['user_id'];
			}
			
			$scorername = array_unique($scorer);
			$scorername = array_values($scorername);
			$scorernameid = array_unique($scorerid);
			$scorernameid = array_values($scorernameid);
			
			// Works out how many goals each person scored.
			// This could be done by SQL, but it's fine in PHP
			$goals = array();
			for ($r=0; $r<sizeof($scorername);$r++)
			{
				for ($s=0; $s<sizeof($scorer); $s++)
				{
					if ($scorer[$s] == $scorername[$r])
					{
						$goals[$r]++;
					}
				}
			}

			// print out nicely.
			for ($t=0;$t<sizeof($scorername);$t++)
			{
				$g = '';
				if ($goals[$t] >1)
				{
					$g = ' ('.$goals[$t].')';
				}
				$data[] = array('link'=>'viewprofile.php?action=view&amp;uid='.$scorernameid[$t],
								'name'=>$scorername[$t].$g);
			}
		}
		return $data;
	}
	
	/*
	 * Returns the scorers in a simple array, not formatted
	 * Made for use with match reports
	 * The same data can be returned multiple times (as many times as they scored
	 * returns array('id','name')
	 */
	public function getScorers()
	{
		$data = array();
		// get the match scorers
		$scorer_query = 'SELECT u.username, u.user_id FROM users AS u, scorers AS s '.
						'WHERE s.report_id = '.$this->id.' '.
						'AND s.user_id = u.user_id';
		$scorer_result = mysql_query($scorer_query)
			or die(mysql_error());
		while ($scorer_row = mysql_fetch_array($scorer_result))
		{
			$data[] = array('id'=>$scorer_row['user_id'],
							'name'=>$scorer_row['username']);
		}
		return $data;
	}
	
	/*
	 * Gets the names of those naughty people on yellow cards
	 * Returns an array(array('link', 'name'))
	 */
	function getYellowCards()
	{
		$data = array();	
		$y_query = 'SELECT username, users.user_id FROM ycards, users '.
					'WHERE ycards.report_id = '.$this->id.' '.
					'AND ycards.user_id = users.user_id';
		$y_result = mysql_query($y_query)
			or die(mysql_error());
		
		while ($y_row = mysql_fetch_array($y_result))
		{
			$data[] = array('link'=>'viewprofile.php?action=view&amp;uid='.$y_row['user_id'],
								'name'=>$y_row['username'],
								'id'=>$y_row['user_id']);
		}
		return $data;
	}
	
	/*
	 * Gets the names of those EXTREMELY naughty people on RED cards
	 * Returns an array(array('link', 'name'))
	 */
	function getRedCards()
	{
		$data = array();		
		$r_query = 'SELECT username, users.user_id FROM rcards, users '.
					'WHERE rcards.report_id = '.$this->id.' '.
					'AND rcards.user_id = users.user_id';
		$r_result = mysql_query($r_query)
			or die(mysql_error());
		
		while ($r_row = mysql_fetch_array($r_result))
		{
			$data[] = array('link'=>'viewprofile.php?action=view&amp;uid='.$r_row['user_id'],
								'name'=>$r_row['username'],
								'id'=>$r_row['user_id']);
		}
		return $data;
	}
	
}
?>