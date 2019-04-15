<?php
session_start();
//include database connection
include( "inc/header.php" );

$id = $_GET[ 'id' ];
//set miovie ID to ID variable
$result = mysqli_query( $con,
	"SELECT *
			 FROM `rss`
			 WHERE  `rss_id`={$id}"


);

?>

<!--popup to confirm deleting movie-->
<script type="text/javascript">


		function confirmChoice( productId ) {
			response = confirm( "Are you sure you want to delete?" );
			if ( response == 1 ) {
				window.location = "mng_movies.php?action=delete&id=" + productId;
			} else {
				return false;
			}
		}
	</script>


	<!-------------------------------ADMIN Link---------------------------------->
	<div class="container-fluid">
<?php include 'inc/nav.php' ?>
		<div class="row">

			<div class=" col-sm-12 hidden-md hidden-lg hidden-xl">

				<?php
				if ( $_SESSION[ 'user_level' ] == 'admin' ) {
					echo '<a class="adminlink" href="admin2.php"><h3>Admin</h3></a>';
				};
				?>

			</div>


			</div>
		</div>

	<?php
	//loop through each row from results
	while ($row=mysqli_fetch_array($result)) {
	?>
	<div class="container-fluid">

		<div class="row">

			<div class="col-md-8">
				<?php include("inc_search.inc.php"); ?>
				<div>
					<h1 class="itemheader">
						<?php echo $row['rss_name']; ?>
						<?php echo $row['rss_url']; ?>
					</h1>
					<img class="img-responsive" src="<?php echo $row['rss_image']; ?>" width="300"/>

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



					<!--Update and delete links for admin-->
					<?php

					if ( $_SESSION[ 'user_level' ] == 'admin' ) {
						?>
					<div class="adminproductlink">
					<a  href="javascript:confirmChoice (<?php echo $row['rss_id'];?>)">Delete?</a> | <a href="update_rss.php?action=update&id=<?php echo $row['rss_id'];?>">Update?</a> </div>
					<?php

					}

					?>

					<?php
					} // end while loop
					?>
				</div>
			</div>


		</div>

	</div>



<script type="text/javascript" src="js/bootstrap.js"></script>
</body>

</html>
