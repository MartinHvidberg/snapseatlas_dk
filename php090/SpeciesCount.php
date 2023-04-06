<?php

// Author: Martin Hvidberg
// Last edit: 2020-07-08 / mh

// history
// 150723 : Init
// 200808 : Cosmetic

///header('Content-Type: application/json');

/* Set internal character encoding to UTF-8 */
mb_internal_encoding("UTF-8");
/* Display current internal character encoding */
//echo mb_internal_encoding();

/* Open mysqli connection */
require 'db.php';  // defines $db, the data base connection
if ($db->connect_errno) {
	echo "Failed to connect to MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
}
$db->set_charset("utf8");

/* Select queries return a resultset */
$sql = "select distinct `species`,`plantenavn`,count(`species`) as CountOf from occurrence group by `species` ORDER BY CountOf DESC";

if(!$result = $db->query($sql)){
	echo 'something wrong with that sql statement ...';
	die('There was an error running the query [' . $db->error . ']');
} else {
	echo '<!DOCTYPE html><html><head><meta charset="UTF-8"></head><body>';
	echo '<table  border="1" style="width:100%">';
	echo '<tr><th>Plantenavn (Dansk)</th><th>Plantenavn (Latin)</th><th>Antal i Snapseatlas.dk</th></tr>';
	while($row = $result->fetch_assoc()){
		echo '<tr><td>',$row['plantenavn'],'</td><td>',$row['species'],'</td><td>',$row['CountOf'],'</td></tr>';
	}
	echo '</table></body></html>';
	
	/* free result set */
	$result->close();
}
$db->close();
?>
