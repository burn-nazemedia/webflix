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
	<div class="container-fluid">
		<div class="row">

			<div>



				<?php 
			//loop through each row from results
			while ($row=mysqli_fetch_array($result)) {
			?>
				
				<a href="rss_detail.php?id=<?php echo $row['rss_id']; ?>">


					<h1 class="listingname">
						<?php echo $row['rss_name']; ?> </h1>
					<img class="listingsthumb img-responsive" src="<?php echo $row['rss_image']; ?>" width="200"/>
					<p>
						<?php echo $row['rss_url']; ?>
					</p>
				<form method="post" enctype="multipart/form-data" action="mng_subscription.php"><br />
		<input type="hidden" name="id" value="<?php echo $_GET['user_id'];?>"/>
		<input type="hidden" name="action" action="subscribe" value="subscribe"/><br />
		
		<input type="submit" class="adminsubmit" value="Subscribe" />
	</form>
				

				</a>
				<br/>
				
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
rssfeed_title_bgcolor="#3366ff"; 
rssfeed_title_color="#fff"; 
rssfeed_title_bgimage=""; 
rssfeed_footer="off"; 
rssfeed_footer_name="rss feed"; 
rssfeed_footer_bgcolor="#fff"; 
rssfeed_footer_color="#333"; 
rssfeed_footer_bgimage=""; 
rssfeed_item_title_length="50"; 
rssfeed_item_title_color="#666"; 
rssfeed_item_bgcolor="#fff"; 
rssfeed_item_bgimage=""; 
rssfeed_item_border_bottom="on"; 
rssfeed_item_source_icon="off"; 
rssfeed_item_date="off"; 
rssfeed_item_description="on"; 
rssfeed_item_description_length="120"; 
rssfeed_item_description_color="#666"; 
rssfeed_item_description_link_color="#333"; 
rssfeed_item_description_tag="off"; 
rssfeed_no_items="0"; 
rssfeed_cache = "9e9768a2cf51bf44252216f46af129d6";
//--> 
</script> 
<script type="text/javascript" src="//feed.surfing-waves.com/js/rss-feed.js"></script> 

<!-- end sw-rss-feed code -->
</p>
				
				

				<?php
				} // end while loop
				?>
			</div>

		</div>
	</div>

</body>

</html>