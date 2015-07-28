<?php include("top.html"); ?>

<div class="container">	
<form action="addInfo-submit.php" method="POST" class="basic-grey">
	<!-- <fieldset> -->
	<h1> New User Signup </h1>
	<label>
			<span>Your Name:</span>	
			<input id="name" type="text" name="name" placeholder="Your Full Name" />
	</label>

	<label>
			<span>School Attending:</span>
			<select name="selection">	
				<option value="Yeshiva College">Yeshiva College</option>
				<option value="Sy Syms - YU">Sy Syms - YU</option>
				<option value="Stern College">Stern College</option>
				<option value="Sy Syms - Stern">Sy Syms - Stern</option>
				<option value="RIETS">RIETS</option>
				<option value="YU Grad-School">YU Grad-School</option>
				<option value="YU Alumni">YU Alumni</option>
				<option value="YU Faculty/Admin">YU Faculty/Admin</option>
				<option value="Non YU-student">Non YU-student</option>
			</select>
	</label>

	<label>
		<span>Your Email:</span>
		<input id="email" type="email" name="email" placeholder="Valid Email Address"/>
	</label>

	<label>
		<span>Ancestors Surname:</span>	
		<input id="surname" type="text" name="surname" placeholder="Surname wishing to be searched" />
	</label>		

	<!-- Script to predict address location -->		
	<?php include("geolocate.php"); ?>
		
	<label>	
		<span>Where did that family originate:</span>
		<input id="autocomplete" placeholder="Town in the old country" onFocus="geolocate()" type="text" name="town" />
	</label>

	<label>	
		<input type="submit" class="button" value="Submit" />
	</label>
	<!--</fieldset> -->
</form>
</div>
<?php include("bottom.html"); ?>