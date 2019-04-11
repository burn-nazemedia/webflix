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
					</h1>
					<img class="img-responsive" src="<?php echo $row['rss_image']; ?>" width="300"/>
					
					
					
					
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