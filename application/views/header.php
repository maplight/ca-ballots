<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">

	<!-- set the width of the viewport to the device's width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>California Quick Guide to Ballot Measures</title>

	<!-- jquery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


	<script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/1.4.5/numeral.min.js"></script>

	<!-- d3.js visualization library -->
	<!-- <script src="https://d3js.org/d3.v4.min.js"></script> -->
	<!-- <script src="http://d3js.org/d3.v3.min.js"></script>
	<script src="http://dimplejs.org/dist/dimple.v2.2.0.min.js"></script> -->

	<!-- HighCharts - http://www.highcharts.com/ -->
	<script src="https://code.highcharts.com/highcharts.js"></script>

	<!-- our custom css -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'cal-access-ballots.css';?>">
</head>
<body>

<div class="body_container">
	<!-- begin mobile header -->
	<div class="hidden-lg hidden-md" style="background-color:#deeefb;position:fixed;top:0;width:100%;height:54px;z-index:10">
	<?php
		if (isset($proposition) && isset($proposition["number"])) {
			$currentProp = $proposition["number"];
		}
		else {
			$currentProp = $propositions["propositions"][0]->number;
		}
	?>
		<div style="margin: 15px;">
		<?php echo date('F j, Y', strtotime($election_date)); ?> election (<a href="<?php echo base_url() . 'propositions/'; ?>" style="font-size:12px;">change</a>)
		</div>
		<div class="form-group" style="right: 15px;position: absolute;top: 10px;">
	        <div class="dropdown" >
	            <button class="btn btn-default dropdown-toggle prop_dropdown" type="button" id="dropdownMenu1"
	                    data-toggle="dropdown" aria- haspopup="true" aria-expanded="true" style="background-color:#c1dff9;">
	                PROP <?php echo $currentProp; ?>
	                <span class="caret"></span>
	            </button>
	            <ul class="dropdown-menu prop-dropdown-menu dropdown-menu-right" id="mobile-props-dropdown" aria-labelledby="dropdownMenu1" style="background-color:#deeefb;padding: 0px 15px 15px 15px;margin: 0px -15px;border: none;" >
	                <?php
	                foreach ($propositions["propositions"] as $proposition_item) {
	                    ?>
	                    <li style="border:1px solid #333;background-color:#fff;">
	                        <a href="<?php echo base_url() . 'propositions/' . $election_date . '/' . $proposition_item->number; ?>">
	                            <?php echo $proposition_item->number; ?>
	                            - <?php echo substr($proposition_item->name, 0, 26);
	                            if (strlen($proposition_item->name) > 26) {
	                                echo "...";
	                            } ?>
	                        </a>
	                    </li>
	                <?php } ?>
	            </ul>
	        </div>
	    </div>
	</div>

	<script>
	// adjust the props list dropdown so it is visible and scrollable on all viewport sizes
	$(function() {
		if ($("#mobile-props-dropdown").height() > $( window ).height()-60) {
			var height = $("#mobile-props-dropdown").height() < $( window ).height()-60 ? $("#mobile-props-dropdown").height() : $( window ).height()-60;
			var maxWidth = $( window ).width()-30 > 300 ? 300 : $( window ).width()-30;
			$("#mobile-props-dropdown").css("height", height);
			$("#mobile-props-dropdown").css("max-height", height);
			$("#mobile-props-dropdown").css("width", $( window ).width()-30);
			$("#mobile-props-dropdown").css("max-width", maxWidth);
			$("#mobile-props-dropdown").css("overflow-y", "scroll");
		}

	  $("#mobile-props-dropdown").css("z-index", 10);
	});
	</script>
	<!-- end mobile header -->

	<div class="container">
		<!-- begin desktop header -->
		<div style="margin-bottom: 20px;padding-top: 10px;font-weight: bold;font-size: 14px; float: left;" class="hidden-sm hidden-xs">
		<?php

		// all routes as specified in config/routes.php, reserved because Codeigniter matched route from last element in array to first
		$routes = array_reverse($this->router->routes);
		foreach ($routes as $key => $val) {
			// current route being checked
			$route = $key;

			// convert wildcards to RegEx
			$key = str_replace(array(':any', ':num'), array('[^/]+', '[0-9]+'), $key);

			// does the RegEx match?
			if (preg_match('#^'.$key.'$#', $this->uri->uri_string(), $matches)) break;
			$route = '';

		}

		// if the route is blank, it can only be matching the default route.
		if (!$route || $route != '') $route = $routes['default_controller'];

		// build the breadcrumb based off of the current route
		$breadcrumb = "<a class='breadcrumbs' href='".base_url()."propositions'>Home</a>";
		if ($route == "default_controller" || $route == "propositions" || $route == "404_override") {
			$breadcrumb .= " » <a class='breadcrumbs' href='".base_url().".propositions/'>Propositions</a>";

			// if election is empty, or no election, show next upcoming election
			$url_date = DateTime::createFromFormat('Y-m-d', $this->config->config['next_election_date']);
			$breadcrumb .= " » <span class='breadcrumbs'>".$url_date->format('F j, Y')."</span>";
		}
		elseif ($route == "propositions/(:any)") {
			$breadcrumb .= " » <a class='breadcrumbs' href='".base_url()."propositions/'>Propositions</a>";

			// show the election in the url
			$url_date  = DateTime::createFromFormat('Y-m-d', $this->uri->segments[2]);
			$breadcrumb .= " » <span style='color: #003466;'>".$url_date->format('F j, Y')."</span>";
		}
		elseif ($route == "propositions/(:any)/(:any)") {
			$breadcrumb .= " » <a class='breadcrumbs' href='".base_url()."propositions/'>Propositions</a>";

			// show the election in the url
			$url_date  = DateTime::createFromFormat('Y-m-d', $this->uri->segments[2]);
			$breadcrumb .= " » <a class='breadcrumbs' href='".base_url()."propositions/".$this->uri->segments[2]."'>".$url_date->format('F j, Y')."</a>";

			// show the proposition number
			$breadcrumb .= " » <span style='color: #003466;'>Proposition ".$this->uri->segments[3]."</span>";
		}
		elseif ($route == "propositions/(:any)/(:any)/contributions/(:any)") {
			$breadcrumb .= " » <a class='breadcrumbs' href='".base_url()."propositions/'>Propositions</a>";

			// show the election in the url
			$url_date  = DateTime::createFromFormat('Y-m-d', $this->uri->segments[2]);
			$breadcrumb .= " » <a class='breadcrumbs' href='".base_url()."propositions/".$this->uri->segments[2]."'>".$url_date->format('F j, Y')."</a>";

			// show the proposition number
			$breadcrumb .= " » <a class='breadcrumbs' href='".base_url()."propositions/".$this->uri->segments[2]."/".$this->uri->segments[3]."'>Proposition ".$this->uri->segments[3]."</a>";

			// show contributions
			$breadcrumb .= " » <span style='color: #003466;'>Contributions - ".$this->uri->segments[5]."</span>";
		}

		echo $breadcrumb;

		?>
		</div>
		<!-- end desktop header -->

