<div id="navBar">
  <div class="relatedLinks"> 
	<h3>Recent Matches</h3> 
	<ul> 
	  <?php
	  getplayedmatches();
	  echo $playedmatches;
	  ?> 
	</ul> 
  </div> 
  <div class="relatedLinks"> 
	<h3>Recent Newsletters</h3> 
	<ul> 
	  <?php
	  getnewsletters();
	  echo $newsletters;
	  ?> 
	</ul> 
  </div>
  <div class="relatedLinks">
	<h3>Top Scorer</h3>
	<?php
	gettopscorer();
	?>
	The club's top scorer is:
	<ul>
		<?php
		echo $topscorer;
		?>
	</ul>
	</div>
	<div class="whitespace"></div>
	<div class="relatedLinks">
	<?php getrandomprofile(); ?>
	<a href="viewprofile.php">View all our members</a>
	</div>
</div>