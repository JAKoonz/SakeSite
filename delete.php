<?php
include 'db.inc.php';

$sakeID = $_GET['sakeID'];
 
$sql = "DELETE FROM Entries WHERE 
				sakeID='" . $sakeID . "'";
	$result = mysqli_query($link, $sql);
	
	if (!$result) { 	
		$error = 'Error deleting entry: ' . mysqli_error($link);	
		echo $error; 	
		exit();
	}
    
    header('Location:view.php');
?>