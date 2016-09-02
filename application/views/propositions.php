<div style="padding: 15px;">
	<div style="display: inline;"><span style="font-size: 1.688em;font-weight:bold;">California Ballot Measures</span><span style="font-size: 14px;"> in the </span></div>

	<div class="dropdown" style="display: inline;">
		<button class="btn btn-default dropdown-toggle prop_dropdown" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-	haspopup="true" aria-expanded="true">
			<?php 
				echo date('F j, Y', strtotime($election_date));
			?>
			<span class="caret"></span>
		</button>
		<ul class="dropdown-menu prop-dropdown-menu" aria-labelledby="dropdownMenu1">
			<?php 
			foreach ($elections['proposition_elections'] as $election_item) { 
			?>
			<li>
				<a href="<?php echo base_url().'propositions/'.$election_item->Election; ?>">
				<?php echo date('F j, Y', strtotime($election_item->Election)); ?>
				</a>
			</li>
			<?php } ?>
		</ul>
	</div>

	<div style="display: inline;">election.</div>
</div>

<div style="padding: 0px 15px;font-size: 1.313em;">
Find out who has been spending money to support or oppose ballot measures this election.
</div>

<div style="margin: 15px 15px 5px;border-bottom: 1px solid #000000;padding: 15px 0px 8px;">
Choose a ballot measure to see its funding sources:
</div>

<?php foreach ($propositions['propositions'] as $proposition_item): ?>

    <div class="row" style="padding: 15px;">
		<div class="col-sm-1 hidden-xs" style="text-align: left;">
			<img src="<?php echo base_url();?>static/images/ballot_icon.jpg" />
		</div>
		<div class="col-sm-11 col-xs-12">
			<div>
				<div style="float: left;margin-right: 25px;">
					<div>
					PROP
					</div>
					<div style="margin-top: -7px;">
					<a href="<?php echo base_url().'propositions/'.$proposition_item->Election.'/'.$proposition_item->number ?>" style="font-size: 30px;font-weight: bold;color: #1b3764;"><?php echo $proposition_item->number ?></a>
					</div>
				</div>
				<h1 style="padding: 0px 15px;font-size:1.125em;margin: 0px;"><?php echo $proposition_item->name ?></h1>
			</div>
		</div>
	</div>

<?php endforeach ?>
