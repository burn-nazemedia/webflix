 <?php
session_start();
include( 'inc/header.php' );
if ( isset( $_GET[ 'profile_username' ] ) ) {
	$username = $_GET[ 'profile_username' ];
	$user_details_query = mysqli_query( $con, "SELECT * FROM users WHERE username='$username'" );
	$user_array = mysqli_fetch_array( $user_details_query );


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
<script type="text/javascript">
$(document). ready(function(){
$(".sublink"). click(function(){
location. reload(true);
});
});
</script>
<?php
//fetch all user information
$userId = $_SESSION[ 'user_id' ];
$result = mysqli_query( $con, "SELECT *
								FROM `users` WHERE `user_id`={$userId}" );
while ( $row = mysqli_fetch_array( $result ) ) {

	?>
	<body class="wow fadeIn" data-wow-duration="2s" data-wow-delay="1s">
	<div class="container-fluid splash-left2">

		<?php include 'inc/nav.php' ?>
		<div class="row" style="margin-top: 4em;">
			<div class="col-md-1"></div>
			<div class="col-md-3 text-center proftile" style="margin-right: 1em">
			<h2 id="welcome" class="" data-wow-duration="2s" data-wow-delay="0.9s" style="margin-top: 1em;">
				<span class="" data-wow-duration="2s" data-wow-delay="1.2s" id="webflix1">
				<strong style="padding: 3%;">	<?php echo $row['first_name']; ?> <?php echo $row['last_name']; ?></strong>
				</span>&nbsp;
			<br/>
			<br/>



	<img style="border-radius: 25px; opacity: 0.9; width: 40%;" src="<?php echo $row['profile_pic']?>">
	<br/>
	<br/>
	<h5 class="membsince" style="color: #d5d6d2;">	Member Since: <?php echo "<td>" . date("d/m/Y", strtotime($row['signup_date'])) . "</td>"; ?> </h5>
  <hr/>
  <a href="rss.php">Add & View Your Personal Feeds</a>
  <p class="splash-msg" style="font-size: 25px;">Manage your subscriptions & access full feeds with comments below</p>
  <div id="messages">

   </div>
   <div class="text-center" id="subcontent" style="padding: 4%;">

   </div>
</div>
<?php
}
?>
<div class="col-md-7 profSubs">
	<h2 class="profRssTitle">Your RSS Feed Subscriptions</h2>
	<br/>
	<div class="row" style="margin-top: 2em;">
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
		<div class="col-md-3 text-center">
			<img class="listingsthumb img-responsive" src="<?php echo $subRow['rss_image']; ?>"
					 style="width: 50%; border-radius: 25px;"/><br/>
					 <?php echo $subRow['rss_id']; ?>
			<h4 class="profRssName"><!--Loop through names of subscribed rss feeds-->
				<?php echo $subRow['rss_name']; ?>
			</h4>
			<!-- start sw-rss-feed code -->
<p><script type="text/javascript">

rssfeed_url = new Array();
rssfeed_url[0]= "<?php echo $subRow['rss_url']; ?>" ;
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
rssfeed_cache = "<?php echo $subRow['rss_feed_cache']; ?>";


</script>
<script type="text/javascript" src="//feed.surfing-waves.com/js/rss-feed.js"></script>

		</div>

		<?php
		}// end of while loop
		?>
		</div>
	</div>

</div>
<?php include 'inc/footer.php' ?>
</div>








	</body>
	</html>
