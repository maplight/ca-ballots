<div style="font-weight:bold;font-size:18px;">
Contributions to the <?php echo ucfirst($yesOrNo); ?> on <?php echo $proposition_number; ?> Campaigns
</div>

<div class="section_headers">
	Money Raised: $4.55 million
</div>

<div class="row">
	<div class="col-md-6">
		<h4>
			<?php echo ucfirst($yesOrNo); ?> on Prop <?php echo $proposition_number; ?>
		</h4>
		<!-- Top X Contributions -->
		<div class="row" style="margin-bottom: 10px;">
			<div class="col-xs-6">
			Consumer Attorneys of America<br/>
			<span style="font-size:12px;">06/13/2016</span>
			</div>
			<div class="col-xs-6">
			$1,000,000
			</div>
		</div>
		<div class="row" style="margin-bottom: 10px;">
			<div class="col-xs-6">
			Consumer Attorneys of America<br/>
			<span style="font-size:12px;">06/13/2016</span>
			</div>
			<div class="col-xs-6">
			$1,000,000
			</div>
		</div>
		<div class="row" style="margin-bottom: 10px;">
			<div class="col-xs-6">
			Consumer Attorneys of America<br/>
			<span style="font-size:12px;">06/13/2016</span>
			</div>
			<div class="col-xs-6">
			$1,000,000
			</div>
		</div>
		<div class="row" style="margin-bottom: 10px;">
			<div class="col-xs-6">
			Consumer Attorneys of America<br/>
			<span style="font-size:12px;">06/13/2016</span>
			</div>
			<div class="col-xs-6">
			$1,000,000
			</div>
		</div>

		<!-- Unitemized Contributions -->
		<div class="row" style="margin-bottom: 5px;margin-top: 30px;">
			<div class="col-xs-6">
			Unitemized Contributions
			</div>
			<div class="col-xs-6">
			$488,741
			</div>
		</div>
	</div>
</div>

<div style="margin-bottom: 30px;">
Unitemized contributions come from many individuals and organizations.  Each of these donations
is small enough that the individuals' identities are not required to be disclosed.
</div>

<div>
<?php 
$position = "support";
if ($yesOrNo == "no") {
	$position = "oppose";
}
?>
Showing up to 100 contributions to committees primarily formed to <?php echo $position; ?> Prop <?php echo $proposition_number ?>.  
Contributions between allied committees are excluded.  For more advanced tools to examine funding for ballot measure campaigns,
visit our Campaign Finance <a href="http://powersearch.sos.ca.gov/" target="_blank">Power Search</a>.
</div>