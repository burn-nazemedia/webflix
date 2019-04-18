<?php
session_start();
include("inc/header.php");
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




		<main style="background-color: black;">

			<?php
if ( $_SESSION[ 'user_id' ] == '4' ) {
	echo '<a class="adminlink" href="admin.php"><h3>userid</h3></a>';

}
?>
			<div id="messages">

			</div>
			<div class="col-md-4" id="subcontent">

			</div>

		</main>



		<img src="images/loading.gif" id="loading" />

	</body>
</html>
