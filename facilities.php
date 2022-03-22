<?php
require "php/connection.php";
session_start();

require "php/find_resources.php";
?>

<!DOCTYPE html>
<html>
<head>
<title>Gallery</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="javascript/toggle_login.js"></script>
<script src="javascript/gallery_controls.js"></script>
</head>

<body>

<?php require "php/header.php"; ?>

<main>
	<section>
		<div class="container clearfix">
			<h1 class="title">Facilities</h1>
			<p class="facilities">The Community Sports Center in cooperation with Private Sports Center is offering a range of activities taking place in state of the art facilities.</p>
			<p class="facility_description">Our outdoor Tennis hardcourts are suitable for singles and doubles games and are considered medium-fast.</p>
			<p class="facility_description">Our 7-a-side football pitches are covered in artificial Astro turf, which offer the most reliable bounce and cushioning for players.</p>
			<p class="facility_description">Basketball courts are located next to the Tennis courts and have a similar playing surface. </p>
			<p class="facility_description">Badminton is played indoors, and our courts have next-gen flooring for the ultimate grip and comfort.</p>
			<p class="facilities last">There are also indoors changing facilities, lockers where visitors can store their personal belongins, and a cafeteria offering refreshing drinks and light snacks. Parking is free for the visitors</p>
		</div>
	</section>
	<section>
		<div id="gallery" class="container clearfix">
			<h2 class="title">Gallery</h2>
			<div>
				<img id="image1" class="thumbnail" src="assets/thumbnails/parkingthumb.jpg" alt="" />
				<img id="image2" class="thumbnail" src="assets/thumbnails/tennis1thumb.jpg" alt="" />
				<img id="image3" class="thumbnail" src="assets/thumbnails/tennis2thumb.jpg" alt="" />
				<img id="image4" class="thumbnail" src="assets/thumbnails/football1thumb.jpg" alt="" />
				<img id="image5" class="thumbnail" src="assets/thumbnails/football2thumb.jpg" alt="" />
				<img id="image6" class="thumbnail" src="assets/thumbnails/football3thumb.jpg" alt="" />
				<img id="image7" class="thumbnail" src="assets/thumbnails/basketball1thumb.jpg" alt="" />
				<img id="image8" class="thumbnail" src="assets/thumbnails/badminton1thumb.jpg" alt="" />
				<img id="image9" class="thumbnail" src="assets/thumbnails/badminton2thumb.jpg" alt="" />
				<img id="image10" class="thumbnail" src="assets/thumbnails/badminton3thumb.jpg" alt="" />
			</div>
		</div>
	</section>
	<section>
		<div id="lightbox" class="invisible">
			
		</div>
		<div id="image_container">
			<img id="image1full" class="fullsize invisible" src="assets/fullsize/parking.jpg" alt="" />
			<img id="image2full" class="fullsize invisible" src="assets/fullsize/tennis1.jpg" alt="" />
			<img id="image3full" class="fullsize invisible" src="assets/fullsize/tennis2.jpg" alt="" />
			<img id="image4full" class="fullsize invisible" src="assets/fullsize/football1.jpg" alt="" />
			<img id="image5full" class="fullsize invisible" src="assets/fullsize/football2.jpg" alt="" />
			<img id="image6full" class="fullsize invisible" src="assets/fullsize/football3.jpg" alt="" />
			<img id="image7full" class="fullsize invisible" src="assets/fullsize/basketball1.jpg" alt="" />
			<img id="image8full" class="fullsize invisible" src="assets/fullsize/badminton1.jpg" alt="" />
			<img id="image9full" class="fullsize invisible" src="assets/fullsize/badminton2.jpg" alt="" />
			<img id="image10full" class="fullsize invisible" src="assets/fullsize/badminton3.jpg" alt="" />
			<div id="next" class="gallery_controls invisible"></div>
			<div id="previous" class="gallery_controls invisible"></div>
		</div>
	</section>
</main>

<?php require "php/footer.php"; ?>

</body>
</html>