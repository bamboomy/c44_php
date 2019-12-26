<?php

session_start();

?>


			<div class="container">
			  <img src="../imgz/grey.png" alt="Avatar" class="image">
			  <div class="overlay">
				<div class="text">Already taken</div>
			  </div>
			<div class="overlay_orig">
				<div class="text">Red</div>
			  </div>			
			  </div>		
			<div class="container">
			  <? echo "<a href='readyRoom.php?game=".$_SESSION['hash']."&color=yellow'><img src='../imgz/yellow.png' class='image'></a>"; ?>
			</div>					
			<div class="container">
			  <img src="../imgz/green.png" alt="Avatar" class="image">
			</div>		
			<div class="container">
			  <img src="../imgz/grey.png" alt="Avatar" class="image">
			  <div class="overlay">
				<div class="text">Already taken</div>
			  </div>
			<div class="overlay_orig">
				<div class="text">Blue</div>
			  </div>			
			</div>					
