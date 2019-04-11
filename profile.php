<?php
session_start();
include( 'inc/header.php' );
if ( isset( $_GET[ 'profile_username' ] ) ) {
	$username = $_GET[ 'profile_username' ];
	$user_details_query = mysqli_query( $con, "SELECT * FROM users WHERE username='$username'" );
	$user_array = mysqli_fetch_array( $user_details_query );


}
?>
<?php
//fetch all user information
$userId = $_SESSION[ 'user_id' ];
$result = mysqli_query( $con, "SELECT *
								FROM `users` WHERE `user_id`={$userId}" );
while ( $row = mysqli_fetch_array( $result ) ) {

	?>
	<h2>
		Welcome <?php echo $row['username']; ?><br/>
	</h2>
	<img width="200px" src="<?php echo $row['profile_pic']?>">
	<?php
	}
	?>

<h1>Your subscriptions</h1>

<?php
//set user logged as session variable
$userId = $_SESSION[ 'user_id' ];
//get all RSS feeds
$rssResult = mysqli_query( $con,
	"SELECT *
								FROM `rss`" );



//flag to see if match with user (if they are subscribed)
$matchFlag = false;




//get subscriptions linked with user id
$userResult = mysqli_query( $con,
	"SELECT *
							FROM `rss`
							INNER JOIN `subscribe`
							ON `subscribe`.`rss_id` = `rss`.`rss_id`
							WHERE `subscribe`.`user_id`={$userId}" );

//this nested loop is for the subscription query
while ( $subRow = mysqli_fetch_array( $userResult ) ) {

	
	?>
<div>

	<h2><!--Loop through names of subscribed rss feeds-->
		<?php echo $subRow['rss_name']; ?><br/>
	</h2>

</div>
<?php
}// end of while loop
?>



	</body>
	</html>