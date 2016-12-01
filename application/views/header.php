<?php
// get the current route, we will need it for different rendering scenarios
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
if ($route == '') {
	$route = $routes['default_controller'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">

	<!-- set the width of the viewport to the device's width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>California Quick Guide to Ballot Measures</title>

	<!-- jquery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

	<!-- Latest compiled and minified CSS, using custom media query breakpoints -->
	<link rel="stylesheet" href="<?php echo base_url() . 'static/css/bootstrap_ca_ballots_custom.min.css';?>">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

	<script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/1.4.5/numeral.min.js"></script>

	<!-- HighCharts - http://www.highcharts.com/ -->
	<script src="https://code.highcharts.com/highcharts.js"></script>

	<!-- our custom css -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'static/css/cal-access-ballots.css';?>">
</head>
<body>

<div class="body_container">
	<!-- begin mobile header -->
	<?php
	if ($route != "propositions") {
	?>
	<div class="hidden-lg hidden-md" style="background-color:#deeefb;position:fixed;top:0;width:100%;height:54px;z-index:10">
		<?php 
		if ($route == "propositions/(:any)") {
		?>
		<div style="right: 15px;position: absolute;top: 17px;">
			<span>
			Election: 
			</span>
			<?php
			if (count($elections['proposition_elections']) > 1) {
			?>
			<div class="dropdown" style="display:inline;">
		        <button class="btn btn-default dropdown-toggle prop_dropdown" type="button" id="dropdownMenu1"
		                data-toggle="dropdown" aria- haspopup="true" aria-expanded="true" style="background-color:#c1dff9;">
		            <?php
		            echo date('F j, Y', strtotime($election_date));
		            ?>
		            <span class="glyphicon glyphicon-triangle-bottom" aria-hidden="true"></span>
		        </button>
		        <ul class="dropdown-menu prop-dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1"
		        	style="background-color:#deeefb;padding: 0px 15px 15px 15px;margin: 0px -15px;border: none;top:25px;">
		            <?php
		            foreach ($elections['proposition_elections'] as $election_item) {
		                ?>
		                <li style="border:1px solid #333;background-color:#fff;">
		                    <a href="<?php echo base_url() . 'propositions/' . $election_item->Election; ?>" style="text-decoration:none;">
		                        <?php echo date('F j, Y', strtotime($election_item->Election)); ?>
		                    </a>
		                </li>
		            <?php } ?>
		        </ul>
		    </div>
		    <?php }  else { ?>
		    	<?php echo date('F j, Y', strtotime($elections['proposition_elections'][0]->Election)); ?>
		    <?php } ?>
	    </div>
	    <?php 
		}
		else {
			if (isset($proposition) && isset($proposition["number"])) {
				$currentProp = $proposition["number"];
			}
			else if (isset($propositions) && isset($propositions["propositions"]) && isset($propositions["propositions"][0])) {
				$currentProp = $propositions["propositions"][0]->number;
			}
	    ?>
		    <div style="margin: 17px 15px;">
			<?php echo date('F j, Y', strtotime($election_date)); ?> election 
			<?php
			if (count($elections['proposition_elections']) > 1) {
			?>
			<br/>
			(<a href="<?php echo base_url() . 'propositions/'.$election_date; ?>" style="font-size:12px;">change</a>)
			<?php } ?>
			</div>
			<div class="form-group" style="right: 15px;position: absolute;top: 10px;">
		        <div class="dropdown" >
		            <button class="btn btn-default dropdown-toggle prop_dropdown" type="button" id="dropdownMenu1"
		                    data-toggle="dropdown" aria- haspopup="true" aria-expanded="true" style="background-color:#c1dff9;">
		                PROP <?php echo $currentProp; ?>
		                <span class="glyphicon glyphicon-triangle-bottom" aria-hidden="true"></span>
		            </button>
		            <ul class="dropdown-menu prop-dropdown-menu dropdown-menu-right" id="mobile-props-dropdown" aria-labelledby="dropdownMenu1" style="background-color:#deeefb;padding: 0px 15px 15px 15px;margin: 0px -15px;border: none;" >
		                <?php
		                foreach ($propositions["propositions"] as $proposition_item) {
		                    ?>
		                    <li style="border:1px solid #333;background-color:#fff;">
		                        <a href="<?php echo base_url() . 'propositions/' . $election_date . '/' . $proposition_item->number; ?>" style="text-decoration:none;">
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
	    <?php
		}
	    ?>
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

	  $("#mobile-props-dropdown").css("z-index", 1000);
	});
	</script>
	<?php 
	}
	?>
	<!-- end mobile header -->

	<div class="container">
		<!-- begin desktop header -->
		<div style="margin-bottom: 20px;padding-top: 10px;font-weight: bold;font-size: 14px;display:inline;" class="hidden-sm hidden-xs">
		<?php

		// build the breadcrumb based off of the current route
		// $breadcrumb = "<a class='breadcrumbs' href='".base_url()."propositions'>Home</a>";
		$breadcrumb = "<a href='".base_url()."propositions/'>Quick Guide to Props</a>";
		if ($route == "default_controller" || $route == "propositions" || $route == "404_override") {
			$breadcrumb = "<span style='color: #333333;'>Quick Guide to Props</span>";
		}
		elseif ($route == "propositions/(:any)") {
			// show the election in the url
			$url_date  = DateTime::createFromFormat('Y-m-d', $this->uri->segments[2]);
			$breadcrumb .= " » <span style='color: #333333;'>".$url_date->format('F j, Y')."</span>";
		}
		elseif ($route == "propositions/(:any)/(:any)") {
			// show the election in the url
			$url_date  = DateTime::createFromFormat('Y-m-d', $this->uri->segments[2]);
			$breadcrumb .= " » <a href='".base_url()."propositions/".$this->uri->segments[2]."'>".$url_date->format('F j, Y')."</a>";

			// show the proposition number
			$breadcrumb .= " » <span style='color: #333333;'>Proposition ".$this->uri->segments[3]."</span>";
		}
		elseif ($route == "propositions/(:any)/(:any)/contributions/(:any)") {
			// show the election in the url
			$url_date  = DateTime::createFromFormat('Y-m-d', $this->uri->segments[2]);
			$breadcrumb .= " » <a href='".base_url()."propositions/".$this->uri->segments[2]."'>".$url_date->format('F j, Y')."</a>";

			// show the proposition number
			$breadcrumb .= " » <a href='".base_url()."propositions/".$this->uri->segments[2]."/".$this->uri->segments[3]."'>Proposition ".$this->uri->segments[3]."</a>";

			// show contributions
			$breadcrumb .= " » <span style='color: #333333;'>Contributions - ".$this->uri->segments[5]."</span>";
		}

		echo $breadcrumb;

		?>
		</div>
		<!-- end desktop header -->

