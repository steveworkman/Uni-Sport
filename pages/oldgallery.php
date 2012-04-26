<center><h2>Gallery</h2>
		<?php
			$pic_q = "SELECT * FROM pictures";
			$pic_res = mysql_query($pic_q)
				or die(mysql_error());
			$count = mysql_num_rows($pic_res);
			
			if ($count == 0)
			{
				echo "There are no picture in the database";
			}
			else
			{
				echo "<table border=\"0\" class=\"tbl\" cellpadding=\"2\" cellspacing=\"1\">";
				if(empty($_GET['pg']))
					$base = 0;
				else
					$base = $_GET['pg'];
				
				$pic_query = "SELECT * FROM pictures LIMIT " . ($base*9) . ", 9";
				$pic_results = mysql_query($pic_query)
					or die(mysql_error());
				
				while ($pic_row = mysql_fetch_array($pic_results))
				{
					$pic_id[] = $pic_row['picture_id'];
					$pic_path[] = $pic_row['thumb'];
					$pic_comment[] = $pic_row['comment'];
				}
				$i = 0;
				for ($i=0; $i<sizeof($pic_id); $i +=3)
				{
					$j = 0;
					echo "<tr>";
					for ($j=0; $j<3; $j++)
					{
					list ($width, $height) = getimagesize($pic_path[$i+$j]);
						if ($pic_path[$i+$j] != '')
						{
							if ($width > $height)
							{
								$new_width = 135;
								$new_height = 102;
							}
							if ($width < $height)
							{
								$new_width = 102;
								$new_height = 135;
							}
							if ($width == $height)
							{
								$new_width = 135;
								$new_height = 135;
							}
							echo "<td>";
							echo "<a href=\"gallery.php?Page=showpicture&id=" . $pic_id[$i+$j] . "\" ><img src=\"" . $pic_path[$i+$j] . "\" alt=\"" . $pic_comment[$i+$j] . "\" width=\"" . $new_width . "\" height=\"" . $new_height . "\" border=\"0\"></a>";
							echo "</td>";
						}
					}
					echo "</tr>";
				}
				?>
				</table>
				Page 
				<?php
				for ($i=0; $i<($count/9); $i++)
				{
					echo "<a href=\"gallery.php?Page=oldgallery&pg=" . $i . "\">" . ($i+1) . " </a>";
				}
			}
			?>
			</center>