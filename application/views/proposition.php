<div style="vertical-align: middle;float:right" class="nav">
    <div class="form-inline" style="float: right;">
        <?php
        $totalProps = count($propositions["propositions"]);
        $currentProp = $this->uri->segment(3, $propositions["propositions"][0]->number);
        $prevProp = "";
        $nextProp = "";
        $props = $propositions["propositions"];
        $nextPropName = "";
        $prevPropName = "";

        // find active prop so we can set paging buttons
        for ($x = 0; $x < $totalProps; $x++) {
            $proposition_item = $props[$x];

            if ($currentProp == $proposition_item->number) {

                // don't show a previous prop if we are at index 0
                if ($totalProps > 1 && $x > 0) {
                    $prevPropIndex = $x - 1;
                    if ($prevPropIndex != -1) {
                        $prevProp = $props[$prevPropIndex]->number;
                        $prevPropName = $props[$prevPropIndex]->name;
                    }
                }

                // don't show next prop if we are at end of array
                if ($totalProps > 1 && $x < $totalProps - 1) {
                    $nextPropIndex = $x + 1;
                    $nextProp = $props[$nextPropIndex]->number;
                    $nextPropName = $props[$nextPropIndex]->name;
                }

                // we've got prevProp and nextProp set,
                // so we can break on outta here
                break;
            }
        }
        ?>


        <!-- all props drop down -->
        <div class="form-group hidden-sm hidden-xs" <?php if ($prevProp != "") {
            echo "style='padding-right: 10px;'";
        } ?>>

            <a href="<?php echo base_url() . 'propositions/' . $this->uri->segment(2) . '/' . $prevProp; ?>"><?php if ($prevProp != "") {
                    echo "<div  style='font-size:30px; vertical-align: middle;' class='glyphicon glyphicon-menu-left gi-2x'></div>

                    <div  style='float: right; padding-top: 6px;' id='link-text'>" . 'Prop ' . $prevProp . "</div>";
                } ?></a></a>
        </div>

        <div class="form-group hidden-xs hidden-sm" style="padding-right: 10px;">
            <div class="dropdown">
                <button class="btn btn-default dropdown-toggle prop_dropdown" type="button" id="dropdownMenu1"
                        data-toggle="dropdown" aria- haspopup="true" aria-expanded="true">
                    Prop <?php echo $currentProp; ?>
                    <span class="glyphicon glyphicon-triangle-bottom" aria-hidden="true"></span>
                </button>
                <ul class="dropdown-menu prop-dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
                    <?php
                    foreach ($propositions["propositions"] as $proposition_item) {
                        ?>
                        <li>
                            <a href="<?php echo base_url() . 'propositions/' . $this->uri->segment(2) . '/' . $proposition_item->number; ?>" style="text-decoration:none;">
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

        <div style="font-size:15px; vertical-align: middle;" class="form-group hidden-sm hidden-xs">
            <a href="<?php echo base_url() . 'propositions/' . $this->uri->segment(2) . '/' . $nextProp; ?>"><?php if ($nextProp != "") {
                    echo "<div  style='float: left; padding-top: 6px;' id='link-text'>" . 'Prop ' . $nextProp . "</div>
                    <div style='font-size:30px; vertical-align: middle;' class='glyphicon glyphicon-menu-right gi-2x'></div>";
                } ?>

            </a>
        </div>
    </div>
</div>


<div class="prop-name-container">
    <div class="row no-gutter">
        <div class="col-sm-2">
            <div class="prop-top" style="font-size:20px; font-weight: bold;">PROP</div>
            <div style="font-size:55px;"><?php echo $proposition["number"]; ?></div>
        </div>
        <h1 class="col-sm-10 hidden-xs hidden-sm">
            <?php echo $proposition['text'][0]->Title; ?>
        </h1>
        <h1 class="col-sm-10 hidden-md hidden-lg" style="font-size: 24px;margin-top:0px;">
            <?php echo $proposition['text'][0]->Title; ?>
        </h1>
    </div>
</div>


<div>
    <h2 class="section_headers">
        Summary
    </h2>

    <p><?php echo $proposition['text'][0]->Summary; ?></p>
</div>


<div>
    <h2 class="section_headers">
        Money Raised
    </h2>

    <div>
        <p>
            Chart depicts total fundraising by all committees primarily formed for and against Prop <?php echo $proposition["number"]; ?>.  Totals are updated daily with contributions from <a href="http://powersearch.sos.ca.gov/" target="_blank">Power Search</a> and adjustments from the most recent Political Reform Division analysis.
        </p>
    </div>
    <div id="chartContainer" class="container chart-container">

    </div>

    <?php
    $amountYesFormat = '${y}';
    $amountNoFormat = '${y}';

    ?>


    <div id="amountYesModId" data-amountraw="<?php echo $proposition['money_raised'][0]->AmountYes ?>"
         data-amountmod="<?php echo $proposition['money_raised'][0]->AmountYesFormatted; ?>"></div>
    <div id="amountNoModId" data-amountraw=" <?php echo $proposition['money_raised'][0]->AmountNo ?>"
         data-amountmod="<?php echo $proposition['money_raised'][0]->AmountNoFormatted; ?>"></div>

    <script type="text/javascript">

		var chart = new Highcharts.Chart({
				chart: {
                    type: 'bar',
                    renderTo: 'chartContainer',
                    marginRight: 90
                },
                title: {
                    text: null
                },
                subtitle: {
                    text: null
                },
                tooltip: {
                    enabled: false
                },
                xAxis: {
                    type: 'category',
                    categories: ['<div style="text-align:center;color:#0A6ABA;">Yes<div><div> on <?php echo $currentProp; ?></div>', '<div style="text-align:center;color:#054376;">No<div><div> on <?php echo $currentProp; ?></div>'],
                    title: {
                        text: null
                    },
                    labels: {
                        style: {
                            fontSize: '16px',
                            fontFamily: 'sans-serif',
                            fontWeight: 'normal',
                            width: '50px'
                        },
                        useHTML: true
                    },
                    lineWidth: 0,
                    tickWidth: 0
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
                plotOptions: {
                    bar: {
                        colorByPoint: true
                    }
                },
                credits: {
                    enabled: false
                },
                series: [{
                    dataLabels: {
                        enabled: true,
                        formatter: function () {
                            return '$' + $('#amountYesModId').data('amountmod');
                        },
                        style: {
                            fontSize: '16px',
                            fontFamily: 'sans-serif',
                            fontWeight: 'normal'
                        },
                        crop: false,
                		overflow: 'none',
                        y: 3
                    },
                    showInLegend: false,
                    pointWidth: 50,
                    data: [
                        {
                            color: "#0A6ABA",
                            y:  <?php echo $proposition['money_raised'][0]->AmountYes; ?>,
                            name: '<div style="text-align:center;color:#0A6ABA;">Yes<div><div> on <?php echo $currentProp; ?></div>',

                        }
                    ]
                }, {
                    showInLegend: false,
                    dataLabels: {
                        enabled: true,
                        formatter: function () {
                            return '$' + $('#amountNoModId').data('amountmod');
                        },
                        style: {
                            fontSize: '16px',
                            fontFamily: 'sans-serif',
                            fontWeight: 'normal'
                        },
                        crop: false,
                		overflow: 'none',
                        y: -4
                    },
                    pointWidth: 50,
                    data: [
                        {
                            color: '#054376',
                            y:  <?php echo $proposition['money_raised'][0]->AmountNo; ?>,
                            name: '<div style="text-align:center;color:#054376;">No<div><div> on <?php echo $currentProp; ?></div>',
                        }
                    ]
                	}
              	]	
            }, function(chartObj) {
		    	$.each(chartObj.series[0].data, function(i, point) {
			        // console.log('point.dataLabel: ', point.dataLabel);
			        // if(i % 2 == 0) {
			        //     point.dataLabel.attr({y: point.dataLabel.y - 15});
			        // } else {
			        //     point.dataLabel.attr({y: point.dataLabel.y + 35});
			        // }	

			        // point.dataLabel.attr({x: point.dataLabel.x + 100});
			        // point.dataLabel.attr({width: point.dataLabel.widthSetter(200)});
		    	});
			});

    </script>
</div>

<div>
    <h2 class="section_headers">
        Largest Contributions
    </h2>

    <div>
        <p style="margin: 15px 0px;">
            Showing the 10 largest contributions to committees formed primarily for and against Prop <?php echo $proposition_number; ?> in the election cycle when it appeared on the ballot. Contributions in earlier election cycles and contributions between allied committees are excluded. For more information on funding for ballot measure campaigns, visit our Campaign Finance <a href="http://powersearch.sos.ca.gov/" target="_blank">Power Search</a>.
        </p>
    </div>

    <script>
    function toggleUnitemizedText(elementId) {
        var element = $('#'+elementId);
        if (element.css('display') == 'none') {
            element.css('display', 'block');    
        }
        else {
            element.css('display', 'none');
        }
    }
    </script>

    <div class="row">
        <div class="col-md-6" style="margin-bottom:30px;">
            <h4 style="background-color: #ebebeb;margin: 0px;padding: 15px;">
                <span style="color:#0A6ABA;">Yes</span> on Prop <?php echo $proposition_number; ?>
            </h4>

            <?php if (isset($proposition['top_contributors']['SUPPORT'])) { ?>
                <?php 
                // making this always false for now until we make this page
                $showMoreYesLink = false; 
                ?>
                <?php foreach ($proposition['top_contributors']['SUPPORT'] as $item) { ?>
                    <div class="row" style="background-color: #ebebeb;padding: 10px 0px;margin: 0px;">
                        <div class="col-xs-6" style="width: 60%;padding-right:0px;">
                            <?php echo $item->Donor; ?>
                            <?php if ($proposition['top_contributors']['show_unitemized_support'] && $item->Date == null) { ?>
                                <span class="glyphicon glyphicon-question-sign" onclick="toggleUnitemizedText('unitemized-yes-text');" aria-hidden="true" style="cursor: pointer;"></span>
                            <?php } ?>
                            <br/>
                            <?php if ($proposition['top_contributors']['show_unitemized_support'] && $item->Date == null) { ?>
                                <span/>
                            <?php } else { ?>
                                <span style="font-size:12px; color: #6a6a6a;"> <?php echo $item->Date; ?></span>
                            <?php } ?>
                        </div>
                        <div class="col-xs-6" style="text-align: right;width: 40%;">
                            <?php echo $item->Amount; ?>
                        </div>
                        <?php if ($proposition['top_contributors']['show_unitemized_support'] && $item->Date == null) { ?>
                            <div class="col-xs-12" id="unitemized-yes-text" style="font-size:12px;display:none;margin-top:5px;">
                                <?php echo $proposition['unitemized_text'] ?>
                            </div>
                        <?php } ?>
                    </div>

                <?php } ?>

                <?php if($showMoreYesLink) { ?>
                <div style="background-color: #ebebeb;padding: 15px 15px 30px;margin: 0px;">
                    <a href="<?php echo $proposition["number"]; ?>/contributions/no">More Contributions to Yes
                        on <?php echo $proposition_number; ?></a>
                </div>
                <?php } ?>

            <?php } else { ?>

                <div style="background-color: #ebebeb;padding: 10px 15px 30px;margin: 0px;">
                    No contributions have been reported to the No on <?php echo $proposition["number"]; ?> campaign in the election cycle when it appeared on the ballot.
                </div>
            <?php } ?>
        </div>

        <div class="col-md-6">
            <h4 style="background-color: #ebebeb;margin: 0px;padding: 15px;">
                <span style="color:#054376;">No</span> on Prop <?php echo $proposition_number; ?>
            </h4>

            <?php if (isset($proposition['top_contributors']['OPPOSE'])) { ?>
                <?php 
                // making this always false for now until we make this page
                $showMoreLink = false; 
                ?>
                <?php foreach ($proposition['top_contributors']['OPPOSE'] as $item) { ?>
                    <div class="row" style="background-color: #ebebeb;padding: 10px 0px;margin: 0px;">
                        <div class="col-xs-6" style="width: 60%;padding-right:0px;">
                            <?php echo $item->Donor; ?>
                            <?php if ($proposition['top_contributors']['show_unitemized_oppose'] && $item->Date == null) { ?>
                                <span class="glyphicon glyphicon-question-sign" onclick="toggleUnitemizedText('unitemized-no-text');" aria-hidden="true" style="cursor: pointer;"></span>
                            <?php } ?>
                            <br/>
                            <?php if ($proposition['top_contributors']['show_unitemized_oppose'] && $item->Date == null) { ?>
                                <span/>
                            <?php } else { ?>
                                <span style="font-size:12px; color: #6a6a6a;"> <?php echo $item->Date; ?></span>
                            <?php } ?>
                        </div>
                        <div class="col-xs-6" style="text-align: right;width:40%">
                            <?php echo $item->Amount; ?>
                        </div>
                        <?php if ($proposition['top_contributors']['show_unitemized_oppose'] && $item->Date == null) { ?>
                            <div class="col-xs-12" id="unitemized-no-text" style="font-size:12px;display:none;margin-top:5px;">
                                <?php echo $proposition['unitemized_text'] ?>
                            </div>
                        <?php } ?>
                    </div>

                <?php } ?>

                <?php if($showMoreLink) { ?>
                <div style="background-color: #ebebeb;padding: 15px 15px 30px;margin: 0px;">
                    <a href="<?php echo $proposition["number"]; ?>/contributions/no">More Contributions to No
                        on <?php echo $proposition_number; ?></a>
                </div>
                <?php } ?>

            <?php } else { ?>

                <div style="background-color: #ebebeb;padding: 10px 15px 30px;margin: 0px;">
                    No contributions have been reported to the No on <?php echo $proposition["number"]; ?> campaign in the election cycle when it appeared on the ballot.
                </div>
            <?php } ?>
        </div>
    </div>


</div>

<div>
    <h2 class="section_headers">
        What your vote means
    </h2>

    <div class="row">
        <div class="col-md-6">
            <!-- <div> -->
            <h2 class="floated_section_sub_headers">
                Yes
            </h2>
            <!-- <div style="position: absolute;bottom: 0px;"> -->

            <!-- </div> -->
            <p style="margin-bottom: 10px;">
                <?php echo $proposition['text'][0]->WhatYourVoteMeansYes; ?>
            </p>
        </div>

        <div class="col-md-6">
            <h2 class="floated_section_sub_headers">
                No
            </h2>

            <p style="margin-bottom: 0px;">
                <?php echo $proposition['text'][0]->WhatYourVoteMeansNo; ?>
            </p>
        </div>
    </div>
</div>
<div>
    <h2 class="section_headers">
        More on Proposition <?php echo $proposition_number; ?>
    </h2>

    <p>
    	For background on Proposition <?php echo $proposition_number; ?>, an analysis by the legislative analyst, endorsements for and against the measure, and more...        
    </p>
    <ul>
    	<li>Read the <a href="http://voterguide.sos.ca.gov/" target="_blank">California Voter Information Guide</a>.</li>
    </ul>

</div>

<div>
    <h2 class="section_headers">
        Arguments
    </h2>

    <div class="row">
        <div class="col-md-6">
            <h2 class="floated_section_sub_headers">
                Pro
            </h2>

            <p style="margin-bottom: 10px;">
                <?php echo $proposition['text'][0]->ArgumentsPro; ?>
            </p>
        </div>

        <div class="col-md-6">
            <h2 class="floated_section_sub_headers">
                Con
            </h2>

            <p style="margin-bottom: 0px;">
                <?php echo $proposition['text'][0]->ArgumentsCon; ?>
            </p>
        </div>
    </div>
</div>

<div>
    <h2 class="section_headers">
        Campaigns
    </h2>

    <div class="row">
        <div class="col-md-6">
            <h2 class="floated_section_sub_headers_contact" style="margin-top: 10px;">
                For
            </h2>

            <div style="margin-bottom: 10px;">
                <?php echo $proposition['text'][0]->AdditionalInformationFor; ?>
            </div>
        </div>

        <div class="col-md-6">
            <h2 class="floated_section_sub_headers_contact" style="margin-top: 10px;">
                Against
            </h2>

            <div><?php echo $proposition['text'][0]->AdditionalInformationAgainst; ?>
            </div>
        </div>
    </div>
</div>
<div>
    <h2 class="section_headers">
        Vote
    </h2>

    <div class="row">
        <div class="col-md-12">
            <ul>
                <li style=" padding-bottom: 10px;"><a style="text-decoration: underline;"
                                                      href="http://registertovote.ca.gov/" target="_blank">Register to
                        vote</a></li>
                <li><a style="text-decoration: underline;" href="http://www.sos.ca.gov/elections/polling-place/"
                       target="_blank">Find your polling place</a>
                </li>
            </ul>

        </div>
    </div>

    <div style="text-align: center;margin-top: 20px;" class="row hidden-xs hidden-sm">
        <div style="vertical-align: middle;" class="col-md-6">
            <div class="form-group"


                <?php if ($prevProp != "") {
                    echo "style='padding-right: 10px; text-align: center;'";
                } ?>>
                <a style="float: left"
                   href="<?php echo base_url() . 'propositions/' . $this->uri->segment(2) . '/' . $prevProp; ?>">
                   <?php 
                   if ($prevProp != "") {
                   		echo "<div style='font-size:30px;float:left;' class='glyphicon glyphicon-menu-left gi-2x'></div><div  style='font-size:20px;float:left;' id='link-text'>" . 'Prop ' . $prevProp . "</div>";
                    } 
                    ?>
                </a>
                <a style="color:#333;"
                   href="<?php echo base_url() . 'propositions/' . $this->uri->segment(2) . '/' . $prevProp; ?>">
                    <?php echo "<div style='font-size:12px;margin-left:10px;text-align:left;float:left;width:50%;'>" . $prevPropName . "</div>" ?>
                </a>
            </div>

        </div>
        <div class="col-md-6">

            <div class="form-group">


                <a href="<?php echo base_url() . 'propositions/' . $this->uri->segment(2) . '/' . $nextProp; ?>"><?php if ($nextProp != "") {
                        echo " <div style='font-size:30px;float:right;' class='glyphicon glyphicon-menu-right gi-2x'></div> <div  style='font-size:20px;float:right;' id='link-text'>" . 'Prop ' . $nextProp . "</div>";
                    } ?>

                </a>
                <a href="<?php echo base_url() . 'propositions/' . $this->uri->segment(2) . '/' . $nextProp; ?>"
                	style="color:#333;">
                <?php echo "<div style='margin-right:10px;text-align:right;width:50%;float:right;font-size:12px;' id='nextPropName'>" . $nextPropName . '</div>'; ?>
                </a>
            </div>

        </div>
    </div>

