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
<script type="text/javascript">

var userid = 0;

$(document).ready(function() {
	userid = getUrlParameter("userid");

	selectSubscriptions();

	$(document).on("click", '.sublink', function(event) {
			//alert($(this).attr("rssid"));

			rssid = $(this).attr("rssid");
			action = $(this).attr("action");

			$.ajax({
			beforeSend: function() {
				$("#loading").show();
			},
			complete: function() {
				$("#loading").hide();
			},
			type: 'GET',
			dataType: "jsonp",
			jsonp: "callback",
			url: "//localhost/webflix-1/mng_subscription.php?action=" + action + "&user_id=" + userid + "&rss_id=" + rssid,

			success: function(data) {

				responseString="";

				$.each(data, function (index, item) {
						// Use item in here
						responseString = item;
				});

				if(responseString.indexOf("SUCCESS")>-1) {

						//get rest of data after prefix (LOGGEDIN:)
						//the number is the character position to start from, we cut off the prefix
						$("#messages").html(responseString.substring(8));

						selectSubscriptions();

					}
				if(responseString.indexOf("FAIL")>-1) {

					//get rest of data after prefix (NOTFOUND:)
					//the number is the character position to start from, we cut off the prefix
					$("#messages").html(responseString.substring(5));

				}

			},
			error: function (jqXHR, textStatus, errorThrown) {
				if (jqXHR.status == 500) {
									$("#messages").html('Internal error: ' + jqXHR.responseText);
							} else {
									$("#messages").html('Unexpected error.');
							}
			}
		});

		return false;
	});

	$(document).on("click", '.rsslink', function(event) {
			location.href="comments.php?userid=" + userid + "&rssid=" + $(this).attr("rssid");
			return false;
		});

});

function selectSubscriptions() {

	$("#subcontent").html("");

	$.ajax({
		beforeSend: function() {
			$("#loading").show();
		},
		complete: function() {
			$("#loading").hide();
		},
		type: 'GET',
		dataType: "jsonp",
		jsonp: "callback",
		url: "//localhost/webflix-1/mng_subscription.php?action=select&user_id=" + userid,

		success: function(data) {

			responseString="";

			$.each(data, function (index, item) {
					// Use item in here
					responseString = item;
			});

			$("#subcontent").html(responseString);

		},
		error: function (jqXHR, textStatus, errorThrown) {
			if (jqXHR.status == 500) {
								$("#messages").html('Internal error: ' + jqXHR.responseText);
						} else {
								$("#messages").html('Unexpected error.');
						}
		}
	});



}

</script>

<html>
<script type="text/javascript">
$(document). ready(function(){
$(".sublink"). click(function(){
location. reload(true);
});
});
</script>
<body class="wow fadeIn" data-wow-duration="1s" data-wow-delay="0.2s">
	<!--------------------------------MOBILE ADMIN---------------------------------->

	<div class="container-fluid splash-left6">
		<div class="row">

			<div>

				<?php
				if ( $_SESSION[ 'user_level' ] == 'admin' ) {
					echo '<a class="adminlink" href="admin.php"><h3>Admin</h3></a>';
				}
				?>

			</div>


		</div>
	<?php include( "inc/nav.php" ); ?>
		<h1 class="splash-msg wow fadeIn"  data-wow-duration="2s" data-wow-delay="1.5s"
	 style="margin-top: 4%; margin-bottom: 4%; margin-left: 5%;">Movie RSS feeds
	 <span class="wow fadeIn" data-wow-duration="2s" data-wow-delay="2s">for your indulgence..</span>
 </h1>
		<div class="row" style="margin-bottom: 5%; padding-left: 3%;">
<div class="col-md-3 text-center">
	<p class="splash-msg" style="font-size: 25px; margin-top: 0;">Manage your subscriptions & access full feeds with comments below</p>

	<div id="messages">

  </div>
  <div class="text-center" id="subcontent" style="padding: 4%;">

  </div>
</div>
<div class="col-md-9">
	<div class="row">
			<?php
			//loop through each row from results
			while ($row=mysqli_fetch_array($result)) {
			?>
<div class="col-md-2 col-sm-4 text-center wow fadeIn"  data-wow-duration="2s" data-wow-delay="2.5s"
style="margin-bottom: 3%; margin-right: 2%;">
	<div class="rss_tile" style="width: 100%; background-color: #494949; border-radius: 25px; margin-left: 5%;">




					<img class="listingsthumb img-responsive" src="<?php echo $row['rss_image']; ?>"
					    style="width: 55%; border-radius: 25px; padding-top: 2%;"/>
						<hr/>
					<h5 class="listingname">
					<strong>	<?php echo $row['rss_name']; ?> </strong></h5></a>
						<hr/>
						<!-- start sw-rss-feed code -->
			<p><script type="text/javascript">

			rssfeed_url = new Array();
			rssfeed_url[0]= "<?php echo $row['rss_url']; ?>" ;
			rssfeed_frame_width="180";
			rssfeed_frame_height="200";
			rssfeed_scroll="on";
			rssfeed_scroll_step="6";
			rssfeed_scroll_bar="off";
			rssfeed_target="_blank";
			rssfeed_font_size="12";
			rssfeed_font_face="";
			rssfeed_border="on";
			rssfeed_css_url="";
			rssfeed_title="off";
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
			rssfeed_cache = "<?php echo $row['rss_feed_cache']; ?>";


			</script>
			<script type="text/javascript" src="//feed.surfing-waves.com/js/rss-feed.js"></script>





<br/>



			</div>
			</div>
				<br/>





				<?php
				} // end while loop
				?>

</div>
</div>
		</div>
		<?php include 'inc/footer.php' ?>
	</div>

</body>

</html>
