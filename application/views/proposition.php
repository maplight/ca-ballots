<!-- prop $title should go here -->
<div style="font-weight:bold;margin-bottom:30px;">
    <div class="row">
        <div class="col-sm-2" style="padding-right:24px;">
            <div style="font-size:15px;">PROP</div>
            <div style="font-size:42px;"><?php echo $proposition["number"]; ?></div>
        </div>
        <h2 class="col-sm-10" style="font-weight:bold;">
            <?php echo $proposition['name']; ?>
        </h2>
    </div>
</div>

<div class="form-inline">
    <?php
    $totalProps = count($propositions["propositions"]);
    $currentProp = $this->uri->segment(3, $propositions["propositions"][0]->number);
    $prevProp = "";
    $nextProp = "";
    $props = $propositions["propositions"];

    // find active prop so we can set paging buttons
    for ($x = 0; $x < $totalProps; $x++) {
        $proposition_item = $props[$x];

        if ($currentProp == $proposition_item->number) {

            // don't show a previous prop if we are at index 0
            if ($totalProps > 1 && $x > 0) {
                $prevPropIndex = $x - 1;
                if ($prevPropIndex != -1) {
                    $prevProp = $props[$prevPropIndex]->number;
                }
            }

            // don't show next prop if we are at end of array
            if ($totalProps > 1 && $x < $totalProps - 1) {
                $nextPropIndex = $x + 1;
                $nextProp = $props[$nextPropIndex]->number;
            }

            // we've got prevProp and nextProp set,
            // so we can break on outta here
            break;
        }
    }
    ?>

    <!-- all props drop down -->
    <div class="form-group" <?php if ($prevProp != "") {
        echo "style='padding-right: 10px;'";
    } ?>>
        <a href="<?php echo base_url() . 'propositions/' . $this->uri->segment(2) . '/' . $prevProp; ?>"><?php if ($prevProp != "") {
                echo '<- Prop ' . $prevProp;
            } ?></a>
    </div>

    <div class="form-group" style="padding-right: 10px;">
        <div class="dropdown">
            <button class="btn btn-default dropdown-toggle prop_dropdown" type="button" id="dropdownMenu1"
                    data-toggle="dropdown" aria- haspopup="true" aria-expanded="true">
                Prop <?php echo $currentProp; ?>
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu prop-dropdown-menu" aria-labelledby="dropdownMenu1">
                <?php
                foreach ($propositions["propositions"] as $proposition_item) {
                    ?>
                    <li>
                        <a href="<?php echo base_url() . 'propositions/' . $this->uri->segment(2) . '/' . $proposition_item->number; ?>">
                            Prop <?php echo $proposition_item->number; ?>
                            - <?php echo substr($proposition_item->name, 0, 50);
                            if (strlen($proposition_item->name) > 50) {
                                echo "...";
                            } ?>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>

    <div class="form-group">
        <a href="<?php echo base_url() . 'propositions/' . $this->uri->segment(2) . '/' . $nextProp; ?>"><?php if ($nextProp != "") {
                echo 'Prop ' . $nextProp . ' ->';
            } ?></a>
    </div>
</div>

<div>
    <h3 class="section_headers">
        Summary
    </h3>

    <p><?php echo $proposition['text'][0]->Summary; ?></p>
</div>


<div>
    <h3 class="section_headers">
        Money Raised
    </h3>

    <div id="chartContainer" class="container" style="height: 150px;">

    </div>

    <script type="text/javascript">
        $(function () {
            $('#chartContainer').highcharts({
                chart: {
                    type: 'bar'
                },
                title: {
                    text: null
                },
                subtitle: {
                    text: null
                },
                xAxis: {
                    categories: ['Yes on Prop <?php echo $currentProp; ?>', 'No on Prop <?php echo $currentProp; ?>'],
                    title: {
                        text: null
                    },
                    labels: {
                        style: {
                            fontSize: '16px',
                            fontFamily: 'sans-serif',
                            fontWeight: 'normal'
                        }
                    },
                    gridLineWidth: 0
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: '',
                        align: 'high'
                    },
                    labels: {
                        enabled: false
                    },
                    gridLineWidth: 0

                },
                tooltip: {
                    valueSuffix: ' millions'
                },
                plotOptions: {
                    bar: {
                        dataLabels: {
                            enabled: true,
                            style: {
                                fontSize: '16px',
                                fontFamily: 'sans-serif',
                                fontWeight: 'normal'
                            }
                        },
                        colors: ['#1b3764', '#959595'],
                        colorByPoint: true
                    }
                },
                credits: {
                    enabled: false
                },
                series: [{
                    showInLegend: false,
                    data: [
                        <?php echo $proposition['money_raised'][0]->AmountYes; ?>,
                        <?php echo $proposition['money_raised'][0]->AmountNo; ?>
                    ]
                }]
            });
        });
    </script>

    <div>
    </div>
</div>

<div>
    <h3 class="section_headers">
        Biggest Contributors
    </h3>

    <div class="row">
        <div class="col-md-6">
            <h4>
                Yes on Prop <?php echo $proposition_number; ?>
            </h4>

            <?php if (isset($proposition['top_contributors']['SUPPORT'])) { ?>
                <?php foreach ($proposition['top_contributors']['SUPPORT'] as $item) { ?>
                    <div class="row" style="margin-bottom: 10px;">
                        <div class="col-xs-6">
                            <?php echo $item->Donor; ?><br/>
                            <span style="font-size:12px;"> <?php echo $item->Date; ?></span>
                        </div>
                        <div class="col-xs-6">
                            <?php echo $item->Amount; ?>
                        </div>
                    </div>

                <?php } ?>
            <?php } ?>


            <div style="margin-top: 30px;">
                <a href="<?php echo $proposition["number"]; ?>/contributions/yes">More Contributions to Yes
                    on <?php echo $proposition_number; ?></a>
            </div>
        </div>

        <div class="col-md-6">
            <h4>
                No on Prop <?php echo $proposition_number; ?>
            </h4>

            <?php if (isset($proposition['top_contributors']['OPPOSE'])) { ?>
                <?php foreach ($proposition['top_contributors']['OPPOSE'] as $item) { ?>
                    <div class="row" style="margin-bottom: 10px;">
                        <div class="col-xs-6">
                            <?php echo $item->Donor; ?><br/>
                            <span style="font-size:12px;"> <?php echo $item->Date; ?></span>
                        </div>
                        <div class="col-xs-6">
                            <?php echo $item->Amount; ?>
                        </div>
                    </div>

                <?php } ?>
            <?php } ?>

            <div style="margin-top: 30px;">
                <a href="<?php echo $proposition["number"]; ?>/contributions/no">More Contributions to No
                    on <?php echo $proposition_number; ?></a>
            </div>
        </div>
    </div>

    <p style="margin-top: 15px;">
        Showing the 5 largest contributions, including any ties, to committees primarily formed for and against Prop 53.
        Contributions between allied committees are excluded. For more information on funding for ballot measure
        campaigns, visit our Campaign Finance <a href="http://powersearch.sos.ca.gov/" target="_blank">Power Search</a>.
    </p>
</div>

<div>
    <h3 class="section_headers">
        More Information on Proposition <?php echo $proposition_number; ?>
    </h3>

    <p>
        We provide a brief overview of Proposition <?php echo $proposition_number; ?> here.
        For more detailed information on this proposition,
        download the official <a href="http://voterguide.sos.ca.gov/" target="_blank">California Voter Information
            Guide</a>.
    </p>
</div>

<div>
    <h3 class="section_headers">
        What your vote means
    </h3>

    <div class="row">
        <div class="col-md-6">
            <!-- <div> -->
            <h3 class="floated_section_sub_headers">
                Yes
            </h3>
            <!-- <div style="position: absolute;bottom: 0px;"> -->

            <!-- </div> -->
            <p>
                <?php echo $proposition['text'][0]->WhatYourVoteMeansYes; ?>
            </p>
        </div>

        <div class="col-md-6">
            <h3 class="floated_section_sub_headers">
                No
            </h3>


            <p>
                <?php echo $proposition['text'][0]->WhatYourVoteMeansNo; ?>
            </p>
        </div>
    </div>
</div>
<div>
    <h3 class="section_headers">
        More information from the Secretary of State
    </h3>

    <p>
        Background on Proposition <?php echo $proposition_number; ?>, an analysis by the legislative analyst, and
        endorsements
        for and against the measure are available in the
        <a href="http://voterguide.sos.ca.gov/" target="_blank">California Information Voter Guide</a>.
    </p>

    <p>
        <a href="http://registertovote.ca.gov/" target="_blank">Register to vote</a>
    </p>

    <p>
        <a href="http://www.sos.ca.gov/elections/polling-place/" target="_blank">Find your polling place</a>
    </p>
</div>

<div>
    <h3 class="section_headers">
        Arguments
    </h3>

    <div class="row">
        <div class="col-md-6">
            <h3 class="floated_section_sub_headers">
                Pro
            </h3>

            <p>
                <?php echo $proposition['text'][0]->ArgumentsPro; ?>
            </p>
        </div>

        <div class="col-md-6">
            <h3 class="floated_section_sub_headers">
                Con
            </h3>

            <p>
                <?php echo $proposition['text'][0]->ArgumentsCon; ?>
            </p>
        </div>
    </div>
</div>

<div>
    <h3 class="section_headers">
        Campaigns
    </h3>

    <div class="row">
        <div class="col-md-6">
            <h3 style="margin-top: 15px;">
                For
            </h3>

            <div>
                <?php echo $proposition['text'][0]->AdditionalInformationFor; ?>
            </div>
        </div>

        <div class="col-md-6">
            <h3 style="margin-top: 15px;">
                Against
            </h3>

            <div><?php echo $proposition['text'][0]->AdditionalInformationAgainst; ?>
            </div>
        </div>
    </div>
</div>