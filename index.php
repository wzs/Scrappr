<?php

require 'Slim/Slim.php';
require 'lib/phpQuery.php';
require 'utils.php';

ini_set('max_execution_time', 0);
ini_set('display_errors', true);


$app = new Slim(array(
	'mode' => 'development',
));
error_reporting(E_ALL & ~E_NOTICE);

function g1() {
    Slim::getInstance()->render('index.php', array(
    	'increase' 	=> "1",
    	'start'		=> "1",
    	'limit'		=> "0",
    	'format'	=> "",
    	'selector'	=> "",
    ));
}
$app->get('/', "g1");

function p1() {
    $format 	= $_POST['format'];
    $selector 	= $_POST['selector'];
    $increase 	= $_POST['increase'];
    $start 		= $_POST['start'];
    $limit 		= $_POST['limit'];  
    
    $entries = fetchEntries($format, $selector, $increase, $start, $limit);
   
	Slim::getInstance()->render('index.php', array(
   		'entries' 	=> $entries,
       	'increase' 	=> $increase,
   		'start' 	=> $start,
		'limit' 	=> $limit,
       	'format'  	=> htmlentities($format),
		'selector' 	=> htmlentities($selector),
   	));
}

$app->post('/', "p1");

$app->run();