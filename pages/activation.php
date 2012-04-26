<?php
if (SEC_LVL == 1)
{
	$query = 'SELECT user_id, fb_id, username, firstname, lastname, user_email '.
			'FROM users WHERE user_active = 0 AND user_id > 0 ORDER BY username';
	$result = mysql_query($query)
		or die(mysql_error());
	$pid = '';
	$data = array();
	$fb = array();
	$id = array();
	$i=0;
	while ($row = mysql_fetch_array($result))
	{
		$data[$i] = array('id'=>$row['user_id'],
						'name'=>$row['username'],
						'fname'=>$row['firstname'],
						'lname'=>$row['lastname'],
						'email'=>$row['user_email']);
		if($row['fb_id'] != 0)
		{
			$fb[] = $row['fb_id'];
			$id[] = $i;
		}
		$pid .= $row['user_id'] . ",";
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
	}
	
	
	$pid = substr($pid,0,(strlen($pid)-1));
	
	$smarty->assign('pid',$pid);
	$smarty->assign('inactive',$data);
	$smarty->display('activation.tpl');
}
else
{
	throw_error('AUTH');
}
?>