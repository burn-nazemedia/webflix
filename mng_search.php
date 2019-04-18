<?php

include("inc/dbconnect.inc.php");

$results = mysqli_query ($con,
				"SELECT *
				 FROM `movie`
				 WHERE `movie_name` LIKE '%{$_GET['term']}%'"
		);

$mainarray = array (); //main container for listings

while($row=mysqli_fetch_array($results)) {
	
	$rowarray = array(
		"id" => $row['movie_id'],
		"label" => $row['movie_name']
	
	);// create individual row
	
	array_push($mainarray,$rowarray); // adds row to main array
}

echo json_encode($mainarray);// output listings
?>