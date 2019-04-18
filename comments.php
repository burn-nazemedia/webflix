
<?php
session_start();
include("inc/header.php");
?>
<style>
h1 {
	font-size: 25px;
	color: #494949;
}
a {
	color: white;
}
#commentbtn {
	color: white;
	background-color: black;
	border: 0 !important;
	padding: 1%;
	border-radius: 25px;
}
#webflix {
	font-size: 40px;
}
#clearbtn {
	color: white;
	background-color: red;
	border: 0 !important;
	padding: 1%;
	border-radius: 25px;
}
</style>
		<script type="text/javascript">

		var commentsUpFlag = false;
		rssId = getUrlParameter("rssid");
		userId = getUrlParameter("userid");

//https://api.jquery.com/jQuery.parseXML/

		//FUNCTION TO PARSE RSS FEED --------------------------------------------------------------
		function getFeed (rsscontent) {

			var xml = rsscontent;
			 xmlDoc = $.parseXML( xml ),
			 $xml = $( xmlDoc ),
			 $channel = $xml.find( "channel" );
			 $channel.children().each(function() {

			 	if($(this).prop("tagName")=="title") {
					htmlString = "<div class='rsstitle'>";
					htmlString+= "<h1>" + $(this).text() + "</h1>";
					htmlString += "</div>";
			 		$("main").append(htmlString);
			 	}

			 	if($(this).prop("tagName")=="item") {

					htmlString = "<div class='rssitem'>";
			 		$(this).children().each(function() {


			 			if($(this).prop("tagName")=="title") {
			 				htmlString+= "<h1>" + $(this).text() + "</h1>";
			 			}
			 			if($(this).prop("tagName")=="description") {
			 				htmlString+= "<p>" + $(this).text() + "</p>";
			 			}
			 			if($(this).prop("tagName")=="link") {
			 				htmlString+= "<a href='" + $(this).text() + "'>Link</a>";
			 			}
			 		});

			 		htmlString += "</div>";

			 		$("main").append(htmlString);
			 	}

			 });
		}

		//DOCUMENT READY EVENT HANDLER =========================================================
		$(document).ready(function() {
			//RSS fEED RETRIEVER --------------------------------------------------------------

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
				url: "//localhost/webflix-1/mng_feed.php?rssid=" + rssId,
				success: function(data) {

					responseString="";
					$.each(data, function (index, item) {
				    // Use item in here
					    responseString = item;
					});

					getFeed(responseString);

					},
					error: function (jqXHR, textStatus, errorThrown) {
						if (jqXHR.status == 500) {
			                $("#messages").html('Internal error: ' + jqXHR.responseText);
			            } else {
			                $("#messages").html('Unexpected error.');
			            }
					}
				});

			//COMMENTS CONTAINER HEIGHT ANIMATION -----------------------------------------
			$( "#commentslink" ).click(function() {

				if(commentsUpFlag) {

				  	$("#commentscontainer").animate({
				    	bottom: "-400"
				  	}, 500, function() {
				    	commentsUpFlag = false;
				  	});

				} else {
				  	$("#commentscontainer").animate({
				    	bottom: "0"
				  	}, 500, function() {
				    	commentsUpFlag = true;
				  	});
				}
				return false;
			});

			//COMMENT RETRIEVAL -----------------------------------------
			selectComments();

			//CLEAR COMMENT TEXT BOX ------------------------------------------------------
			$("#clearbtn").click(function() {
				$("#commentbox").val('');
			});

			//UPDATE COMMENTS -------------------------------------------------------------
			$(document).on("click", '.updatecom', function(event) {
				var commentId = $(this).attr('comid');
				$('#commentbtn').attr('mode','update');
				$('#commentbtn').attr('commentid',commentId);
				$('#commentbtn').val('Edit Comment');


				var commentContent = "";

				//cycle through comments, if ID matchs, set textarea to have comment content
				$('.comment').each(function() {
					if($(this).attr('comid')==commentId) {
						$('#commentbox').val($(this).html());
					}
				});

			});

			//INSERT / UPDATE BUTTON CLICK =================================================

			$(document).on("click", '#commentbtn', function(event) {


			var ajaxString = "";
			var commentContent = $('#commentbox').val();

			if(commentContent=="") {
				alert("You need to enter more than nothing");
			} else {
				commentContent = encodeURI(commentContent);
			}

			//INSERT COMMENT - SEND --------------------------------------------------------


				if($(this).attr('mode')=='insert') {

					ajaxString = "action=insert&user_id=" + userId + "&rss_id=" + rssId + "&comment_content=" + commentContent;

				}


			//UPDATE COMMENTS - SEND -------------------------------------------------------

				if($(this).attr('mode')=='update') {

					ajaxString = "action=update&comment_id=" + $(this).attr('commentid') + "&comment_content=" + commentContent;

				}


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
					url: "//localhost/webflix-1/mng_comment.php?" + ajaxString,
					success: function(data) {

						responseString="";

						$.each(data, function (index, item) {
						    // Use item in here
						    responseString = item;
						});


						if(responseString.indexOf("SUCCESS")>-1) {

							//get rest of data after prefix (SUCCESS:)
							//the number is the character position to start from, we cut off the prefix
							responseString = responseString.substring(8);
							selectComments();
							$('#commentbtn').attr('mode','insert');
							$('#commentbtn').attr('commentid','');
							$('#commentbtn').val('Add Comment');
						}

						if(responseString.indexOf("FAIL")>-1) {

							//get rest of data after prefix (FAIL:)
							//the number is the character position to start from, we cut off the prefix
							responseString = responseString.substring(5);

						}

						$("#messages").html(responseString);

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


			//DELETE COMMENT ---------------------------------------------------------------
			$(document).on("click", '.deletecom', function(event) {

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
					url: "//localhost/webflix-1/mng_comment.php?action=delete&comment_id=" + $(this).attr('comid'),
					success: function(data) {

						responseString="";

						$.each(data, function (index, item) {
						    // Use item in here
						    responseString = item;
						});


						if(responseString.indexOf("SUCCESS")>-1) {

							//get rest of data after prefix (SUCCESS:)
							//the number is the character position to start from, we cut off the prefix
							responseString = responseString.substring(8);
							selectComments();

						}

						if(responseString.indexOf("FAIL")>-1) {

							//get rest of data after prefix (FAIL:)
							//the number is the character position to start from, we cut off the prefix
							responseString = responseString.substring(5);

						}

						$("#messages").html(responseString);

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

		});

			//COMMENT RETRIEVAL FUNCTION ---------------------------------------------------
			function selectComments() {

			$("#comcontent").html("");

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
				url: "//localhost/webflix-1/mng_comment.php?action=select&user_id=" + userId + "&rss_id=" + rssId,
				success: function(data) {

					responseString="";

					$.each(data, function (index, item) {
					    // Use item in here
					    responseString = item;
					});


					if(responseString.indexOf("SUCCESS")>-1) {

						//get rest of data after prefix (SUCCESS:)
						//the number is the character position to start from, we cut off the prefix
						responseString = responseString.substring(8);

					}

					$("#comcontent").html(responseString);

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

	</head>

	<body>

<div class="container-fluid splash-left5">
	<?php include 'inc/nav.php' ?>
	<div class="row" style="margin-top: 4em;">
	<div class="col-md-3"></div>
	<div class="col-md-4" >
		<main style="background-color: lightgrey; padding: 3%; padding-left: 5%;
		  padding-right: 5%; border-radius: 25px; border: 2px solid #494949">
			<div class='rsstitle' style="color: black;">

			</div>


		</main>

	</div>
	<div class="col-md-5" id="messages" style="position: relative;">

		<div id="commentscontainer" style="position: fixed; opacity: 0.7; background-color: #494949; border-radius: 25px; padding: 4%;  border: 2px solid #ff8d3f;">
			<h1 style="color: orange">	<a href="#" id="commentslink"><strong>Comments</strong></a> </h1>
				<div id="comcontent">

				</div>
				<textarea id="commentbox" placeholder="Write a comment on this feed...."></textarea>
				<input type="button" value="Add Comment" id="commentbtn" mode="insert" />
				<input type="button" value="Clear Comment" id="clearbtn" />
		</div>
	</div>
</div>
</div>
		<footer>
				Welcome
		</footer>



		<img src="images/loading.gif" id="loading" />

	</body>
</html>


<body>
</body>
</html>
