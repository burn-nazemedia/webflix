<?php
include( "inc/header.php" );
include( "inc/form_handlers/rss_handler.php" );
?>
	<style>
p {
	color: white;
}
input {
	color: black;
}
	</style>
<div class="main-wrap col-md-12">
	<div class="main_column column settings-div col-md-6 col-md-offset-3">

		<h1 style="color:#1f1f1f">Rss Settings</h1>
		<br>
		
		<?php
		$user_data_query = mysqli_query( $con, "SELECT email, user_rss_feed_1, user_rss_feed_2, user_rss_feed_3 FROM users WHERE username='$userLoggedIn'" );
		$row = mysqli_fetch_array( $user_data_query );

		$rss_feed_1 = $row[ 'user_rss_feed_1' ];
		$rss_feed_2 = $row[ 'user_rss_feed_2' ];
		$rss_feed_3 = $row[ 'user_rss_feed_3' ];
		$email = $row['email'];

		?>

		<form action="rss.php" method="POST">
			<div class="row">
				<div class="col-md-2">
					<p class="setting-place">RSS Feed 1:</p>
				</div>
				<div class="col-md-6 setting-field"><input type="text" name="user_rss_feed_1" value="<?php echo $rss_feed_1; ?>">
				</div>

			</div>
			<br>
			<div class="row">
				<div class="col-md-2">
					<p class="setting-place">RSS Feed 2</p>
				</div>
				<div class="col-md-6 setting-field"><input type="text" name="user_rss_feed_2" value="<?php echo $rss_feed_2; ?>">
				</div>

			</div>
			<br>
			<div class="row">
				<div class="col-md-2">
					<p class="setting-place">RSS Feed 3:</p>
				</div>
				<div class="col-md-6 setting-field"><input type="text" name="user_rss_feed_3" value="<?php echo $rss_feed_3; ?>">
				</div>

			</div>
			<br>

			<br>
			<?php echo $message; ?>
			<div class="col-md-2 col-md-offset-4">
				<input type="submit" name="update_details" id="save_details" value="Update Details"><br>
	<br>
		<br>


	</div>
	<br>
	<br>
	<h4>Close Account</h4>


</div>
<br>
<br>
</div>
<br>
<br>
	
    <script>
    if ( window.history.replaceState ) {
      window.history.replaceState( null, null, window.location.href );
    }
    </script>vb
    