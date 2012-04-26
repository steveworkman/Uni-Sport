<?php
// Class UserProfile extends Profile
require_once('class.Profile.php');

class UserProfile extends Profile {
	function __construct($id)
	{
		$usersql = 	'SELECT u.user_id, u.username, u.firstname, u.lastname, '.
					'u.dob, u.quote, u.male, u.user_email, u.phone, '.
					'positions.name, sides.name, u.degree, u.value, u.points, '.
					'u.user_regdate, u.user_posts, u.user_avatar, u.user_icq, '.
					'u.user_website, u.user_from, u.user_aim, u.user_yim, u.user_msnm, '.
					'u.user_occ, u.user_interests, u.archived, u.points, u.user_viewemail, '.
					'u.position, u.side, u.gay, u.user_sig, u.stayloggedin '.
					'FROM users AS u, sides, positions '.
					'WHERE u.user_id = '. $id .' '.
					'AND u.position = positions.position_id '.
					'AND u.side = sides.side_id';
		$result = mysql_query($usersql)
			or die(mysql_error());
		
		$row = mysql_fetch_array($result);
		$this->uid = $id;
		$this->username = $row['username'];
		$this->fname = $row['firstname'];
		$this->lname = $row['lastname'];
		$this->dob = $row['dob'];
		$this->quote = $row['quote'];
		$this->male = $row['male'];
		$this->email = $row['user_email'];
		$this->degree = $row['degree'];
		$this->position = $row[9];
		$this->side = $row[10];
		$this->position_id = $row['position'];
		$this->side_id = $row['side'];
		$this->active = $row['user_active'];
		$this->phone = $row['phone'];
		$this->fh_value = $row['value'];
		$this->fh_points = $row['points'];
		$this->regdate = $row['user_regdate'];
		$this->posts = $row['user_posts'];
		$this->avatar = $row['user_avatar'];
		$this->icq = $row['user_icq'];
		$this->website = $row['user_website'];
		$this->location = $row['user_from'];
		$this->aim = $row['user_aim'];
		$this->yim = $row['user_yim'];
		$this->msnm = $row['user_msnm'];
		$this->occ = $row['user_occ'];
		$this->interests = $row['user_interests'];
		$this->archived = $row['archived'];
		$this->view_email = $row['user_viewemail'];
		$this->cookie = $row['stayloggedin'];
		$this->gay = $row['gay'];
		$this->sig = $row['user_sig'];
	}
}
?>