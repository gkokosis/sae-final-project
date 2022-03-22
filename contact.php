<?php
require "php/connection.php";
session_start();

require "php/find_resources.php";

require_once "php/validate.php";
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Contact</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="javascript/toggle_login.js"></script>
</head>

<body>

<?php require "php/header.php"; ?>

<main>
    <section>
        <div class="container clearfix">
            <h1 class="title">Contact us</h1>
            <p class="contact_info">If you have an inquiry you can contact us using the form below. We will try to answer all inquiries within 24 hours. Alternatively, you can call <span class="tel">(+44) 20 1234 5678</span> during our office opening hours (everyday 17:00 - 20:00).</p>
            <div id="form_container">
                <form name="contact" action="" method="post">
                    <div class="clearfix">
                        <div class="entry left">    
                            <label for="fname">Name</label>
                                <input type="text" name="fname" id="fname" value="<?php echo $fname; ?>" autocomplete="off" />
                                <p class="error"><?php echo $fname_error; ?></p>
                        </div>
                        <div class="entry left">       
                            <label for="email">E-mail</label>
                                <input type="email" name="email" id="email" value="<?php echo $email; ?>" autocomplete="off" />
                                <p class="error"><?php echo $email_error; ?></p>
                        </div>
                    </div>        
                    <div id="textarea_container">        
                        <label for="msg">Message</label>
                        	<textarea name="msg" id="msg" rows="4" cols="30" ><?php echo $msg; ?></textarea>
                            <p class="error"><?php echo $msg_error; ?></p>
                    </div>                
                    <div id="contact_submit">      
                        <input type="submit" name="submit" value="submit" id="submit" />
                    </div>
                </form>
            </div>
        </div>
    </section>
    <section>
        <div id="map_container" class="container clearfix">
            <h2 class="title">Find us</h2>
            <p>We are located on the north side of Hyde Park, 29 Bayswater road, W2, London. Nearest stop is the Lancaster Gate tube station.</p>
            <div id="map">

            </div>
            <script>
                /* Google maps initiation function */
                function initMap() {
                      var uluru = {lat: 51.512, lng: -0.170};
                      var map = new google.maps.Map(document.getElementById('map'), {
                        zoom: 15,
                        center: uluru
                      });
                      var marker = new google.maps.Marker({
                        position: uluru,
                        map: map
                      });
                    }
            </script>
            <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBXfG6r9IzBe_aG5ZoaanNT7aGrxMucO-s&callback=initMap"></script>
        </div>
    </section> 
</main> 

<?php require "php/footer.php"; ?>

</body>
</html>