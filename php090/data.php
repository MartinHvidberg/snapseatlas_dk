<?php

// Author: Martin Hvidberg, Morten Fuglsang
// Version 0.9.0
// Last edit: 2023-04-05 / mh, while moving to new ISP

// history
// 150719 : Introduced $inputBboxSpecies, and renamed $inputBbox to $inputBboxBbox
// 180513 : Trying to fix CORS problem
// 200128 : Trying to fix Use of undefined constant plantenavn - assumed 'plantenavn' - running good for years...
// 230405 : Pointing to new DB at new ISP

header('Content-Type: application/json');
//self.send_header('Access-Control-Allow-Origin', '*')

/* Set internal character encoding to UTF-8 */
//mb_internal_encoding("UTF-8");
/* Display current internal character encoding */
//echo mb_internal_encoding();

//echo $_GET["bbox"].'<br/>';
$inputBbox = $_GET["bbox"];
$inputBboxclean = trim($inputBbox,"\"");
$split = explode(",", $inputBboxclean);
$Emin = $split[0];
$Nmin = $split[1];
$Emax = $split[2];
$Nmax = $split[3];
//echo $_GET["species"].'<br/>';
$inputSpecies = $_GET["species"]; //Hypericum perforatum L.


/* Open mysqli connection */
require 'db.php';  // defines $db, the data base connection
if ($db->connect_errno) {
	echo "Failed to connect to MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
}
$db->set_charset("utf8");

/* Select queries return a resultset */
$sql = "SELECT * FROM occurrence WHERE (`species` LIKE '%".$inputSpecies."%') AND (`N` BETWEEN ".$Nmin." AND ". $Nmax.") AND (`E` BETWEEN ".$Emin." AND ". $Emax.")";
$geojson = array( 'type' => 'FeatureCollection', 'features' => array());

if ($result = $db->query($sql)) {

	if ($result->num_rows > 0) {
	    // output data of each row
	    while($row = $result->fetch_assoc()) {
	        
	        $marker = array(
	        		'type' => 'Feature',
	        		'features' => array(
	        				'type' => 'Feature',
	        				'properties' => array(
	        						'plantenavn' => "".$row['plantenavn']."",
	        						'species' => "".$row['species']."",
	        						'uncertainty' => "".$row['uncertainty']."",
	        						'date' => "".$row['date']."",
	        						'loctype' => "".$row['loctype']."",
	        						'locname' => "".$row['locname']."",
	        						'source' => "".$row['source'].""
	        				),
	        				"geometry" => array(
	        						'type' => 'Point',
	        						'coordinates' => array(
	        								$row['E'],
	        								$row['N']
	        						)
	        				)
	        		)
	        );
	        array_push($geojson['features'], $marker['features']);
	    }
	}

	//echo "This is data ...".'<br/>';
	//echo $inputBbox.'<br/>';
	echo json_encode($geojson);
	
	/* free result set */
	$result->close();
}

?>
