<?php
include( "inc/header.php" );
include( "inc/form_handlers/rss_handler.php" );
?>

<div class="container-fluid splash-left6">
<?php include 'inc/nav.php' ?>

		<h1 class="splash-msg" style="margin-left: 2.5em; margin-bottom: 1em;">Add up to 3 of your own feeds to view privately</h1>
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

				<div class="col-md-4 setting-field text-center">
					<p><script type="text/javascript">

					rssfeed_url = new Array();
					rssfeed_url[0]= "<?php echo $rss_feed_1; ?>" ;
					rssfeed_frame_width="500";
					rssfeed_frame_height="600";
					rssfeed_scroll="on";
					rssfeed_scroll_step="6";
					rssfeed_scroll_bar="off";
					rssfeed_target="_blank";
					rssfeed_font_size="12";
					rssfeed_font_face="";
					rssfeed_border="on";
					rssfeed_css_url="";
					rssfeed_title="on";
					rssfeed_title_name="";
					rssfeed_title_bgcolor="#494949";
					rssfeed_title_color="#fff";
					rssfeed_title_bgimage="";
					rssfeed_footer="off";
					rssfeed_footer_name="rss feed";
					rssfeed_footer_bgcolor="#fff";
					rssfeed_footer_color="#333";
					rssfeed_footer_bgimage="";
					rssfeed_item_title_length="50";
					rssfeed_item_title_color="black";
					rssfeed_item_bgcolor="#fff";
					rssfeed_item_bgimage="";
					rssfeed_item_border_bottom="on";
					rssfeed_item_source_icon="off";
					rssfeed_item_date="off";
					rssfeed_item_description="on";
					rssfeed_item_description_length="120";
					rssfeed_item_description_color="#494949";
					rssfeed_item_description_link_color="#333";
					rssfeed_item_description_tag="on";
					rssfeed_no_items="0";
					rssfeed_cache = "15d00537bd853f08c26a5e1fb32b66c2";


					</script>
					<script type="text/javascript" src="//feed.surfing-waves.com/js/rss-feed.js"></script>
					<input type="text" name="user_rss_feed_1" value="<?php echo $rss_feed_1; ?>">
				</div>



				<div class="col-md-4 setting-field text-center">

					<input type="text" name="user_rss_feed_2" value="<?php echo $rss_feed_2; ?>">
				</div>




				<div class="col-md-4 setting-field text-center">

				
					<input type="text" name="user_rss_feed_3" value="<?php echo $rss_feed_3; ?>">
				</div>

			</div>
			<br>


			<?php echo $message; ?>
			<div class="col-md-12 text-center">
				<p style="color: white;">**Add a feed url into the field and click Update Feed Details to view your feed.</p>
				<input type="submit" name="update_details" id="save_details" value="Update Details"><br>
	<br>
		<br>


	</div>





</div>


    <script>
    if ( window.history.replaceState ) {
      window.history.replaceState( null, null, window.location.href );
    }
    </script>
