<?php
	/* -----------------------------------------   Start   -------------------------------------------- */
	/* In this section we get the clue from the http request, query the database, and load the correct
	resource */

	if(isset($_GET["resource"])) {
		$resource_id = $_GET["resource"];
		/* Here we query the database and get all the available resources, and then we create
		the html to display them in the activity page */
		$single_resource_query = "SELECT * FROM resources WHERE id = '$resource_id'";

		$single_resource_result = $connection->query($single_resource_query);

		if($single_resource_result->num_rows == 1) {
			$single_row = $single_resource_result->fetch_assoc();

			echo "<div id=\"single_activity\" class=\"container clearfix\">
			<h1 class=\"title\">". $single_row['name'] ."</h1>
			<div><img src=\"assets/". $single_row['image2'] ."\" alt=\"\" /></div>
			<div class=\"description\"><p>". $single_row['description'] ."</p></div>
			</div>";
		}

		$single_resource_result->free();
	} else {
		header("location: index.php");
	}
?>