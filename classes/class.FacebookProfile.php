<?php
// Facebook Profile Class
require_once('class.Profile.php');

class FacebookProfile extends Profile{

	public $fb_id, $fb_error, $fb_friend;
	/*
	 * Creates a profile similar to the normal one but with data from Facebook
	 * Takes the $facebook Class and the $uid of the person we're looking at
	 */
	function __construct($facebook, $fbid, $uid)
    {
		$result = array();
		$this->fb_id = $fbid;
		$this->uid = $uid;
		$fields = array('first_name','last_name','pic','birthday','quotes','sex','interests');
		try {
			if ($facebook == null)
				throw new Exception("Facebook has not been initialised");
			$result = $facebook->api_client->users_getInfo($fbid,$fields);
			$this->fname = $result[0]['first_name'];
			$this->lname = $result[0]['last_name'];
			$this->avatar = $result[0]['pic'];
			$this->dob = $result[0]['birthday'];
			$this->quote = nl2br($result[0]['quotes']);
			$this->male = $result[0]['sex'];
			$this->interests = $result[0]['interests'];
			$this->fb_friend = $this->isFriend($facebook, $fbid);
		} catch(Exception $e) {
			// Set fb_error
			$this->fb_error = 'This profile is linked to a Facebook account. Please log in to see this information';
			// Oops, try and get the info out of the DB	
			$sql = 	'SELECT u.firstname, u.lastname, u.dob, u.quote, u.male, u.user_avatar, u.user_interests '.
						'FROM users AS u WHERE user_id='.$uid;
			$r = mysql_query($sql)
				or die(mysql_error());
			$result = mysql_fetch_array($r);
			$this->fname = $result['firstname'];
			$this->lname = $result['lastname'];
			$this->avatar = $result['user_avatar'];
			$this->dob = $result['dob'];
			$this->quote = nl2br($result['quote']);
			$this->male = $result['male'];
			$this->interests = $result['user_interests'];
		}
		
		
		// Then get the rest of the details
		$usersql = 	'SELECT u.username, u.user_email, u.phone, '.
					'positions.name, sides.name, u.degree, u.value, u.pointsmod, '.
					'u.user_regdate, u.user_posts, u.user_avatar, u.user_icq, '.
					'u.user_website, u.user_from, u.user_aim, u.user_yim, u.user_msnm, '.
					'u.user_occ, u.archived, u.points, u.user_viewemail, '.
					'u.position, u.side, u.gay, u.user_sig, u.stayloggedin '.
					'FROM users AS u, sides, positions '.
					'WHERE u.user_id = '. $uid .' '.
					'AND u.position = positions.position_id '.
					'AND u.side = sides.side_id';
		$res = mysql_query($usersql)
			or die(mysql_error());
		
		$row = mysql_fetch_array($res);
		$this->username = $row['username'];
		$this->email = $row['user_email'];
		$this->degree = $row['degree'];
		$this->position = $row[3];
		$this->side = $row[4];
		$this->position_id = $row['position'];
		$this->side_id = $row['side'];
		$this->active = $row['user_active'];
		$this->phone = $row['phone'];
		$this->fh_value = $row['value'];
		$this->fh_points = $row['points'];
		$this->regdate = $row['user_regdate'];
		$this->posts = $row['user_posts'];
		$this->icq = $row['user_icq'];
		$this->website = $row['user_website'];
		$this->location = $row['user_from'];
		$this->aim = $row['user_aim'];
		$this->yim = $row['user_yim'];
		$this->msnm = $row['user_msnm'];
		$this->occ = $row['user_occ'];
		$this->archived = $row['archived'];
		$this->view_email = $row['user_viewemail'];
		$this->cookie = $row['stayloggedin'];
		$this->gay = $row['gay'];
		$this->sig = $row['user_sig'];
    }
	
	/*
	 * Tests whether the currently logged in user is friends with $id
	 * returns true or false
	 */
	private function isFriend(Facebook $facebook, $id)
	{
		$user = array();
		$user[] = $facebook->user;
		$target = array();
		$target[] = $id;
		try {
			$result = $facebook->api_client->friends_areFriends($user,$target);
			if($result[0][are_friends] == 1)
				return 1;
			else
				return 0;
		} catch(Exception $e) {
			return 0;
		}
	}
}
?>