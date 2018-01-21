<!DOCTYPE html>
<?php
    include 'header.php';
?>

<form action="view.php" method="get">
	Date: <input id="datepicker" type="text" name="date"/><br/>
	Name: <input id="name" type="text" name="name"/><br/>
	Rating: <input type="hidden" id="rating" name="rating"/><br/>
	<!-- TODO: JS -star ratng: https://www.w3schools.com/howto/howto_css_star_rating.asp -->
		<div class="rating rating2"><!-- TODO: tidy up css so this can just have one class
		--><a href="#5" title="Give 5 stars" onclick="rateSake(5);">★</a><!--
		--><a href="#4" title="Give 4 stars" onclick="rateSake(4);">★</a><!--
		--><a href="#3" title="Give 3 stars" onclick="rateSake(3);">★</a><!--
		--><a href="#2" title="Give 2 stars" onclick="rateSake(2);">★</a><!--
		--><a href="#1" title="Give 1 star" onclick="rateSake(1);">★</a>
	</div>
	Venue: <select id="venue" name="venue">
		<?php
			//Connect to the DB
			include 'db.inc.php';
			
			//Select the venues from the database
			$sql='SELECT DISTINCT venue FROM Entries ORDER BY venue';					
			$result = mysqli_query($link, $sql);
			if (!$result) { 									
				$error = 'Error fetching data: ' . mysqli_error($link);
				echo $error; 
				exit();				
			}
			echo "<option value=''> -- </option>";
			while($recording=mysqli_fetch_array($result)){
				$sake_id=htmlspecialchars($recording['sakeID'], ENT_QUOTES, 'UTF-8');						
				$venue_name=htmlspecialchars($recording['venue'], ENT_QUOTES, 'UTF-8');
				echo "<option value=$venue_name>" . " ". $venue_name. "</option>";
			}
		?>
    </select>
    <br/>
	
	Prefecture: <select id="prefecture" name="prefecture">
		<?php
			//Connect to the DB
			include 'db.inc.php';
			
			//Select the prefecture names from the database
			$sql='SELECT name, region FROM Prefecture ORDER BY name';					
			$result = mysqli_query($link, $sql);
			if (!$result) { 									
				$error = 'Error fetching data: ' . mysqli_error($link);
				echo $error; 
				exit();				
			}
			echo "<option value=''> -- </option>";
			while($recording=mysqli_fetch_array($result)){
				$name=htmlspecialchars($recording['name'], ENT_QUOTES, 'UTF-8');
				$region=htmlspecialchars($recording['region'], ENT_QUOTES, 'UTF-8');
				echo "<option value=$name>" . " ". $name . "</option>";
			}
		?>
    </select>
    <br/>
	Region: <input id="region" type="text" name="region" readonly/><br/>
	Other Location: <input id="location" type="text" name="location"/><br/>
	Brewery: <input id="brewery" type="text" name="brewery"/><br/>
	Alcohol %: <input id="alcohol" type="number" name="alcohol" step="0.1" min="0" /><br/>
	Sake Meter Value (SMV): <input id="smv" type="number" name="smv" min="-15" min="15" /><br/>
	Acidity: <input id="acidity" type="number" name="acidity" step="0.1" min="1" min="2" /><br/>
	Yeast: <input id="yeast" type="number" name="yeast" min="0" /><br/>
	Rice: <select id="rice" name="rice"/><br/>
		<?php
			//Connect to the DB
			include 'db.inc.php';
			
			//Select the rices from the database
			$sql='SELECT DISTINCT rice FROM Entries ORDER BY rice';					
			$result = mysqli_query($link, $sql);
			if (!$result) { 									
				$error = 'Error fetching data: ' . mysqli_error($link);
				echo $error; 
				exit();				
			}
			echo "<option value=''> -- </option>";
			while($recording=mysqli_fetch_array($result)){
				$sake_id=htmlspecialchars($recording['sakeID'], ENT_QUOTES, 'UTF-8');
				$rice=htmlspecialchars($recording['rice'], ENT_QUOTES, 'UTF-8');
				echo "<option value=$rice>" . " ". $rice . "</option>";
			}
		?>
    </select>
    <br/>
	Rice Milling %: <input id="milling" type="number" name="milling" min="0" /><br/>
	
	Serving Temperature: <select id="temp" name="temp"/><br/>
		<?php
			//Connect to the DB
			include 'db.inc.php';
			
			//Select the rices from the database
			$sql='SELECT DISTINCT temp FROM Entries ORDER BY temp';					
			$result = mysqli_query($link, $sql);
			if (!$result) { 									
				$error = 'Error fetching data: ' . mysqli_error($link);
				echo $error; 
				exit();				
			}
			echo "<option value=''> -- </option>";
			while($recording=mysqli_fetch_array($result)){
				$sake_id=htmlspecialchars($recording['sakeID'], ENT_QUOTES, 'UTF-8');
				$temp=htmlspecialchars($recording['temp'], ENT_QUOTES, 'UTF-8');
				echo "<option value=$temp>" . " ". $temp . "</option>";
			}
		?>
    </select>
    <br/>
	
	Classification: <select id="classification" name="classification"/><br/>
		<?php
			//Connect to the DB
			include 'db.inc.php';
			
			//Select the classifications from the database
			$sql='SELECT DISTINCT classification FROM Entries ORDER BY classification';					
			$result = mysqli_query($link, $sql);
			if (!$result) { 									
				$error = 'Error fetching data: ' . mysqli_error($link);
				echo $error; 
				exit();				
			}
			echo "<option value=''> -- </option>";
			while($recording=mysqli_fetch_array($result)){
				$sake_id=htmlspecialchars($recording['sakeID'], ENT_QUOTES, 'UTF-8');
				$classification=htmlspecialchars($recording['classification'], ENT_QUOTES, 'UTF-8');
				echo "<option value=$classification>" . " ". $classification . "</option>";
			}
		?>
    </select>
    <br/>
	Style: <select id="style" name="style"/><br/>
		<?php
			//Connect to the DB
			include 'db.inc.php';
			
			//Select the classifications from the database
			$sql='SELECT DISTINCT style FROM Entries ORDER BY style';					
			$result = mysqli_query($link, $sql);
			if (!$result) { 									
				$error = 'Error fetching data: ' . mysqli_error($link);
				echo $error; 
				exit();				
			}
			echo "<option value=''> -- </option>";
			while($recording=mysqli_fetch_array($result)){
				$sake_id=htmlspecialchars($recording['sakeID'], ENT_QUOTES, 'UTF-8');
				$style=htmlspecialchars($recording['style'], ENT_QUOTES, 'UTF-8');
				echo "<option value=$style>" . " ". $style . "</option>";
			}
		?>
    </select>
    <br/>
	
	Served In: <br/>
	<div class="radio-group">
		<input type="radio" id="Masu" name="vessel" value="Masu"/>
			<label for="Masu">
    			<img src="images/masu.png" alt="Masu" style="width:100px;height:100px;text-align:center">
  				<div style="text-align:center">Masu</div></br>
			</label>
		<input type="radio" id="Tulip" name="vessel" value="Tulip"/>
			<label for="Tulip">
    			<img src="images/masu.png" alt="Tulip" style="width:100px;height:100px;text-align:center">
  				<div style="text-align:center">Tulip</div></br>
			</label>
		<input type="radio" id="Footed" name="vessel" value="Footed"/>
			<label for="Footed">
    			<img src="images/masu.png" alt="Footed" style="width:100px;height:100px;text-align:center">
  				<div style="text-align:center">Footed</div></br>
			</label>
		<input type="radio" id="Guinomi" name="vessel" value="Guinomi"/>
			<label for="Guinomi">
	    		<img src="images/masu.png" alt="Guinomi" style="width:100px;height:100px;text-align:center">
	  			<div style="text-align:center">Guinomi</div></br>
			</label>
		<input type="radio" id="Sakazuki" name="vessel" value="Sakazuki"/>
			<label for="Sakazuki">
    			<img src="images/masu.png" alt="Sakazuki" style="width:100px;height:100px;text-align:center">
  				<div style="text-align:center">Sakazuki</div></br>
			</label>
		<input type="radio" id="Wine" name="vessel" value="Wine"/>
			<label for="Wine">
    			<img src="images/masu.png" alt="Wine" style="width:100px;height:100px;text-align:center">
  				<div style="text-align:center">Wine</div></br>
			</label>
		<input type="radio" id="Flute" name="vessel" value="Flute"/>
			<label for="Flute">
    			<img src="images/masu.png" alt="Flute" style="width:100px;height:100px;text-align:center">
  				<div style="text-align:center">Flute</div></br>
			</label>
		<input type="radio" id="Sherry" name="vessel" value="Sherry"/>
			<label for="Sherry">
    			<img src="images/masu.png" alt="Sherry" style="width:100px;height:100px;text-align:center">
  				<div style="text-align:center">Sherry</div></br>
			</label>
		<input type="radio" id="Ochoko" name="vessel" value="Ochoko"/>
			<label for="Ochoko">
	    		<img src="images/masu.png" alt="Ochoko/Kikichoko" style="width:100px;height:100px;text-align:center">
	  			<div style="text-align:center">Ochoko/</div>
	  			<div style="text-align:center">Kikichoko</div>
			</label>
		<input type="radio" id="Other" name="vessel" value="Other" CHECKED/>
			<label for="Other">
    			<img src="images/masu.png" alt="Other" style="width:100px;height:100px;text-align:center">
  				<div style="text-align:center">Other</div></br>
			</label>
  </div>
	<br/>

	Notes: <textarea id="notes" name="notes" rows="10" cols="40"></textarea><br/>
	<input type="submit" value="Search"/>
</form>

<?php
	// error logging
	error_reporting(-1);
?>

<?php
    include 'sidebar.php';
	include 'footer.php';
?>
