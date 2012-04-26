<?php
function sortProfiles($a,$b)
{
	return strcmp($a->username, $b->username);
}

if (SEC_LVL == 1)
{
	switch($_GET['action'])
	{
		case 'add':
			$smarty->assign('error',urldecode($_GET['error']));
			if ($_GET['succ'] == 1)
			{
				$smarty->assign('succ','An activation email was successfully sent');
			}
			$smarty->display('addmember.tpl');
		break;
		
		default:
			$data = array();
			$fbids = array();
			$fbuids = array();
			$query = 'SELECT user_id, fb_id FROM users ORDER BY username DESC';
			$res = mysql_query($query)
				or die(mysql_error());
			while($row = mysql_fetch_array($res))
			{
				if($row['fb_id'] != 0)
				{
					$fbids[] = $row['fb_id'];
					$fbuids[] = $row['user_id'];
				}
				else
				{
					$data[] = new UserProfile($row['user_id']);
				}
				$id .= $row['user_id'] . ",";
			}
			// Get the facebook data
			$fields = array('first_name','last_name','pic','birthday','quotes','sex','interests');
			try {
				$res = $facebook->api_client->users_getInfo($fbids,$fields);
				if(!empty($res))
				{
					for ($j=0; $j<sizeof($res); $j++)
					{
						$data[] = new ManualProfile($fbuids[$j],$fbids[$j],$res[$j]['first_name'],$res[$j]['last_name'],
													$res[$j]['pic'],$res[$j]['birthday'],$res[$j]['quotes'],$res[$j]['sex'],
													$res[$j]['interests']);
					}
				}
			} catch(Exception $e) {
				echo $e;
			}
			usort($data,"sortProfiles");
			
			// This way caused loads of errors with facebook. The new way is probably just as inefficient, but it gets it done
			/*$query = 'SELECT user_id, fb_id, username, firstname, lastname, user_regdate, archived, user_email, phone FROM users '.
				'WHERE user_id > 0 '.
				'ORDER BY username';
			$result = mysql_query($query)
				or die(mysql_error());
			
			$id = '';
			$data = array();
			$fb = array();
			$ids = array();
			$i=0;
			while ($row = mysql_fetch_array($result))
			{
				$data[] = array('id'=>$row['user_id'],
								'link'=>'memberpages.php?Page=userdetails&Action=edit&user_id='.$row['user_id'],
								'name'=>$row['username'],
								'fname'=>$row['firstname'],
								'lname'=>$row['lastname'],
								'regdate'=>$row['user_regdate'],
								'arc'=>$row['archived'],
								'email'=>$row['user_email'],
								'phone'=>$row['phone']);
				if($row['fb_id'] != 0)
				{
					$fb[] = $row['fb_id'];
					$ids[] = $i;
				}
				$id .= $row['user_id'] . ",";
				$i++;
			}
			$fields = array('first_name','last_name');
			try {
				$res = $facebook->api_client->users_getInfo($fb,$fields);
				if(!empty($res))
				{
					for ($j=0; $j<sizeof($res); $j++)
					{
						$data[$id[$j]]['fname'] = $res[$j]['first_name'];
						$data[$id[$j]]['lname'] = $res[$j]['last_name'];
					}
				}
			} catch(Exception $e) {
				echo $e;
			}*/
			
			SmartyPaginate::setTotal(count($data));
			$data = array_slice($data, SmartyPaginate::getCurrentIndex(),SmartyPaginate::getLimit());
			$id = substr($id,0,(strlen($id)-1));
			$smarty->assign('members',$data);
			$smarty->assign('ids',$id);
			$smarty->assign('next',$_GET['next']);
			SmartyPaginate::setUrl('adminpages.php?Page=managemembers');
			SmartyPaginate::assign($smarty); // For pagination
			$smarty->display('managemembers.tpl');
			SmartyPaginate::disconnect();
		break;
	} //end switch
} // end if
else
{
	throw_error('AUTH');
}
?>