<?php
// MiniProfile Class
require_once('class.Profile.php');
class MiniFacebookProfile extends Profile {
	public $link;
	public $goals;
	public $hidden;
	public $fb_id;
	public $fb_error;
	
	function __construct($facebook, $fbid, $uid)
	{
		$this->uid = $uid;
		$this->hidden = 0; // For use in sidebar only
		
		$result = array();
		$this->fb_id = $fbid;
		$this->uid = $uid;
		$fields = array('first_name','last_name','pic_square','quotes');
		try {
			if ($facebook == null)
				throw new Exception("Facebook has not been initialised");
			$result = $facebook->api_client->users_getInfo($fbid,$fields);
			$this->fname = $result[0]['first_name'];
			$this->lname = $result[0]['last_name'];
			$this->avatar = $result[0]['pic_square'];
			$this->quote = $result[0]['quotes'];
		} catch(Exception $e) {
			// Set fb_error
			$this->fb_error = 'This profile is linked to a Facebook account. Please log in to see this information';
			// Oops, try and get the info out of the DB	
			$sql = 	'SELECT u.firstname, u.lastname, u.quote, u.user_avatar '.
						'FROM users AS u WHERE user_id='.$uid;
			$r = mysql_query($sql)
				or die(mysql_error());
			$result = mysql_fetch_array($r);
			$this->fname = $result['firstname'];
			$this->lname = $result['lastname'];
			$this->avatar = $result['user_avatar'];
			$this->quote = nl2br($result['quote']);
		}
		
		
		$profilequery = 'SELECT username, p.name, s.name, points '.
						'FROM users, sides AS s, positions AS p '.
						'WHERE user_id='.$uid.' '.
						'AND user_id != -1 '.
						'AND side = s.side_id '.
						'AND position = p.position_id';
		$profileresult = mysql_query($profilequery)
			or die(mysql_error());
		while ($profilerow = mysql_fetch_array($profileresult))
		{
			$this->username = $profilerow['username'];
			$this->position = $profilerow[1];
			$this->side = $profilerow[2];
			$this->points = $profilerow['points'];
		}
		
		$this->link = './viewprofile.php?action=view&amp;uid='.$this->uid;
		$this->goals = getGoals($uid);
	}
}
?>