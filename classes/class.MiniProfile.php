<?php
// MiniProfile Class
require_once('class.Profile.php');
class MiniProfile extends Profile {
	public $link;
	public $imgwidth;
	public $imgheight;
	public $goals;
	public $hidden;
	
	function __construct($uid)
	{
		$this->id = $uid;
		$this->hidden = 0; // For use in sidebar only
		
		$profilequery = 'SELECT username, user_avatar, p.name, s.name, quote, points '.
						'FROM users, sides AS s, positions AS p '.
						'WHERE user_id='.$uid.' '.
						'AND user_id != -1 '.
						'AND side = s.side_id '.
						'AND position = p.position_id';
		$profileresult = mysql_query($profilequery)
			or die(mysql_error());
		while ($profilerow = mysql_fetch_array($profileresult))
		{
			$this->avatar = $profilerow['user_avatar'];
			$this->username = $profilerow['username'];
			$this->position = $profilerow[2];
			$this->side = $profilerow[3];
			$this->quote = stripslashes($profilerow['quote']);
			$this->points = $profilerow['points'];
		}
		// get the picture's size, so that portrait pictures don't look gay
		list ($width, $height) = getimagesize($this->avatar);
		if ($width > $height)
		{
			$imgw = 80;
			$imgh = 60;
		}
		if ($width < $height)
		{
			$imgw = 60;
			$imgh = 80;
		}
		if ($width == $height)
		{
			$imgw = 80;
			$imgh = 80;
		}
		$this->imgwidth = $imgw;
		$this->imgheight = $imgh;
		
		$this->link = './viewprofile.php?action=view&amp;uid='.$this->id;
		$this->goals = getGoals($uid);
	}
}
?>