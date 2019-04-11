<?php
session_start();
include("inc/header.php");

$results = mysqli_query($con, "SELECT * FROM `rss`" );



while ( $row = mysqli_fetch_array( $results ) ) {
$userId = $_SESSION['user_id'];	


	
	$rssResult = mysqli_query( $con,"
			SELECT *
			FROM `rss`
			
			INNER JOIN `subscribe`
			ON `rss`.`rss_id` = `subscribe`.`rss_id`
			
			INNER JOIN `subscribe`
			ON `users`.`user_id` = `subscribe`.`user_id`
			
			WHERE `users`.`user_id` = {$userRow['user_id']}
		" );

	while ( $rssRow = mysqli_fetch_array( $rssResult ) ) {
		
		echo $rssRow['rss_name'];
	
		
	?>	

<div>
<h2><?php echo $rssRow['rss_name']; ?><br/></h2>

</div>
	<?php }
	
	?>




	
<?php 
}
?>

</body>
</html>
