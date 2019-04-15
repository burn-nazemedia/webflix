<?php
include("inc/header.php");

$results = mysqli_query($con, "SELECT * FROM `users`" );

while ( $row = mysqli_fetch_array( $results ) ) {
	?>

<?php

	$rssResult = mysqli_query( $con,"
			SELECT *
			FROM `rss`

			INNER JOIN `subscribe`
			ON `rss`.`rss_id` = `subscribe`.`rss_id`

			INNER JOIN `users`
			ON `users`.`user_id` = `subscribe`.`user_id`

			WHERE `users`.`user_id` = {$userRow['user_id']}
		" );

	while ( $rssRow = mysqli_fetch_array( $rssResult ) ) {




	?>

<div>
<h2 style="color: white;"><?php echo $rssRow['rss_name']; ?><br/></h2>

</div>
	<?php }

	?>





<?php
}
?>

</body>
</html>
