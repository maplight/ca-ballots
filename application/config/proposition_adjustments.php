<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| PROPOSITION ADJUSTMENT SETTINGS
| -------------------------------------------------------------------
| This file contains the proposition adjustment dollar values for 
| propositions where a manual adjustment is required.  An example is 
| a committee who had raised funds prior to officially supporting a 
| proposition.
|
| The data structure is a multidimensional array.  The first key is the
| PropositionID used in the ca-ballots database.  The second keys are
| 'yes' and 'no', with the associated proposition adjustments in dollars.
|
*/

$config['prop_adjustments']= array (
	// Election: 2016-11-08		Prop Num: 51	
	'1376258' => array(
		'yes' => '382950',
		'no' => '0'
	),
	// Election: 2016-11-08		Prop Num: 52
	'1362198' => array(
		'yes' => '47182506',
		'no' => '2500000'
	),
	// Election: 2016-11-08		Prop Num: 53
	'1376142' => array(
		'yes' => '0',
		'no' => '0'
	),
	// Election: 2016-11-08		Prop Num: 54
	'1381642' => array(
		'yes' => '0',
		'no' => '0'
	),
	// Election: 2016-11-08		Prop Num: 55
	'1382647' => array(
		'yes' => '-250000',
		'no' => '0'
	),
	// Election: 2016-11-08		Prop Num: 56
	'1381640' => array(
		'yes' => '0',
		'no' => '0'
	),
	// Election: 2016-11-08		Prop Num: 57
	'1383319' => array(
		'yes' => '-11278',
		'no' => '0'
	),
	// Election: 2016-11-08		Prop Num: 58
	'1382395' => array(
		'yes' => '-26573',
		'no' => '0'
	),
	// Election: 2016-11-08		Prop Num: 59
	'1386783' => array(
		'yes' => '0',
		'no' => '0'
	),
	// Election: 2016-11-08		Prop Num: 60
	'1376195' => array(
		'yes' => '22131',
		'no' => '0'
	),
	// Election: 2016-11-08		Prop Num: 61
	'1377343' => array(
		'yes' => '0',
		'no' => '0'
	),
	// Election: 2016-11-08		Prop Num: 62
	'1381268' => array(
		'yes' => '0',
		'no' => '-1179353'
	),
	// Election: 2016-11-08		Prop Num: 63
	'1381803' => array(
		'yes' => '0',
		'no' => '0'
	),
	// Election: 2016-11-08		Prop Num: 64
	'1381868' => array(
		'yes' => '-2455864',
		'no' => '0'
	),
	// Election: 2016-11-08		Prop Num: 65
	'1381520' => array(
		'yes' => '3257500',
		'no' => '0'
	),
	// Election: 2016-11-08		Prop Num: 66
	'1381724' => array(
		'yes' => '309646',
		'no' => '-60000'
	),
	// Election: 2016-11-08		Prop Num: 67
	'1372638' => array(
		'yes' => '283200',
		'no' => '3257500'
	),
);

