<?php
include ("inc/cal_constants.inc.php");
/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
*/
require_once "class.Calendar.php";
/**
* Displays events in a given month.
*
* @author Oscar Merida <oscarAtoscarm.org>
* @created Jan 18 2004
* @package  goCoreLib
*/

/*
* This class has been modified to suit Sheffield University Hockey Club's needs
* by Steven Workman AKA Girder. Mostly because it didn't work in a table CSS structure.
*/
class Calendar_Events extends Calendar {
   
function dspDayCell ( $day )
{
    if ( $events = $this->getDaysEvents( $day ) )
    {
?>
    <td><?=$day?>
	<ul>
<?php     
    foreach ( $events as $i=>$e )
    {
		if($e['arc'] == 1)
			echo '<li class="arc" style="display:none">';
		else if ($e['arc'] == 2)
			echo '<li class="arc">';
		else
			echo '<li>';
		switch($e['type'])
		{
			case MATCH:
?>      		<a href="<?=$e['link']?>"><span class="green"><?=$e['title']?></span></a></li>
<?			break;
			case EVENT:
?>      		<a href="<?=$e['link']?>"><span class="red"><?=$e['title']?></span></a></li>
<?			break;
			case BDAY:
?>      		<a href="<?=$e['link']?>"><span class="blue"><?=$e['title']?></span></a></li>
<?			break;
		}
    }
?></ul> 
</td>
<?  } else { ?>
    <td><?=$day?></td>
<?php
    } // end if
}

/**
* Finds events from the database
*
*@return event
*@private
*/

/**
* Adds an event on a day
*
* @return
* @public
*/
function addEvent ( $day, $title, $link='', $arc, $type)
{
    $this->events[ (int)$day ][] = array( 'title' =>$title, 'link'=>$link, 'arc'=>$arc, 'type'=>$type );
}

// ==== end addEvent ================================================

/**
* Returns an array of the events on a day.
*
* @return
* @public
*/
function getDaysEvents($day)
{
    if ( sizeof( $this->events[$day] ) > 0 )
    {
        return $this->events[$day];
    } else {
        return FALSE;   
    }
}
// ==== end getDaysEvents ================================================

} // end class
?>