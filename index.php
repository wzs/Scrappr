<?php

require 'Slim/Slim.php';
require 'lib/phpQuery.php';
require 'utils.php';

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

    
   $templateData = array(
   		'entries' 	=> $entries,
       	'increase' 	=> $increase,
   		'start' 	=> $start,
		'limit' 	=> $limit,
       	'format'  	=> htmlentities($format),
		'selector' 	=> htmlentities($selector),
   	); 
   
   	
    if ($_POST['output'] == "sqlite") {
		$tmpFile = saveEntriesToSqlite($entries);
		$templateData['downloadId'] = substr(basename($tmpFile), strlen(SCRAPPR_PREFIX));
    }
    
	Slim::getInstance()->render('index.php', $templateData);
    
}

$app->post('/', "p1");


function p2($id) {
	
	$path = 'tmp/' . SCRAPPR_PREFIX . $id;
    
	header("Content-Type: application/force-download");
    header("Content-Disposition: attachment; filename=".SCRAPPR_PREFIX.date("Ymd").".db");
    header("Content-Length: " . filesize($path));
    readfile($path);
    
    //unlink($path); //FIXME unlink won't work, because readfile keeps file handle
}
$app->get('/download/:id', 'p2');

$app->run();