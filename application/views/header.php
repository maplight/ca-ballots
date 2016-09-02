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
<div class="container" style="font-size: 14px;margin-top: 40px;">
	<div style="margin-bottom: 20px;font-weight: bold;font-size: 14px;">
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
	}

	// if the route is blank, it can only be mathcing the default route.
	if ( ! $route) $route = $routes['default_route'];

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
