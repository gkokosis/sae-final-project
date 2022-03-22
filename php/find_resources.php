<?php
/* This script checks the database to find all the available resources. 
Then saves the relevant information in arrays, so the information will 
be available in the scripts where this is included */

/* Here we query the database to get the available resources */
$resources_query = "SELECT * FROM resources";

$resources_result = $connection->query($resources_query);

/* We create the arrays to hold the information in order to create 'header.php' and 'footer.php' */
$resources_id = array();
$resources_name = array();
$resources_images = array();  // This is used in 'index.php'

if($resources_result->num_rows > 0) {
	$res_number = $resources_result->num_rows;
	while ($resources_row = $resources_result->fetch_assoc()) {
		$resources_id[] = $resources_row["id"];
		$resources_name[] = $resources_row["name"];
		$resources_images[] = $resources_row["image1"];
	}						
}

$resources_result->free();
?>