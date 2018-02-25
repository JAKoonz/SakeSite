<!DOCTYPE html>
<?php
    include 'header.php';
?>
<?php
    //Connect to the DB
    include 'db.inc.php';
    
    //Fetch some data to pre-load the form
    $sakeID = htmlspecialchars($_GET["sakeID"]);
	$sql="SELECT Entries.*, Prefecture.region
				FROM  Entries INNER JOIN Prefecture
				ON Entries.prefecture_fk=Prefecture.name
				WHERE sakeID='" . $sakeID . "'";
	$result = mysqli_query($link, $sql);
	if (!$result) { 	
			$error = 'Error retrieving data for this entry: ' . mysqli_error($link);	
			echo $error; 	
		exit();
	}
    
    //Name the variables and save them to use later
	$recording=mysqli_fetch_array($result);
	$date=htmlspecialchars($recording['date'], ENT_QUOTES, 'UTF-8');
	$name = htmlspecialchars($recording['name'], ENT_QUOTES, 'UTF-8');
	$rating = htmlspecialchars($recording['rating'], ENT_QUOTES, 'UTF-8');
	$venue = htmlspecialchars($recording['venue'], ENT_QUOTES, 'UTF-8');
	$prefecture = htmlspecialchars($recording['prefecture_fk'], ENT_QUOTES, 'UTF-8');
	$region = htmlspecialchars($recording['region'], ENT_QUOTES, 'UTF-8');
	$location = htmlspecialchars($recording['otherLocation'], ENT_QUOTES, 'UTF-8');
	$brewery = htmlspecialchars($recording['brewery'], ENT_QUOTES, 'UTF-8');
	$alcohol = htmlspecialchars($recording['alcohol'], ENT_QUOTES, 'UTF-8');	
	$smv = htmlspecialchars($recording['smv'], ENT_QUOTES, 'UTF-8');
	$acidity = htmlspecialchars($recording['acidity'], ENT_QUOTES, 'UTF-8');
	$yeast = htmlspecialchars($recording['yeast'], ENT_QUOTES, 'UTF-8');
	$rice = htmlspecialchars($recording['rice'], ENT_QUOTES, 'UTF-8');
	$milling = htmlspecialchars($recording['riceMilling'], ENT_QUOTES, 'UTF-8');
	$temp = htmlspecialchars($recording['temp'], ENT_QUOTES, 'UTF-8');
	$classification = htmlspecialchars($recording['classification'], ENT_QUOTES, 'UTF-8');
	$style = htmlspecialchars($recording['style'], ENT_QUOTES, 'UTF-8');
	$vessel = htmlspecialchars($recording['servedIn'], ENT_QUOTES, 'UTF-8');
	$notes = htmlspecialchars($recording['notes'], ENT_QUOTES, 'UTF-8');
	
	if ($date!="") {
		$date = strtotime($date);
		$date = date("m/d/Y", $date);
	}
	
?>

<form action="insert-update.php" method="get">
	<input id="sakeID" type="hidden" name="sakeID" value="<?php echo $sakeID ?>"/><br/>
	Date: <input id="datepicker" type="text" name="date" value="<?php echo $date ?>"/>
	Name: <input id="name" type="text" name="name" value="<?php echo $name ?>"/>
	Rating: <input type="hidden" id="rating" name="rating" value="<?php echo $rating ?>"/><br/>
		<div class="rating">
    		<span><input type="radio" name="rating" id="5star" value="5" onclick="rateSake(5);"><label for="5star"></label></span>
    		<span><input type="radio" name="rating" id="4star" value="4" onclick="rateSake(4);"><label for="4star"></label></span>
    		<span><input type="radio" name="rating" id="3star" value="3" onclick="rateSake(3);"><label for="3star"></label></span>
    		<span><input type="radio" name="rating" id="2star" value="2" onclick="rateSake(2);"><label for="2star"></label></span>
    		<span><input type="radio" name="rating" id="1star" value="1" onclick="rateSake(1);"><label for="1star"></label></span>
		</div><br/><br/>
	Venue: <input id="venue" type="text" name="venue" value="<?php echo $venue ?>"/>	
	
	Prefecture:
		<select id="prefecture" name="prefecture" onchange="populateRegion(this.value)">
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
				echo "<option value=null> -- </option>";
				while($recording=mysqli_fetch_array($result)){
					$prefecture_name=htmlspecialchars($recording['name'], ENT_QUOTES, 'UTF-8');
					echo "<option value=$prefecture_name ";
					if ($prefecture==$prefecture_name) {
						echo "SELECTED ";
					}
					echo ">" . " ". $prefecture_name . "</option>";
				}
			?>
		</select>
	Region: <input id="region" type="text" name="region" readonly value="<?php echo $region ?>"/>
	Other Location:<input id="location" type="text" name="location" value="<?php echo $location ?>"/>
	Brewery: <input id="brewery" type="text" name="brewery" value="<?php echo $brewery ?>"/>
	Alcohol %: <input id="alcohol" type="number" name="alcohol" step="0.1" min="0" value="<?php echo $alcohol ?>"/>
	Sake Meter Value (SMV): <input id="smv" type="number" name="smv" min="-15" max="15" value="<?php echo $smv ?>"/>
	Acidity: <input id="acidity" type="number" name="acidity" step="0.1"  min="1" max="2" value="<?php echo $acidity ?>"/>
	Yeast: <input id="yeast" type="number" name="yeast" min="0" value="<?php echo $yeast ?>"/> 
	Rice:
		<select id="rice" name="rice">
			<option value=""> -- </option>
			<option value="Yamada Nishiki" <?php if ($rice=='Yamada Nishiki') echo ' SELECTED ' ?>> Yamada Nishiki </option>
			<option value="Omachi" <?php if ($rice=='Omachi') echo ' SELECTED ' ?>> Omachi </option>
			<option value="Miyama Nishiki" <?php if ($rice=='Miyama Nishiki') echo ' SELECTED ' ?>> Miyama Nishiki </option>
			<option value="Gohyakumangoku" <?php if ($rice=='Gohyakumangokui') echo ' SELECTED ' ?>> Gohyakumangoku </option>
			<option value="Oseto" <?php if ($rice=='Oseto') echo ' SELECTED ' ?>> Oseto </option>
			<option value="Hatta Nishiki" <?php if ($rice=='Hatta Nishiki') echo ' SELECTED ' ?>> Hatta Nishiki </option>
			<option value="Tamazakae" <?php if ($rice=='Tamazakae') echo ' SELECTED ' ?>> Tamazakae </option>
			<option value="Kame no O" <?php if ($rice=='Kame no O') echo ' SELECTED ' ?>> Kame no O </option>
			<option value="Dewa San San" <?php if ($rice=='Dewa San San') echo ' SELECTED ' ?>> Dewa San San </option>
		</select>
	Rice Milling %: <input id="milling" type="number" name="milling" min="0" value="<?php echo $milling ?>"/>
	Serving Temperature:
		<select id="temp" name="temp">
			<option value=""> -- </option>
			<option value="Cold" <?php if ($temp=='Cold') echo ' SELECTED ' ?>> Cold  </option>
			<option value="Room Temperature" <?php if ($temp=='Room Temperature') echo ' SELECTED ' ?>> Room Temperature </option>
			<option value="Warm" <?php if ($temp=='Warm') echo ' SELECTED ' ?>> Warm </option>
		</select>
	Classification:
		<select id="classification" name="classification">
			<option value=""> -- </option>
			<option value="Junmai" <?php if ($classification=='Junmai') echo ' SELECTED ' ?>> Junmai </option>
			<option value="Junmai Ginjo" <?php if ($classification=='Junmai Ginjo') echo ' SELECTED ' ?>> Junmai Ginjo </option>
			<option value="Junmai Daiginjo" <?php if ($classification=='Junmai Daiginjo') echo ' SELECTED ' ?>> Junmai Daiginjo </option>
			<option value="Daiginjo" <?php if ($classification=='Daiginjo') echo ' SELECTED ' ?>> Daiginjo </option>
			<option value="Futsushu" <?php if ($classification=='Futsushu') echo ' SELECTED ' ?>> Futsushu </option>
			<option value="Honjozo" <?php if ($classification=='Honjozo') echo ' SELECTED ' ?>> Honjozo </option>
			<option value="Ginjo" <?php if ($classification=='Ginjo') echo ' SELECTED ' ?>> Ginjo </option>
		</select>
	Style:
		<select id="style" name="style">
			<option value=""> -- </option>
			<option value="Taru" <?php if ($style=='Taru') echo ' SELECTED ' ?>> Taru </option>
			<option value="Kimoto" <?php if ($style=='Kimoto') echo ' SELECTED ' ?>> Kimoto </option>
			<option value="Sparkling" <?php if ($style=='Sparkling') echo ' SELECTED ' ?>> Sparkling </option>
			<option value="Muroka" <?php if ($style=='Muroka') echo ' SELECTED ' ?>> Muroka </option>
			<option value="Nama" <?php if ($style=='Nama') echo ' SELECTED ' ?>> Nama </option>
			<option value="Genshu" <?php if ($style=='Genshu') echo ' SELECTED ' ?>> Genshu </option>
			<option value="Yamahai" <?php if ($style=='Yamahai') echo ' SELECTED ' ?>> Yamahai </option>
			<option value="Nigori" <?php if ($style=='Nigori') echo ' SELECTED ' ?>> Nigori </option>
			<option value="Koshu" <?php if ($style=='Koshu') echo ' SELECTED ' ?>> Koshu </option>
			<option value="Shizuku" <?php if ($style=='Shizuku') echo ' SELECTED ' ?>> Shizuku </option>
			<option value="Tokubetsu" <?php if ($style=='Tokubetsu') echo ' SELECTED ' ?>> Tokubetsu </option>
		</select>
	Served In: <br/>
	<div class="radio-group">
		<input type="radio" id="Masu" name="vessel" value="Masu" <?php if ($vessel=='Masu') echo ' CHECKED' ?>/>
			<label for="Masu">
    			<img src="images/masu.png" alt="Masu" style="width:100px;height:100px;text-align:center">
  				<div style="text-align:center">Masu</div></br>
			</label>
		<input type="radio" id="Tulip" name="vessel" value="Tulip" <?php if ($vessel=='Tulip') echo ' CHECKED' ?>/>
			<label for="Tulip">
    			<img src="images/masu.png" alt="Tulip" style="width:100px;height:100px;text-align:center">
  				<div style="text-align:center">Tulip</div></br>
			</label>
		<input type="radio" id="Footed" name="vessel" value="Footed" <?php if ($vessel=='Footed') echo ' CHECKED' ?>/>
			<label for="Footed">
    			<img src="images/masu.png" alt="Footed" style="width:100px;height:100px;text-align:center">
  				<div style="text-align:center">Footed</div></br>
			</label>
		<input type="radio" id="Guinomi" name="vessel" value="Guinomi" <?php if ($vessel=='Guinomi') echo ' CHECKED' ?>/>
			<label for="Guinomi">
	    		<img src="images/masu.png" alt="Guinomi" style="width:100px;height:100px;text-align:center">
	  			<div style="text-align:center">Guinomi</div></br>
			</label>
		<input type="radio" id="Sakazuki" name="vessel" value="Sakazuki" <?php if ($vessel=='Sakazuki') echo ' CHECKED' ?>/>
			<label for="Sakazuki">
    			<img src="images/masu.png" alt="Sakazuki" style="width:100px;height:100px;text-align:center">
  				<div style="text-align:center">Sakazuki</div></br>
			</label>
		<input type="radio" id="Wine" name="vessel" value="Wine" <?php if ($vessel=='Wine') echo ' CHECKED' ?>/>
			<label for="Wine">
    			<img src="images/masu.png" alt="Wine" style="width:100px;height:100px;text-align:center">
  				<div style="text-align:center">Wine</div></br>
			</label>
		<input type="radio" id="Flute" name="vessel" value="Flute" <?php if ($vessel=='Flute') echo ' CHECKED'?>/>
			<label for="Flute">
    			<img src="images/masu.png" alt="Flute" style="width:100px;height:100px;text-align:center">
  				<div style="text-align:center">Flute</div></br>
			</label>
		<input type="radio" id="Sherry" name="vessel" value="Sherry" <?php if ($vessel=='Sherry') echo ' CHECKED' ?>/>
			<label for="Sherry">
    			<img src="images/masu.png" alt="Sherry" style="width:100px;height:100px;text-align:center">
  				<div style="text-align:center">Sherry</div></br>
			</label>
		<input type="radio" id="Ochoko" name="vessel" value="Ochoko" <?php if ($vessel=='Ochoko') echo ' CHECKED' ?>/> <!-- JAK - is $vessel=='ochoko'? -->
			<label for="Ochoko">
	    		<img src="images/masu.png" alt="Ochoko/Kikichoko" style="width:100px;height:100px;text-align:center">
	  			<div style="text-align:center">Ochoko/</div>
	  			<div style="text-align:center">Kikichoko</div>
			</label>
		<input type="radio" id="Other" name="vessel" value="Other" <?php if (($vessel=='Other') or ($vessel=='')) echo ' CHECKED' ?>/>
			<label for="Other">
    			<img src="images/masu.png" alt="Other" style="width:100px;height:100px;text-align:center">
  				<div style="text-align:center">Other</div></br>
			</label>
  </div>
	<br/>
	Notes:<textarea id="notes" name="notes" cols=40  rows=10><?php echo $notes ?></textarea>

	<input type="submit" value="Submit" onclick="submitForm(5);"/>
</form>



<?php
	// error logging
	error_reporting(-1);
?>

<?php
	include 'footer.php';
?>
