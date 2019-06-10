<?php

	$weather = "";

	$error = "";


	if (array_key_exists('city', $_GET)) {

		$city = str_replace(' ', '', $_GET['city']);

		$file_headers = @get_headers("https://www.weather-forecast.com/locations/".$city."/forecasts/latest");

		if ($file_headers[0] == 'HTTP/1.1 404 Not Found') {
			
			$error = "That city could not be found";

		} else {

		$forecastPage = file_get_contents("https://www.weather-forecast.com/locations/".$city."/forecasts/latest");

		$pageArray = explode('(1&ndash;3 days)</span><p class="b-forecast__table-description-content"><span class="phrase">', $forecastPage);

		if (sizeof($pageArray) > 1) {
			

			$pageOneArray = explode('</span></p></td>', $pageArray[1]);

			if (sizeof($pageOneArray) > 1) {
				
				$weather = $pageOneArray[0];

			} else {

				$error = "That city could not be found.";

			}


		} else {

			$error = "That city could not be found.";

		}

		

	}

}

?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Costum CSS -->
    <link rel="stylesheet" type="text/css" href="assets/style.css">

    <title>Weather Scraper</title>
  </head>
  <body>

<div class="container">
	
		<h1>Whats the Weather?</h1>


<form>
	  <div class="form-group">
	  	<label>Enter the name of the city.</label>
	    <input type="text" class="form-control" name="city" id="city" placeholder="Enter city Eg. Radovis, Skopje" value="<?php if(array_key_exists('city', $_GET)) {

	    	echo $_GET['city'];
	    	}
	    	?>">
	  </div>
	  <button type="submit" class="btn btn-primary">Submit</button>
</form>

<div id="weather"><?php
	
		

		if ($weather) {
			
			echo '<div class="alert alert-success" role="alert">'.$weather.'</div>';

		} else if ($error) {

			echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';

		}

		

?></div>

</div>



















    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="assets/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="assets/script.js"></script>
  </body>
</html>