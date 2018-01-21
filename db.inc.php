
<?php
	$link=mysqli_connect ('localhost', 'root', 'pe44nmen');
	if  (!$link){
		$output='Unable to connect to the database';
		echo $output;
		exit();
	}
	if (!mysqli_set_charset($link,'utf8')) {
		$output = 'Unable to set database connection encoding.';
		echo $output;
		exit();
	}
	if (!mysqli_select_db($link, 'SakeJournal')){
		$output = 'Unable to locate the database.';
		echo $output;
		exit();
	}
?>

