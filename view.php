<?php
	include 'header.php';
?>

<form action="#" method="get">
  <div>
  	<input id="name" type="text" name="name" value="<?php echo $_GET['name'];?>" placeholder="Sake Name" /></br>
  	<input id="from" type="text" name="from" value="<?php echo $_GET['from'];?>" placeholder="From"  /></br>
  	<input id="venue" type="text" name="venue" value="<?php echo $_GET['venue'];?>" placeholder="Had at" /></br>
  	<input id="rating" type="text" name="rating" value="<?php echo $_GET['rating'];?>" placeholder="Rating" /></br>
  	<input id="style" type="text" name="style" value="<?php echo $_GET['style'];?>" placeholder="Style" /></br>
  	<input id="classification" type="text" name="classification" value="<?php echo $_GET['classification'];?>" placeholder="Classification" /></br>
  </div>
  
  <div>
    <input type="submit" value="Search">
  </div>
  
  <div>
    <input type="button" value="Clear Fields" onclick="clearForm(this.form);"> <!-- JAK TODO: get fields to retain values entered (not sure why %_POST is not working) and then have this button reset the fields (What is type=reset?) -->
  </div>
  
</form>

<?php
    //Connect to DB
	include 'db.inc.php';
	
	// Get passed-in search criteria
	$name = mysqli_real_escape_string($link, $_GET['name']); 
	$rating = mysqli_real_escape_string($link, $_GET['rating']);
	$venue = mysqli_real_escape_string($link, $_GET['venue']);
	$from = mysqli_real_escape_string($link, $_GET['from']);
	$classification = mysqli_real_escape_string($link, $_GET['classification']);
	$style = mysqli_real_escape_string($link, $_GET['style']);
    
    //Retrieve data to show
	$sql="SELECT 
        Entries.sakeID as sakeID,
		Entries.name as name,
		Entries.date as date,
		Entries.rating as rating,
		Entries.classification as classification,
		Entries.style as style,
		Entries.prefecture_fk as prefecture_fk,
		Prefecture.name as prefecture_name,
		Prefecture.region as region
        FROM Entries LEFT OUTER JOIN Prefecture
        ON Entries.prefecture_fk=Prefecture.name";
	$whereClause = '';
	if ($name!="") $whereClause = " WHERE (Entries.name LIKE '" . $name . "%')";
	if ($venue!="") {
		if ($whereClause=='') $whereClause .= " WHERE (Entries.venue LIKE '" . $venue . "%')";
		else $whereClause .= " AND (Entries.venue LIKE '" . $venue . "%')";
	}
	if ($from!="") {
		if ($whereClause=='') $whereClause .= " WHERE ";
		else $whereClause .= " WHERE ";
		$whereClause .= "((Entries.prefecture_fk  LIKE '" . $from . "%') OR (Entries.otherLocation  LIKE '" . $from . "%') OR (Prefecture.region  LIKE '" . $from . "%'))";
	}	
	if ($classification!="") {
		if ($whereClause=='') $whereClause .= " WHERE (Entries.classification LIKE '" . $classification . "%')";
		else $whereClause .= " AND (Entries.classification LIKE '" . $classification . "%')";
	}
	if ($style!="") {
		echo $whereClause . ":" . $style . "<br/>";
		if ($whereClause=='') $whereClause .= " WHERE (Entries.style LIKE'" . $style . "%')";
		else $whereClause .= " AND (Entries.style LIKE '" . $style . "%')";
	}
	if ($rating!="") {
		if ($whereClause=='') $whereClause .= " WHERE (Entries.rating='" . $rating . "')";
		else $whereClause .= " AND (Entries.rating='" . $rating . "')";
	}

	$sql .= $whereClause;
	$sql .= ' ORDER BY Entries.date DESC;';
	//echo $sql; // DEBUGGING
    
	$result = mysqli_query($link, $sql);
    
	if (!$result) { 	
		$error = 'Error fetching data: ' . mysqli_error($link);	
		echo $error; 	
		exit();
	}
    
    echo '<div class="tbl-header">
			<table>
				<thead>
				    <tr><th>Date</th><th>Name</th><th>Classification</th><th>Style</th><th>Prefecture</th><th>Region</th><th>Rating</th><th>Edit</th><th>Delete</th></tr>
				</thead>
			</table>
		</div>
		<div class="tbl-content">
			<table>
				<tbody>';
    
    //Add rows to the table
    while($recording=mysqli_fetch_array($result)){
        $sakeID=htmlspecialchars($recording['sakeID'], ENT_QUOTES, 'UTF-8');	
        $name=htmlspecialchars($recording['name'], ENT_QUOTES, 'UTF-8');
        $date=htmlspecialchars($recording['date'], ENT_QUOTES, 'UTF-8');
        $rating=htmlspecialchars($recording['rating'], ENT_QUOTES, 'UTF-8');
        $classification=htmlspecialchars($recording['classification'], ENT_QUOTES, 'UTF-8');
		$style=htmlspecialchars($recording['style'], ENT_QUOTES, 'UTF-8');
		$prefecture_fk=htmlspecialchars($recording['prefecture_fk'], ENT_QUOTES, 'UTF-8');
		$prefecture_name=htmlspecialchars($recording['prefecture_name'], ENT_QUOTES, 'UTF-8');
		$region=htmlspecialchars($recording['region'], ENT_QUOTES, 'UTF-8');
            echo '<tr>';
            echo '<td>' . $date . '</td>';
            echo '<td>' . $name . '</td>';
            echo '<td>' . $classification . '</td>';
            echo '<td>' . $style . '</td>';
			echo '<td>' . $prefecture_name . '</td>';
			echo '<td>' . $region . '</td>';
			echo '<td>' . $rating . '</td>';
			// TODO - show 1-5 stars for rating column
            
            //These links pass the ID as a URL parameter
            echo '<td><a href="add-edit.php?sakeID='. $sakeID .'">Edit</a></td>';
            echo '<td><a href="delete.php?sakeID='. $sakeID .'">Delete</a></td>';
            echo '</tr>';
	}
    
    echo '</tbody>
            </table>
			</div>';
    
    
?>
<?php
    include 'sidebar.php';
    include 'footer.php';  
?>