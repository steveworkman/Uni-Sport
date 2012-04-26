<?php
// Manual Profile Class
require_once('class.Profile.php');

class ManualProfile extends Profile{

	public $fb_id;
	/*
	 * Creates a profile similar to the normal one but with data that we passed in ourself to replace any Facebook data
	 * Takes the $uid of the person, plus their
	 */
	function __construct($uid, $fb_id, $fname, $lname, $pic, $birthday, $quotes, $sex, $interests)
    {
		$this->uid = $uid;
		$this->fname = $fname;
		$this->lname = $lname;
		$this->avatar = $pic;
		$this->dob = $birthday;
		$this->quote = nl2br($quotes);
		$this->male = $sex;
		$this->interests = $interests;
		$this->fb_id = $fb_id;
		
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
	
}
?>