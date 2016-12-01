<div class="props_overview">
    <div style="display: inline;">
        <span style="font-size: 1.688em;font-weight:bold;">California Ballot Measures</span>
        <span class="hidden-xs hidden-sm" style="font-size: 14px;"> in the </span>
    </div>

    <?php if (count($elections['proposition_elections']) > 1) { ?>
    <div class="dropdown hidden-xs hidden-sm" style="display: inline;">
        <button class="btn btn-default dropdown-toggle prop_dropdown" type="button" id="dropdownMenu1"
                data-toggle="dropdown" aria- haspopup="true" aria-expanded="true">
            <?php
            echo date('F j, Y', strtotime($election_date));
            ?>
            <span class="glyphicon glyphicon-triangle-bottom" aria-hidden="true"></span>
        </button>
        <ul class="dropdown-menu prop-dropdown-menu" aria-labelledby="dropdownMenu1">
            <?php
            foreach ($elections['proposition_elections'] as $election_item) {
                ?>
                <li>
                    <a href="<?php echo base_url() . 'propositions/' . $election_item->Election; ?>" style="text-decoration:none;">
                        <?php echo date('F j, Y', strtotime($election_item->Election)); ?>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </div>
    <?php } else { ?>
    <span class="hidden-xs hidden-sm" style="font-weight: bold;"><?php echo date('F j, Y', strtotime($elections['proposition_elections'][0]->Election)); ?></span>
    <?php } ?>

    <div class="hidden-xs hidden-sm" style="display: inline;">election.</div>
</div>

<div class="hidden-xs hidden-sm" style="padding: 15px 0px 0px;">
    Find out who has spent money to support or oppose propositions in this election.
</div>

<div style="border-bottom: 1px solid #000000;padding: 15px 0px 8px;">
    Choose a ballot measure to see its funding sources:
</div>

<?php foreach ($propositions['propositions'] as $proposition_item): ?>

    <div class="row no-gutter mobile-separator" style="padding: 15px 0px;  display: flex; align-items: center; ">
        <div class="col-md-1 hidden-sm hidden-xs" style="margin-top:-4px;">
			<a href="<?php echo base_url() . 'propositions/' . $proposition_item->Election . '/' . $proposition_item->number ?>">
				<img alt="" src="<?php echo base_url(); ?>static/images/ballot_icon.jpg"/>
			</a>
        </div>
        <div class="col-md-1 hidden-sm hidden-xs">
            <div style="float: left;margin-right: 25px;text-align:center;">
                <div>
                    PROP
                </div>
                <div style="margin-top: -7px;">
                    <a href="<?php echo base_url() . 'propositions/' . $proposition_item->Election . '/' . $proposition_item->number ?>"
                       style="font-size: 30px;font-weight: bold;color: #1b3764;"><?php echo $proposition_item->number ?></a>
                </div>
            </div>
        </div>

        <div class="col-sm-2 col-xs-3 hidden-md hidden-lg">
            <!-- Maybe put the ballot image as the background? -->
            <a href="<?php echo base_url() . 'propositions/' . $proposition_item->Election . '/' . $proposition_item->number ?>"
                style="text-decoration:none;">
                <div style="float: left;margin-right: 25px;border: solid 1px #1b3764;
                    padding: 5px;box-shadow: 2px 2px 2px #4e6096;border-radius: 5px;
                    background: linear-gradient(#e0f2ff,#b0dcfc);text-align:center;color: #1b3764;">
                    <div>
                        PROP
                    </div>
                    <div style="margin-top: -7px;font-size: 30px;font-weight: bold;">
                        <?php echo $proposition_item->number ?>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-10 col-sm-10 col-xs-9">
            <div>
                <a href="<?php echo base_url() . 'propositions/' . $proposition_item->Election . '/' . $proposition_item->number ?>"
                    style="text-decoration:none;">
					<h2 style="font-size:1.125em;color:#333;margin-top:auto;margin-bottom:auto;">
						<?php echo $proposition_item->name ?>
					</h2>
				</a>
            </div>
        </div>
    </div>

<?php endforeach ?>
