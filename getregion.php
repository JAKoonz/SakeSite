<?php

    // get the q parameter from URL
    $q = $_REQUEST["q"];

    $hint = "";

    //Connect to the DB
    include 'db.inc.php';

    $sql = "SELECT Region
                FROM  Prefecture
                WHERE Name='" . $q . "'";
    $result = mysqli_query($link, $sql);
    if (!$result) {     
        $error = 'Error retrieving data for this entry: ' . mysqli_error($link);    
        echo $error;    
        exit();
    }

    $recording=mysqli_fetch_array($result);
    $region = htmlspecialchars($recording['Region'], ENT_QUOTES, 'UTF-8');

    // Output region
    echo $region;



?>