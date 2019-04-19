
<?php
//session_start();

//if ($_SESSION['user_level']!='admin') {
	//header('location: index.php');
//}

include( "inc/header.php" );
?>

<!DOCTYPE html>

<html lang="en">

<head>

	<meta charset="utf-8">

	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Webflix</title>



	<!-- Bootstrap -->

	<link href="css/bootstrap.css" rel="stylesheet">

	<link href="css/style.css" rel="stylesheet">

	<?php

	include("inc_scriptpackage.inc.php");

	?>



	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->

	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

	<!--[if lt IE 9]>

      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>

      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <![endif]-->

</head>

<body>


	<div class="container-fluid splash-left5">
<?php include 'inc/nav.php' ?>
		<div class="row">
<div class="col-md-4"></div>

			<div class="col-md-4  adminformparent">

<h2 style="margin-top: 2em;">Insert RSS Feed</h2>

	<form method="post" enctype="multipart/form-data" action="mng_rss.php"><br />
		<input type="hidden" name="action" value="insert"/><br />
		<h3>RSS Name:</h3><input class="adminfield" type="text" name="rss_name"/>
		<br />
		<h3>Rss URL:</h3><input class="adminfield" type="text" name="rss_url"/>
		<h3>Rss Feed Cache:</h3><input class="adminfield" type="text" name="rss_feed_cache"/>
		<h3>RSS Image:</h3><br/><input type="file" name="main" />
		<br />
		<br />
		<br />
		<input type="submit" class="adminsubmit" value="Insert RSS" />
	</form>








			</div>



		</div>

	</div>



	<hr>

	<?php



	include("footer.php");



	?>



	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

	<!--<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>-->

	<!--<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>-->



	<!-- Include all compiled plugins (below), or include individual files as needed -->

	<script src="js/bootstrap.js"></script>

</body>

</html>
