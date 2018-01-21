<?php 
	include 'db.inc.php';
    
    //Declare our variables
	$sakeID = htmlspecialchars($_GET["sakeID"]);
	echo $sakeID . "<br/>";
	$date = mysqli_real_escape_string($link, $_GET['date']);
	if ($date != "") {
		$date = strtotime($date);
		$date = date('Y-m-d',$date);
	}
	$name = mysqli_real_escape_string($link, $_GET['name']); 
	$rating = mysqli_real_escape_string($link, $_GET['rating']);
	$venue = mysqli_real_escape_string($link, $_GET['venue']);
	$prefecture = mysqli_real_escape_string($link, $_GET['prefecture']);
	$region = mysqli_real_escape_string($link, $_GET['region']);
	$location = mysqli_real_escape_string($link, $_GET['location']);
	$brewery = mysqli_real_escape_string($link, $_GET['brewery']);
	$alcohol = mysqli_real_escape_string($link, $_GET['alcohol']);
	$smv = mysqli_real_escape_string($link, $_GET['smv']);
	$acidity = mysqli_real_escape_string($link, $_GET['acidity']);
	$yeast = mysqli_real_escape_string($link, $_GET['yeast']);
	$rice = mysqli_real_escape_string($link, $_GET['rice']);
	$milling = mysqli_real_escape_string($link, $_GET['milling']);
	$temp = mysqli_real_escape_string($link, $_GET['temp']);
	$classification = mysqli_real_escape_string($link, $_GET['classification']);
	$style = mysqli_real_escape_string($link, $_GET['style']);
	$vessel = mysqli_real_escape_string($link, $_GET['vessel']);
	$notes = mysqli_real_escape_string($link, $_GET['notes']);
	
	if ($sakeID!="") {
		$sql = "UPDATE Entries SET 
		name='" . $name . "'";
		if ($venue!="") $sql .= ", venue='" . $venue . "'";
		if ($prefecture!='null') $sql .= ", prefecture_fk='" . $prefecture . "'";
		if ($brewery!="") $sql .= ", brewery='" . $brewery . "'";
		if ($location!="") $sql .= ", otherLocation='" . $location . "'";
		if ($alcohol!="") $sql .= ", alcohol='" . $alcohol . "'";
		if ($milling!="") $sql .= ", riceMilling='" . $milling . "'";
		if ($temp!="") $sql .= ", temp='" . $temp . "'";
		if ($classification!="") $sql .= ", classification='" . $classification . "'";
		if ($vessel!="") $sql .= ", servedIn='" . $vessel . "'";
		if ($style!="") $sql .= ", style='" . $style . "'";
		if ($rating!="") $sql .= ", rating='" . $rating . "'";
		if ($smv!="") $sql .= ", smv='" . $smv . "'";
		if ($acidity!="") $sql .= ", acidity='" . $acidity . "'";
		if ($yeast!="") $sql .= ", yeast='" . $yeast . "'";
		if ($rice!="") $sql .= ", rice='" . $rice . "'";
		if ($notes!="") $sql .= ", notes='" . $notes . "'";
		if ($date!="") $sql .= ", date=DATE('" . $date . "')";
		$sql .= " WHERE sakeID='" . $sakeID ."'";
	} else {
		$sql = "INSERT INTO Entries SET 
		name='" . $name . "'";
		if ($venue!="") $sql .= ", venue='" . $venue . "'";
		if ($prefecture!='null') $sql .= ", prefecture_fk='" . $prefecture . "'";
		if ($brewery!="") $sql .= ", brewery='" . $brewery . "'";
		if ($location!="") $sql .= ", otherLocation='" . $location . "'";
		if ($alcohol!="") $sql .= ", alcohol='" . $alcohol . "'";
		if ($milling!="") $sql .= ", riceMilling='" . $milling . "'";
		if ($temp!="") $sql .= ", temp='" . $temp . "'";
		if ($classification!="") $sql .= ", classification='" . $classification . "'";
		if ($vessel!="") $sql .= ", servedIn='" . $vessel . "'";
		if ($style!="") $sql .= ", style='" . $style . "'";
		if ($rating!="") $sql .= ", rating='" . $rating . "'";
		if ($smv!="") $sql .= ", smv='" . $smv . "'";
		if ($acidity!="") $sql .= ", acidity='" . $acidity . "'";
		if ($yeast!="") $sql .= ", yeast='" . $yeast . "'";
		if ($rice!="") $sql .= ", rice='" . $rice . "'";
		if ($notes!="") $sql .= ", notes='" . $notes . "'";
		if ($date!="") $sql .= ", date=DATE('" . $date . "')";
	}

	// echo $date . ' : ' . $date2 . ' : ' . $date3; // html : 2018-01-14, js: 01/14/2018
	
	if (!mysqli_query($link, $sql)){
		$error = 'Error adding submitted product data: ' . mysqli_error($link);
		$error .= 'Date: ' . $date;
		echo $error;
		exit();
	}
    
	header('Location:view.php');
?>