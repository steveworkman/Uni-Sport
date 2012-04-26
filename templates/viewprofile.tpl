<div id="main">
	<div id="content">
        <div align="center"><h1>Member Details</h1></div>
        {if isset($profile->fb_error)}
        <div class="error">{$profile->fb_error}</div>
        {/if}
        <img src="{$profile->avatar|default:'./img/avatar.jpg'}" alt="{$profile->username}" class="avatar" />
        <div class="left" style="width:72%;" >
        <table style="margin-left:10px; width: 100%;">
            {if isset($profile->fb_id)}
            {if $profile->fb_friend == 1}<tr><th colspan="2" class="succ">{$profile->username} is your friend!</th></tr>{else}<tr><th colspan="2"><a href="http://www.facebook.com/addfriend.php?id={$profile->fb_id}">Add {$profile->username} as your friend</a></th></tr>{/if}
            {/if}
            <tr><th colspan="2" align="left">General Details</th></tr>
                <tr>
                    <td>Nickname</td>
                    <td>{$profile->username}</td>
                </tr>
                <tr>
                    <td>Real Name</td>
                    <td>{$profile->fname} {$profile->lname}</td>
                </tr>
                <tr>
                    <td>Date of Birth</td>
                    <td>{$profile->dob|date_format}</td>
                </tr>
                <tr>
                    <td>Sex</td>
                    <td>{$profile->getSex()|capitalize}</td>
                </tr>
                <tr>
                    <td>Quote</td>
                    <td>{$profile->quote}</td>
                </tr>
                <tr>
                    <td>Degree</td>
                    <td>{$profile->degree}</td>
                </tr>
                <tr>
                    <td>Location</td>
                    <td>{$profile->location}</td>
                </tr>
                <tr>
                    <td>Interests</td>
                    <td>{$profile->interests}</td>
                </tr>
                <tr>
                    <td>Occupation</td>
                    <td>{$profile->occ}</td>
                </tr>
                <tr>
                    <td>Favoured Position</td>
                    <td>{$profile->side} {$profile->position}</td>
                </tr>
                <tr><td colspan="2">&nbsp;</td></tr>
            <tr><th colspan="2" align="left">Fantasy Hockey Details</th></tr>
                <tr>
                    <td>Value</td>
                    <td>&pound;{$profile->fh_value} Million</td>
                </tr>
                <tr>
                    <td>Current Points</td>
                    <td>{$profile->fh_points}</td>
                </tr>
                <tr>
                    <td>Owner of...</td>
                    <td><a href="{$profile->fh_team.link}">{$profile->fh_team.name}</a></td>
                </tr>
                <tr><td colspan="2">&nbsp;</td></tr>
            <tr><th colspan="2" align="left">Forum Details</th></tr>
                <tr>
                    <td>Date Registered</td>
                    <td>{$profile->regdate|date_format}</td>
                </tr>
                <tr>
                    <td>Post Count</td>
                    <td>{$profile->posts}</td>
                </tr>
                <tr><td colspan="2">&nbsp;</td></tr>
            <tr><th colspan="2" align="left">Contact Details</th></tr>
                <tr>
                    <td><img src="./img/icon_email.gif" border="0" alt="Email Address" title="Email Address" /></td>
                    <td>{mailto address=$profile->email encode=javascript}</td>
                </tr>
                {if $profile->website != ''}
                <tr>
                    <td><img src="./img/icon_www.gif" border="0" alt="Website Address" title="Website Address" /></td>
                    <td><a href="{$profile->website}">{$profile->website}</a></td>
                </tr>
                {/if}
                {if $profile->msnm != ''}
                <tr>
                    <td><img src="./img/icon_msnm.gif" border="0" alt="MSN Messenger" title="MSN Messenger" /></td>
                    <td>{$profile->msnm}</td>
                </tr>
                {/if}
                {if $profile->aim != ''}
                <tr>
                    <td><img src="./img/icon_aim.gif" border="0" alt="AOL Messenger" title="AOL Messenger" /></td>
                    <td>{$profile->aim}</td>
                </tr>
                {/if}
                {if $profile->yim != ''}
                <tr>
                    <td><img src="./img/icon_yim.gif" border="0" alt="Yahoo! Messenger" title="Yahoo! Messenger" /></td>
                    <td>{$profile->yim}</td>
                </tr>
                {/if}
                {if $profile->icq != ''}
                <tr>
                    <td><img src="./img/icon_icq.gif" border="0" alt="ICQ" title="ICQ" /></td>
                    <td>{$profile->icq}</td>
                </tr>
                {/if}
                {if $profile->phone != ''}
                <tr>
                    <td><img src="./img/icon_phone.gif" border="0" alt="Phone" title="Phone" /></td>
                    <td>{$profile->phone}</td>
                </tr>
                {/if}
            </table>
			</div>
            <div class="clear">
            <p align="center">
            	<a href="./gallery.php?uid={$profile->uid}">See more pictures of me</a>
            </p>
            {if isset($profile->fb_id)}
             <p align="center">
             	<a href="http://www.facebook.com/profile.php?id={$profile->fb_id}">View this profile on Facebook</a><br/>
             	<a href="http://www.facebook.com/profile.php?id={$profile->fb_id}"><img src="http://static.ak.facebook.com/images/go_home.gif" alt="Profile provided by Facebook"/></a>
            </p>
            
            {/if}
    	</div>
    </div>