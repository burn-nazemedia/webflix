
<?php
session_start();

if ($_SESSION['user_level']!='admin') {
	header('location: index.php');
}

include("inc/header.php");

$updateQuery = mysqli_query($con,
							"SELECT *
							FROM `rss`
							WHERE `rss_id`={$_GET['id']}"
							);

while($row=mysqli_fetch_array($updateQuery)) {
	$rss_name = $row['rss_name'];
	$rss_url = $row['rss_url'];
	$rss_image = $row['rss_image'];
	
}
?>
<!DOCTYPE html>

<html lang="en">

<head>

	<meta charset="utf-8">

	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Webflix</title>



	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->

	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

	<!--[if lt IE 9]>

      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>

      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <![endif]-->

</head>

<body>


	<div class="container">

		<div class="row">
			
            
			<div class="col-md-10 adminformparent">

	





<h1>Update default RSS Feeds</h1>
	
	<form method="post" enctype="multipart/form-data" action="mng_rss.php"><br />
		<input type="hidden" name="id" value="<?php echo $_GET['id'];?>"/>
		<input type="hidden" name="action" value="update"/><br />
		<h3>Name:</h3><input class="adminfield"type="text" name="rss_name" value="<?php echo $rss_name;?>"/><br />
		<h3>URL:</h3><input class="adminfield"type="text" name="rss_url" value="<?php echo $rss_url;?>"/><br />
		<h3>RSS Image:</h3><input type="file" name="main" /> <br />
		<input type="submit" class="adminsubmit" value="Update Product" />
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