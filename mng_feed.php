<?php
include("inc/dbconnect.inc.php");

$callback = $_GET['callback'];

echo $callback . "(";

$response = "";

$userId = $_SESSION['user_id'];
$rssid = $_GET['rssid'];

$result = mysqli_query($con,"SELECT * 
						FROM `rss`
						WHERE `rss_id`={$rssid}");

$remoteFeed = "";

while($row = mysqli_fetch_array($result)) {
	$remoteFeed = $row['rss_url'];
}

$feed = file_get_contents($remoteFeed);

if ($feed !== FALSE) {  
 	$response .=   $feed;
 }

$array = array("response" => $response);

echo json_encode($array);

echo ")";