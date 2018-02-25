<?php
// Report all PHP errors
error_reporting(-1);
?>

<!doctype html>
<html>
	<head>
		<title>Jenn's Sake Journal</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->
	</head>
	<body>
			<div id="container" class="container">
				<div id="header" class="header">
					<h1>Sake Journal
					<div id="menu" class="menu" onclick="navToggle(this);">
						<div class="bar1"></div>
						<div class="bar2"></div>
						<div class="bar3"></div>
					</div></h1>
					<ul class="menulist" id="menulist">		
						<li><a class="menuitems" href="view.php"><strong>View Entries</strong></a></li>				
						<li><a class="menuitems" href="add-edit.php"><strong>Add a New Entry</strong></a></li>
						
						<li><a class="menuitems" href="https://en.wikipedia.org/wiki/Prefectures_of_Japan#Lists_of_prefectures" target="_blank"><i>Prefectures of Japan</i></a></li>
						<li><a class="menuitems" href="http://www.esake.com/Knowledge/Ingredients/Rice/rice.html" target="_blank"><i>Types of Rice</i></a></li>
						<li><a class="menuitems" href="http://www.esake.com/Knowledge/Ingredients/Yeast/yeast.html" target="_blank"><i>Types of Yeast</i></a></li>
						<li><a class="menuitems" href="http://www.ozekisake.com/learn/sake-meter-value.php" target="_blank"><i>Acidity and Sake Meter Value (SMV)</i></a></li>
						<li><a class="menuitems" href="http://www.sake-talk.com/" target="_blank"><i>Sake Talk</i></a></li>
						<li><a class="menuitems" href="https://www.urbansake.com/notebook/" target="_blank"><i>Inspiration: The Urban Sake Notebook</i></a></li>
					</ul>
					<!-- <div id="main"></div> -->
				</div><!-- .header -->
				<div class="main">
						<div class="content">