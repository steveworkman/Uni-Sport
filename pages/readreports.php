
		<?php
			
			
			// get pictures
			$pic_query = "SELECT pictures.picture_id, pictures.thumb, pictures.comment FROM pictures, playedmatch_pictures " .
							"WHERE playedmatch_pictures.report_id = '" . $_GET['report_id'] . "' " .
							"AND playedmatch_pictures.picture_id = pictures.picture_id";
			$pic_result = mysql_query($pic_query)
				or die(mysql_error());
			$picid = array();
			while ($pic_row = mysql_fetch_array($pic_result))
			{
				$picid[] = $pic_row['picture_id'];
				$picpath[] = $pic_row['thumb'];
				$piccomment[] = $pic_row['comment'];
			}

			
			?>
			<table border="1" cellpadding="2" cellspacing="1">
			<?php
			$i = 0;
				for ($i=0; $i<sizeof($picid); $i +=3)
				{
					$j = 0;
					echo "<tr>";
					for ($j=0; $j<3; $j++)
					{
					list ($width, $height) = getimagesize($picpath[$i+$j]);
						if ($picpath[$i+$j] != '')
						{
							if ($width > $height)
							{
								$new_width = 150;
								$new_height = 112.5;
							}
							if ($width < $height)
							{
								$new_width = 112.5;
								$new_height = 150;
							}
							if ($width == $height)
							{
								$new_width = 150;
								$new_height = 150;
							}
							echo "<td>";
							echo "<a href=\"gallery.php?Page=showpicture&amp;type=mid&val=".$_GET['report_id']."&amp;id=" . $picid[$i+$j] . "\"><img border=\"0\" src=\"" . $picpath[$i+$j] . "\" alt=\"" . $piccomment[$i+$j] . "\" width=\"" . $new_width . "\" height=\"" . $new_height . "\" /></a>";
							echo "</td>";
						}
					}
					echo "</tr>";
				}
				echo "</table>";
			}
			?>
	</center>
