<div class="props_overview">
    <div style="display: inline;">
        <span style="font-size: 1.688em;font-weight:bold;">California Ballot Measures</span>
        <span class="" style="font-size: 14px;"> in the </span>
    </div>

    <div class="dropdown" style="display: inline;">
        <button class="btn btn-default dropdown-toggle prop_dropdown" type="button" id="dropdownMenu1"
                data-toggle="dropdown" aria- haspopup="true" aria-expanded="true">
            -- Choose one --
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

    <div style="display: inline;">election.</div>
</div>

<div style="padding: 15px 0px 0px;">
    Choose an election to find out about the propositions on that ballot.
</div>