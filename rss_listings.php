<?php
session_start();
//include database connection
include( "inc/header.php" );

if ( isset( $_GET[ 'searchterm' ] ) ) {

	$result = mysqli_query( $con,
		"SELECT *
				 FROM `rss`
				 WHERE `rss_name` LIKE '%{$_GET['searchterm']}%'"
	);

} else if ( isset( $_GET[ 'name' ] ) ) {

	$result = mysqli_query( $con,
		"SELECT *
				 FROM `rss`
				 WHERE `rss_name`='{$_GET['name']}'"
	);








} else {
	$result = mysqli_query( $con,
		"SELECT *
				 FROM `rss`"
	);
}
?>
<body class="wow fadeIn" data-wow-duration="1s" data-wow-delay="0.2s">
	<!--------------------------------MOBILE ADMIN---------------------------------->
	<div class="container-fluid">

		<div class="row">

			<div>

				<?php
				if ( $_SESSION[ 'user_level' ] == 'admin' ) {
					echo '<a class="adminlink" href="admin.php"><h3>Admin</h3></a>';
				}
				?>

			</div>


		</div>
	</div>
	<div class="container-fluid splash-left5">
	<?php include( "inc/nav.php" ); ?>
		<h1 class="splash-msg wow fadeIn"  data-wow-duration="2s" data-wow-delay="1.5s"
	 style="margin-top: 4%; margin-bottom: 4%; margin-left: 5%;">Movie RSS feeds
	 <span class="wow fadeIn" data-wow-duration="2s" data-wow-delay="2s">for your indulgence..</span>
 </h1>
		<div class="row" style="margin-bottom: 5%; padding-left: 3%;">

			<?php
			//loop through each row from results
			while ($row=mysqli_fetch_array($result)) {
			?>
<div class="col-md-3 text-center wow fadeIn"  data-wow-duration="2s" data-wow-delay="2.5s" style="margin-bottom: 3%;">
	<div style="width: 80%; background-color: #494949; border-radius: 25px; margin-left: 10%;">
				<a id="rss_link" href="rss_detail.php?id=<?php echo $row['rss_id']; ?>">



					<img class="listingsthumb img-responsive" src="<?php echo $row['rss_image']; ?>"
					    style="width: 45%; border-radius: 25px; padding-top: 2%;"/>
						<hr/>
					<h2 class="listingname">
						<?php echo $row['rss_name']; ?> </h2></a>
						<hr/>


						<!-- start sw-rss-feed code -->
			<p><script type="text/javascript">
			<!--
			rssfeed_url = new Array();
			rssfeed_url[0]= "<?php echo $row['rss_url']; ?>" ;
			rssfeed_frame_width="230";
			rssfeed_frame_height="260";
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
			rssfeed_title_bgcolor="#ff8d3f";
			rssfeed_title_color="#494949";
			rssfeed_title_bgimage="";
			rssfeed_footer="off";
			rssfeed_footer_name="rss feed";
			rssfeed_footer_bgcolor="#fff";
			rssfeed_footer_color="#333";
			rssfeed_footer_bgimage="";
			rssfeed_item_title_length="50";
			rssfeed_item_title_color="#ff8d3f";
			rssfeed_item_color="#ff8d3f";
			rssfeed_item_bgcolor="#494949";
			rssfeed_item_bgimage="";
			rssfeed_item_border_bottom="on";
			rssfeed_item_source_icon="off";
			rssfeed_item_date="off";
			rssfeed_item_description="on";
			rssfeed_item_description_length="120";
			rssfeed_item_description_color="#fff";
			rssfeed_item_description_link_color="#494949";
			rssfeed_item_description_tag="off";
			rssfeed_no_items="0";
			rssfeed_cache = "9e9768a2cf51bf44252216f46af129d6";
			//-->

			</script>
			<script type="text/javascript" src="//feed.surfing-waves.com/js/rss-feed.js"></script>


			<form method="post" enctype="multipart/form-data" action="mng_subscription.php">
		<input type="hidden" name="id" value="<?php echo $_GET['user_id'];?>"/>
		<input type="hidden" name="action" action="subscribe" value="subscribe"/>


		<input type="submit" class="adminsubmit btn btn-primary register" value="Subscribe" />
	</form>




			</div>
			</div>
				<br/>





				<?php
				} // end while loop
				?>


		</div>
	</div>

</body>

</html>
